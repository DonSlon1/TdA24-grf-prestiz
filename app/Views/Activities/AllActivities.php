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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script defer src="/js/main.js"></script>
    <script defer src="/js/activity-form.js"></script>
    <title>Aktivity</title>
</head>
<body class="background <?php echo ($_COOKIE['theme'] ?? '') == 'disabled' ? 'dark-mode' : '' ?>">
<?php
include_once __DIR__ . '/../nav.php';

?>

<?php /*if (!empty($data) && count($data['lecturers']) > 0): */?>

<div class="content">
    <h1>Aktivity</h1>

    <div class="filter blur">
        <h3><img id="filter" class="small-icon" src="\icon\custom\filter_black.svg" alt="filter"> Filtrace</h3>

        <div class="search-bar">
            <h4>Chytré hledání</h4>
            <form class="" action="">
                <input class="search input-text" type="text" name="searchActivity" id="searchActivity" placeholder="Hledat">
            </form>
            <form action="" method="get">
                <input type="text" name="query" placeholder="Vyhledávání..." value="<?= htmlspecialchars($query) ?>">
                <button type="submit">Vyhledat</button>
            </form>
        </div>

        <form id="lecturer-form">
            <div class="div-line">
                <div>
                    <h4>Velikost skupiny</h4>
                    <div class="tags-column" id="group-size">
                        <div class="checkbox-container tags">
                            <input class="tag-checkbox" type="checkbox" name="group" id="individual">
                            <label class="tag" for="individual">
                                Individuál
                            </label>
                        </div>

                        <div class="checkbox-container tags">
                            <input class="tag-checkbox" type="checkbox" name="group" id="group">
                            <label class="tag" for="group">
                                Skupina
                            </label>
                        </div>

                        <div class="checkbox-container tags">
                            <input class="tag-checkbox" type="checkbox" name="group" id="all">
                            <label class="tag" for="all">
                                Všichni
                            </label>
                        </div>
                    </div>
                </div>

                <div>
                    <h4>Úroveň vzdělání</h4>
                    <div class="tags-column" id="ed-level">
                        <div class="check-list-container">
                            <div class="checkbox-container tags">
                                <input class="tag-checkbox" type="checkbox" name="group" id="primary">
                                <label class="tag" for="primary">
                                    1. stupeň ZŠ
                                </label>
                            </div>

                            <div class="checkbox-container tags">
                                <input class="tag-checkbox" type="checkbox" name="group" id="primary">
                                <label class="tag" for="primary">
                                    2. stupeň ZŠ
                                </label>
                            </div>

                            <div class="checkbox-container tags">
                                <input class="tag-checkbox" type="checkbox" name="group" id="primary">
                                <label class="tag" for="primary">
                                    Střední škola
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="search-bar">
                <h4>Doba aktivity</h4>
                <div id="price-field">
                    <div id="price-slider-range" data-min="<?php echo $data['min'] ?? 0 ?>"
                         data-max="<?php echo $data['max'] ?? 0 ?>"></div>
                    <input class="text" type="number" id="min-price" name="min-price"
                           data-minPrice="<?php echo $data['min'] ?? 0 ?>">
                    <p> až </p>
                    <input class="text" type="number" id="max-price" name="max-price"
                           data-maxPrice="<?php echo $data['max'] ?? 0 ?>">
                </div>

                <div id="price-range"></div>
            </div>

            <div class="btns-line">
                <input class="medium soft" id="reset-button" type="submit" value="Zrušit výběr">
                <input class="medium button" type="submit" value="Hledat">
            </div>

        </form>
    </div>

    <div>
        <?php foreach ($activities as $activity): ?>
            <?php include __DIR__ . '/ActivityCard.php'; ?>
        <?php endforeach; ?>
    </div>
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