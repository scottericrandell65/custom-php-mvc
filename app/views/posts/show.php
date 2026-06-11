<h1><?= htmlspecialchars($title) ?></h1>

<!-- POST CARD -->
<div class="post-full">

    <div class="post-full-meta">
        By <?= htmlspecialchars($post['author'] ?? 'Unknown') ?>
    </div>

    <div class="post-full-content">
        <?= nl2br(htmlspecialchars($content)) ?>
    </div>

    <?php if (
        !empty($isAuthenticated) &&
        (
            !empty($isAdmin) ||
            (int)$post['user_id'] === (int)$user['id']
        )
    ): ?>

        <div class="post-card-actions">

            <a href="/posts/edit/<?= $post_id ?>">Edit Post</a>

            <form method="POST"
                  action="/posts/delete/<?= $post_id ?>">

                <input type="hidden"
                       name="_token"
                       value="<?= htmlspecialchars($csrf_token) ?>">

                <button type="submit"
                        onclick="return confirm('Delete this post?')">
                    Delete
                </button>

            </form>

        </div>

    <?php endif; ?>

</div>

<hr>

<!-- COMMENTS SECTION -->
<h3>Comments</h3>

<?php require __DIR__ . '/../partials/flash.php'; ?>

<?php foreach ($comments as $comment): ?>

    <div class="comment-card">

        <strong><?= htmlspecialchars($comment['name']) ?></strong>

        <div class="comment-body">
            <?= nl2br(htmlspecialchars($comment['comment'])) ?>
        </div>

        <?php if (
            !empty($isAuthenticated) &&
            (
                !empty($isAdmin) ||
                (
                    !empty($user) &&
                    (int)$comment['user_id'] === (int)$user['id']
                )
            )
        ): ?>

            <div class="post-card-actions">

                <a href="/comments/edit/<?= $comment['id'] ?>">
                    Edit
                </a>

                <form method="POST"
                      action="/comments/delete/<?= $comment['id'] ?>">

                    <input type="hidden"
                           name="_token"
                           value="<?= htmlspecialchars($csrf_token) ?>">

                    <button type="submit"
                            onclick="return confirm('Delete this comment?')">
                        Delete
                    </button>

                </form>

            </div>

        <?php endif; ?>

    </div>

<?php endforeach; ?>

<hr>

<!-- ADD COMMENT -->
<div class="post-full">

    <h3>Add Comment</h3>

    <form method="POST" action="/post/<?= $post_id ?>/comment">

        <input type="hidden"
               name="_token"
               value="<?= htmlspecialchars($csrf_token) ?>">

        <textarea name="comment"
                  placeholder="Your comment"><?= htmlspecialchars($old['comment'] ?? '') ?></textarea>

        <?php if (!empty($errors['comment'])): ?>
            <div class="field-error">
                <?= htmlspecialchars($errors['comment']) ?>
            </div>
        <?php endif; ?>

        <button type="submit">Add Comment</button>

    </form>

</div>
