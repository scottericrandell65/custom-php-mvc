<h1>Edit Comment</h1>

<form method="POST" action="/comments/update/<?= $comment['id'] ?>">

    <input type="hidden" name="_token" value="<?= htmlspecialchars($csrf_token) ?>">

    <textarea name="comment" rows="5" cols="50"><?= htmlspecialchars($comment['comment']) ?></textarea>
		<?php if (!empty($errors['comment'])): ?>
        <div class="field-error">
            <?= htmlspecialchars($errors['comment']) ?>
        </div>
    <?php endif; ?>

    <br><br>

    <button type="submit">Update Comment</button>

</form>
