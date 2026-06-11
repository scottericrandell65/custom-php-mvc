<header class="site-header">
    <div class="brand">
        <h2>My PHP OOP Site</h2>
    </div>

    <nav class="nav">

        <a href="/">Home</a>
        <a href="/posts">Posts</a>
        <a href="/about">About</a>
        <a href="/contact">Contact</a>

        <?php if (!empty($user)): ?>

            <span class="nav-separator">|</span>

            <span class="nav-user">
                Welcome, <?= htmlspecialchars($user['name']) ?>
            </span>

            <?php if ($isAdmin): ?>
                <a href="/posts/create">Create Post</a>
            <?php endif; ?>
            
            <form method="POST" action="/logout" class="inline-form">
                <input type="hidden" name="_token" value="<?= htmlspecialchars($csrf_token) ?>">

                <button type="submit" class="link-button">
                    Logout
                </button>
            </form>
            
            <?php else: ?>

            <span class="nav-separator">|</span>

            <a href="/login">Login</a>
            <a href="/register">Register</a>

        <?php endif; ?>

    </nav>

</header>
