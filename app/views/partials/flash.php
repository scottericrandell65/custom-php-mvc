<?php if ($msg = $this->getFlash('success')): ?>
    <div class="flash-success">
        <?= htmlspecialchars($msg) ?>
    </div>
<?php endif; ?>

<?php if ($msg = $this->getFlash('error')): ?>
    <div class="flash-error">
        <?= htmlspecialchars($msg) ?>
    </div>
<?php endif; ?>
