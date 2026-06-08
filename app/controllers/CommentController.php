<?php

class CommentController extends Controller
{
    private CommentModel $commentModel;

    public function __construct()
    {
        $this->commentModel = new CommentModel();
    }

    /**
     * Store comment
     */
    public function store($postId): void
    {
        $this->requireAuth();
        $this->verifyCsrfToken();

        $validator = new Validator($_POST);
        $validator->required(['comment']);

        if ($validator->fails()) {
            $_SESSION['errors'] = $validator->errors();
            $_SESSION['old'] = $_POST;

            header('Location: /posts/' . $postId);
            exit;
        }

        $this->commentModel->create(
            (int)$postId,
            (int)$_SESSION['user_id'],
            trim($_POST['comment'])
        );

        $this->flash('success', 'Comment added successfully');

        header('Location: /posts/' . $postId);
        exit;
    }

    /**
     * Edit form
     */
    public function edit($id): void
    {
        $this->requireAuth();

        $comment = $this->commentModel->find((int)$id);

        if (!$comment) {
            http_response_code(404);
            $this->view('errors/404');
            return;
        }

        // RBAC: single source of truth
        $this->authorizeOwnerOrAdmin($comment);

        $this->view('comments/edit', [
            'title' => 'Edit Comment',
            'comment' => $comment,
            'errors' => $_SESSION['errors'] ?? [],
            'old' => $_SESSION['old'] ?? []
        ]);
    }

    /**
     * Update comment
     */
    public function update($id): void
    {
        $this->requireAuth();
        $this->verifyCsrfToken();

        $comment = $this->commentModel->find((int)$id);

        if (!$comment) {
            http_response_code(404);
            $this->view('errors/404');
            return;
        }

        $this->authorizeOwnerOrAdmin($comment);

        $validator = new Validator($_POST);
        $validator->required(['comment']);

        if ($validator->fails()) {
            $_SESSION['errors'] = $validator->errors();
            $_SESSION['old'] = $_POST;

            header('Location: /comments/edit/' . $id);
            exit;
        }

        $this->commentModel->update(
            (int)$id,
            trim($_POST['comment'])
        );

        $this->flash('success', 'Comment updated successfully');

        header('Location: /posts/' . $comment['post_id']);
        exit;
    }

    /**
     * Delete comment
     */
    public function delete($id): void
    {
        $this->requireAuth();
        $this->verifyCsrfToken();

        $comment = $this->commentModel->find((int)$id);

        if (!$comment) {
            http_response_code(404);
            $this->view('errors/404');
            return;
        }

        $this->authorizeOwnerOrAdmin($comment);

        $this->commentModel->delete((int)$id);

        $this->flash('success', 'Comment deleted successfully');

        header('Location: /posts/' . $comment['post_id']);
        exit;
    }
}
