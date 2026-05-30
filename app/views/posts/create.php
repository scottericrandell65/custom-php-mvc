<h1><?= htmlspecialchars($title) ?></h1>

<form method="POST" action="/posts/store">
    <label>Title</label><br>
    <input type="text" name="title"><br><br>

    <label>Content</label><br>
    <textarea name="content"></textarea><br><br>

    <button type="submit">Create Post</button>
</form>
