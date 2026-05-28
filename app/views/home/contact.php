<h1>Contact Page</h1>

<?php if (!empty($data['errors'])): ?>
    <div style="color:red;">
	<?php foreach ($data['errors'] as $error): ?>
		<p><?= $error; ?></p>
	<?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if (!empty($data['success'])): ?>
	<div style="color:green;">
	     <p><?= $data['success'] ?></p>
    </div>
<?php endif; ?>
<form method="POST" action="/contact">
   <label>Name:</label><br>
   <input type="text" name="name" required><br><br>
   <label>Email:</label><br>
   <input type="email" name="email" required><br><br>
   <label>Message:</label><br>
   <textarea name="message" required></textarea><br><br>
   <button type="submit">Send</button>
</form>
