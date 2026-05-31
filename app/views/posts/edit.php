<h1><?= htmlspecialchars($title) ?></h1>

<form method="POST" action="/posts/update/<?= $post['id'] ?>">
     <input type="hidden" name="_token" value="<?= $token ?>">
     <label>Title</label><br>
     <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>"><br><br>

     <label>Content</label><br>
     <textarea name="content"><?= htmlspecialchars($post['content']) ?></textarea><br><br>

     <button type="submit">Update Post</button>
</form>
