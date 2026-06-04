<h1><?= htmlspecialchars($title) ?></h1>

<p>
    <small>
        By <?= htmlspecialchars($post['author'] ?? 'Unknown') ?>
    </small>
</p>

<p><?= htmlspecialchars($content) ?></p>

<?php if (!empty($_SESSION['user_id']) && $post['user_id'] == $_SESSION['user_id']): ?>

    <div style="margin-bottom: 10px;">
        <a href="/posts/edit/<?= $post_id ?>">Edit Post</a>

        <form method="POST"
              action="/posts/delete/<?= $post_id ?>"
              style="display:inline;">

            <input type="hidden" name="_token" value="<?= $token ?>">

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

<?php if (!empty($comments)): ?>
    <?php foreach ($comments as $comment): ?>
        <div style="margin-bottom:12px;">
            <strong><?= htmlspecialchars($comment['name']) ?></strong><br>
            <?= nl2br(htmlspecialchars($comment['comment'])) ?>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No comments yet.</p>
<?php endif; ?>

<hr>

<h3>Add Comments</h3>

<form method="POST" action="/post/<?= $post_id ?>/comment">

    <input type="hidden" name="_token" value="<?= $token ?>">

    <input type="text" name="name"
           placeholder="Your name"
           value="<?= htmlspecialchars($old['name'] ?? '')?>">
           
    <?php if (!empty($errors['name'])): ?>
        <div class="field-error">
            <?= htmlspecialchars($errors['name']) ?>
        </div>
    <?php endif; ?>
           

    <br><br>

    <textarea name="comment"
              placeholder="Your comment"><?= htmlspecialchars($old['comment'] ?? '') ?>
    </textarea>
    
    <?php if (!empty($errors['comment'])): ?>
        <div class="field-error">
            <?= htmlspecialchars($errors['comment']) ?>
        </div>
    <?php endif; ?>

    <br><br>

<button type="submit">Add Comment</button>
</form>


