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
		</li>
	   <?php endforeach; ?>
	</ul>
<?php endif; ?>
