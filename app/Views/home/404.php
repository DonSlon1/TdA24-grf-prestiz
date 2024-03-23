<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="/icon/TdA_sipka/png/TdA_sipka_cernomodra.png" rel="icon" type="image/x-icon"/>
    <link href="/icon/TdA_sipka/png/TdA_sipka_cernomodra.png" rel="shortcut icon" type="image/x-icon"/>
    <link href="/css/style.css" rel="stylesheet">
    <script src="/js/lektor/lektor.js" defer></script>
    <title>404</title>
</head>
<body class="background <?php echo ($_COOKIE['theme'] ?? '') == 'disabled' ? 'dark-mode' : '' ?>">
<?php
    include_once __DIR__ . '/../nav.php';

?>
<div class="intro">
    <h1>404</h1>
    <h2>Upsík, stránka nebyla nalezena</h2>

    <a class="underline" href="/">zpět na úvod</a>
</div>

<?php
    include_once __DIR__ . '/../footer.php';
?>
</body>
</html>
