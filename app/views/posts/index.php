<h1><?= htmlspecialchars($title ?? 'All Posts') ?></h1>

<?php if (!empty($success)): ?>
    <div class="flash-success">
        <?= htmlspecialchars($success) ?>
    </div>
<?php endif; ?>

<?php if (empty($posts)): ?>
    <p>No posts found.</p>
<?php else: ?>

<?php foreach ($posts as $post): ?>

    <div class="post-card">

        <div class="post-card-title">
            <a href="/posts/<?= $post['id'] ?>">
                <?= htmlspecialchars($post['title']) ?>
            </a>
        </div>

        <div class="post-card-meta">
            by <?= htmlspecialchars($post['author'] ?? 'Unknown') ?>
        </div>

<?php if (
    !empty($isAuthenticated) &&
    (
        !empty($isAdmin) ||
        (
            !empty($user) &&
            (int)$post['user_id'] === (int)$user['id']
        )
    )
): ?>

        <div class="post-card-actions">

            <a href="/posts/edit/<?= $post['id'] ?>">
                Edit
            </a>

            <form method="POST"
                  action="/posts/delete/<?= $post['id'] ?>">

                <input
                    type="hidden"
                    name="_token"
                    value="<?= htmlspecialchars($csrf_token) ?>">

                <button
                    type="submit"
                    onclick="return confirm('Delete this post?')">
                    Delete
                </button>

            </form>

        </div>

<?php endif; ?>

    </div>

<?php endforeach; ?>

<?php endif; ?>
