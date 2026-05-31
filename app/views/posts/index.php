<h1><?= htmlspecialchars($title) ?></h1>

<?php if (empty($posts)): ?>
	<p>No posts found.</p>
<?php else: ?>
	<ul>
	   <?php foreach ($posts as $post): ?>
		<li>
		   <a href="/post/<?= $post['id'] ?>">
			<?= htmlspecialchars($post['title']) ?>
		   </a>

		   <a href="/posts/edit/<?= $post['id'] ?>">Edit</a>
		     <form method="POST" action="/posts/delete/<?= $post['id'] ?>" style="display:inline;">
		     <input type="hidden" name="_token" value="<?= $_SESSION['_token'] ?>">

		     <button type="submit" onclick="return confirm('Delete this post?')">
			Delete
		     </button>
		   </form>
		</li>
	   <?php endforeach; ?>
	</ul>
<?php endif; ?>
