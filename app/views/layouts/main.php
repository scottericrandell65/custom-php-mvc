<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'My App') ?></title>

    <link rel="stylesheet" href="/assets/css/app.css">
</head>

<body>
    
<?php require __DIR__ . '/../partials/header.php'; ?>

<main>
     <?= $content ?>
</main>

<?php require __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
