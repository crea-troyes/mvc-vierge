<?php
// Sécurité anti-XSS de base
function e(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

// Headers HTTP sécurisés
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self'");

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= e($title ?? 'Créa-code'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

    <?php require_once __DIR__ . '/partials/header.php'; ?>

    <main class="container">
        <?= $content ?? ''; ?>
    </main>

    <?php require_once __DIR__ . '/partials/footer.php'; ?>

</body>
</html> 