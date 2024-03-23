<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/icon/TdA_sipka/png/TdA_sipka_cernomodra.png" rel="icon" type="image/x-icon"/>
    <link href="/icon/TdA_sipka/png/TdA_sipka_cernomodra.png" rel="shortcut icon" type="image/x-icon"/>
    <link href="/css/style.css" rel="stylesheet">
    <script defer src="/js/main.js"></script>
    <title>Aktivitz</title>
</head>
<body class="background <?php echo ($_COOKIE['theme'] ?? '') == 'disabled' ? 'dark-mode' : '' ?>">
<?php
include_once __DIR__ . '/../nav.php';

?>

<?php /*if (!empty($data) && count($data['lecturers']) > 0): */?>

<div class="content">
    <h1>Aktivity</h1>

    <form class="search-bar" action="">
        <input type="text" class="search input-text" name="searchActivity" id="searchActivity" placeholder="Hledat aktivitu">
    </form>

        <!--<div id="lecturer">
            <?php
/*            if (!empty($data)) {
                include 'lecturer_cards.php';
            }
            */?>
        </div>-->
        <!--<div id="paging-container">
            <?php /*include 'paging.php'; */?>
        </div>-->
    </div>
<?php /*else: */?>
    <!--<div class="intro">
        <h2>Omlouváme se, ale na stránce se nenachází žádná aktivita.</h2>
    </div>-->
<?php /*endif; */?>

<?php
include_once __DIR__ . '/../footer.php';
?>
</body>
</html>