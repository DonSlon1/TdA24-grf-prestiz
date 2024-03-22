<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="/icon/TdA_sipka/png/TdA_sipka_cernomodra.png" rel="icon" type="image/x-icon"/>
    <link href="/icon/TdA_sipka/png/TdA_sipka_cernomodra.png" rel="shortcut icon" type="image/x-icon"/>
    <link href="/css/style.css" rel="stylesheet">
    <script defer src="/js/lektor/lektor.js"></script>
    <title>Úvod</title>
</head>
<body class="background <?php echo ($_COOKIE['theme'] ?? '') == 'disabled' ? 'dark-mode' : '' ?>">
<?php
    include_once __DIR__ . '/../nav.php';

?>


<div class="intro">

    <h1>Teacher Digital Agency</h1>
    <h2>Rozviňte své schopnosti s osobními lektory v okolí</h2>

    <a class="large button" href="/lektori">Hledat lektora</a>

</div>

<?php
    include_once __DIR__ . '/../footer.php';
?>

</body>
</html>
