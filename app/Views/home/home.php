<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="/icon/TdA_sipka/png/TdA_sipka_cernomodra.png" rel="icon" type="image/x-icon"/>
    <link href="/icon/TdA_sipka/png/TdA_sipka_cernomodra.png" rel="shortcut icon" type="image/x-icon"/>
    <link href="/css/style.css" rel="stylesheet">
    <script defer src="/js/main.js"></script>
    <title>Úvod</title>
</head>
<body class="background <?php echo ($_COOKIE['theme'] ?? '') == 'disabled' ? 'dark-mode' : '' ?>">
<?php
    include_once __DIR__ . '/../nav.php';

?>


<div class="intro">

    <h1>AMOS</h1>
    <h2>Zábavné učení díky jasného plánu</h2>

    <div class="div-line">
        <a class="large button" href="/aktivity">Hledat aktivitu</a>
        <a class="large button" href="/lektori">Vytvořit aktivitu</a>
    </div>

</div>

<?php
    include_once __DIR__ . '/../footer.php';
?>

</body>
</html>
