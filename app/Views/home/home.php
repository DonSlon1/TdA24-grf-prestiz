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
    <h2>Zábavné učení s podporou AI</h2>

    <div class="main-search">
        <form class="" action="">
            <input class="input-text" type="text" name="searchActivity" id="searchActivity" placeholder="Hledat">

            <button class="search-button" type="submit">
                <img class="small-icon" src="\icon\custom\search_black.svg" alt="search">
                <p>Hledat</p>
            </button>
        </form>
    </div>

    <div class="div-line">
        <a class="medium soft" href="/aktivita/vytvorit">Vytvořit aktivitu</a>
        <a class="medium button" href="/aktivity">Všechny aktivity</a>
    </div>
</div>

<?php
    include_once __DIR__ . '/../footer.php';
?>

</body>
</html>
