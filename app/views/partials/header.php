<header>
    <h2>My PHP OOP Site</h2>

    <nav>
        <a href="/">Home</a>
        <a href="/posts">Posts</a>
        <a href="/about">About</a>
        <a href="/contact">Contact</a>
        
        <?php if (!empty($user)): ?>

            | Welcome, <?= htmlspecialchars($user['name']) ?>

            <?php if ($isAdmin): ?>
                | <a href="/posts/create">Create Post</a>
            <?php endif; ?>
            
            |
            <form method="POST" action="/logout" style="display:inline;">
                <input type="hidden" name="_token" value="<?= htmlspecialchars($csrf_token) ?>">

                <button type="submit"
                        style="background:none;border:none;color:#2980b9;cursor:pointer;padding:0;">
                    Logout
                </button>
            </form>
            
            <?php else: ?>

            | <a href="/login">Login</a>
            | <a href="/register">Register</a>

        <?php endif; ?>
    </nav>
</header>

        
        
