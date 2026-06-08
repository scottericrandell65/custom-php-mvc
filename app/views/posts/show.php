<h1><?= htmlspecialchars($title) ?></h1>

<p>
    <small>
        By <?= htmlspecialchars($post['author'] ?? 'Unknown') ?>
    </small>
</p>

<p><?= nl2br(htmlspecialchars($content)) ?></p>

<?php if (
    !empty($isAuthenticated) &&
    (
        !empty($isAdmin) ||
        (int)$post['user_id'] === (int)$user['id']
    )
): ?>

    <div style="margin-bottom: 10px;">
        <a href="/posts/edit/<?= $post_id ?>">Edit Post</a>

        <form method="POST"
              action="/posts/delete/<?= $post_id ?>"
              style="display:inline;">

            <input type="hidden" name="_token" value="<?= htmlspecialchars($csrf_token) ?>">

            <button type="submit"
                    onclick="return confirm('Delete this post?')">
                Delete
            </button>

        </form>
    </div>

<?php endif; ?>

<hr>

<h3>Comments</h3>

<?php require __DIR__ . '/../partials/flash.php'; ?>

<?php foreach ($comments as $comment): ?>
    <div style="margin-bottom:12px;">

        <strong><?= htmlspecialchars($comment['name']) ?></strong><br>

        <?= nl2br(htmlspecialchars($comment['comment'])) ?>

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
        <div style="margin-top:6px;">

                <a href="/comments/edit/<?= $comment['id'] ?>">
                    Edit
                </a>

                <form method="POST"
                      action="/comments/delete/<?= $comment['id'] ?>"
                      style="display:inline;">

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

<h3>Add Comment</h3>

<form method="POST" action="/post/<?= $post_id ?>/comment">

    <input type="hidden" name="_token" value="<?= htmlspecialchars($csrf_token) ?>">

    <br><br>

    <textarea name="comment"
              placeholder="Your comment"><?= htmlspecialchars($old['comment'] ?? '') ?></textarea>

    <?php if (!empty($errors['comment'])): ?>
        <div class="field-error">
            <?= htmlspecialchars($errors['comment']) ?>
        </div>
    <?php endif; ?>

    <br><br>

    <button type="submit">Add Comment</button>
</form>
