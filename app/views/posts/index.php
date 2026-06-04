<h1><?= htmlspecialchars($title ?? 'All Posts') ?></h1>

<?php if (!empty($success)): ?>
    <div class="flash-success">
        <?= htmlspecialchars($success) ?>
    </div>
<?php endif; ?>

<?php if (empty($posts)): ?>
    <p>No posts found.</p>
<?php else: ?>

<ul>
<?php foreach ($posts as $post): ?>
     <li>

       <a href="/post/<?= $post['id'] ?>">
          <?= htmlspecialchars($post['title']) ?>
       </a>

       <small>
          by <?= htmlspecialchars($post['author'] ?? 'Unknown') ?>
       </small>
                
<?php if (!empty($_SESSION['user_id']) && $post['user_id'] == $_SESSION['user_id']): ?>
          |
          <a href="/posts/edit/<?= $post['id'] ?>">Edit</a>
          
       <form method="POST" action="/posts/delete/<?= $post['id'] ?>" 
       style="display:inline;">

         <input type="hidden" name="_token" value="<?= $_SESSION['_token'] ?>">

         <button type="submit" onclick="return confirm('Delete this post?')">
           Delete
         </button>

       </form>
<?php endif; ?>

     </li>
<?php endforeach; ?>
</ul>

<?php endif; ?>
          
                    
                
