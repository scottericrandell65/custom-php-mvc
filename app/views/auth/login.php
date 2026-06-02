<h1>Login</h1>

<?php require __DIR__ . '/../partials/flash.php'; ?>

<form method="POST" action="/login">
	
	<input type="hidden"
		   name="_token"
		   value="<?= $token ?>">
		   
    <div
		<label>Email</label><br>
		
		<input
			type="email"
			name="email"
			value="<?= htmlspecialchars($old['email'] ?? '') ?>">
	</div>
	
	<?php if (!empty($errors['email'])): ?>
        <div class="field-error">
            <?= htmlspecialchars($errors['email']) ?>
        </div>
    <?php endif; ?>
    
    <br>
    
    <div>
        <label>Password</label><br>

        <input
            type="password"
            name="password">
    </div>
    
    <?php if (!empty($errors['password'])): ?>
        <div class="field-error">
            <?= htmlspecialchars($errors['password']) ?>
        </div>
    <?php endif; ?>
    
    <br>
    
    <button type="submit">
        Login
    </button>
    
</form>

	
