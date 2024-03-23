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
    <script defer src="/js/gallery.js"></script>
    <title><?= htmlspecialchars($activity['activityName']) ?></title>
</head>
<body class="background">

<div class="content">
    <h1><?= htmlspecialchars($activity['activityName']) ?></h1>

    <div class="blur info">
        <h2>Základní informace</h2>
        <div class="icon-line">
            <div class="icon-txt">
                <img class="group-icon small-icon" src="\icon\TdA_ikony\SVG\TdA_ikony_konverzace_black.svg" alt="TdA_ikony_konverzace_black.svg">
                <p><?= htmlspecialchars($activity['classStructure']) ?></p>
            </div>

            <div class="icon-txt">
                <img class="group-icon small-icon" src="\icon\TdA_ikony\SVG\TdA_ikony_napad_black.svg" alt="TdA_ikony_konverzace_black.svg">
                <p><?= implode(', ', array_map('htmlspecialchars', $activity['edLevel'] ?? [])) ?></p>
            </div>

            <div class="icon-txt">
                <img class="clock small-icon" src="\icon\custom\clock_black.svg" alt="clock">
                <p><?= htmlspecialchars($activity['lengthMin']) ?> min</p> <p>-</p> <p><?= htmlspecialchars($activity['lengthMax']) ?> min</p>
            </div>
        </div>

        <h3>Popis</h3>
        <div class="bio">
            <?= htmlspecialchars($activity['description']) ?>
        </div>

        <h3>Cíl</h3>
        <div class="bio">
            <?= implode('<br>', array_map('htmlspecialchars', $activity['objectives'] ?? [])) ?>
        </div>
    </div>

    <div class="blur info">
        <h2>Organizace aktivity</h2>
        <div class="time-agenda-container">
            <h3>Časový plán</h3>
            <ul class="time-agenda">
                <?php foreach ($activity['agenda'] as $agenda): ?>
                    <li>
                        <span><?= htmlspecialchars($agenda['title']) ?></span>
                        <p><?= htmlspecialchars($agenda['duration']) ?> min</p>
                        <p><?= htmlspecialchars($agenda['description']) ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="div-line">
            <div>
                <h3>Příprava na aktivitu</h3>
                <ol class="step-list">
                    <?php foreach ($activity['homePreparation'] as $prep): ?>
                        <li>
                            <span><?= htmlspecialchars($prep['title']) ?></span>
                            <p><?= htmlspecialchars($prep['note']) ?></p>
                            <?php if ($prep['warn']): ?>
                                <p class="warning"><?= htmlspecialchars($prep['warn']) ?></p>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>

            <div>
                <h3>Průběh aktivity</h3>
                <ol class="step-list">
                    <?php foreach ($activity['instructions'] as $instruction): ?>
                        <li>
                            <span><?= htmlspecialchars($instruction['title']) ?></span>
                            <p><?= htmlspecialchars($instruction['note']) ?></p>
                            <?php if ($instruction['warn']): ?>
                                <p class="warning"><?= htmlspecialchars($instruction['warn']) ?></p>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>
    </div>

    <div class="blur info">
        <h2>Vybavení na aktivitu</h2>

        <div class="div-line">
            <div>
                <h3>Seznam potřebných věcí</h3>
                <ul>
                    <?php foreach ($activity['tools'] as $tool): ?>
                        <li><?= htmlspecialchars($tool) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div>
                <h3>Doporučené odkazy</h3>
                <ul>
                    <?php foreach ($activity['links'] as $link): ?>
                        <li><a href="<?= htmlspecialchars($link['url']) ?>"><?= htmlspecialchars($link['title']) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="blur info">
        <h2>Galerie</h2>

        <div id="gallery">
            <?php foreach ($activity['gallery'] as $gallery): ?>
                <?php foreach ($gallery['images'] as $image): ?>
                    <img class="preview-img" src="<?= htmlspecialchars($image['lowRes']) ?>" data-full="<?= htmlspecialchars($image['highRes']) ?>" alt="<?= htmlspecialchars($gallery['title']) ?>">
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>

    </div>
    <div id="fullImageModal" class="modal">
        <span id="closeModal" class="close">&times;</span>
        <img id="fullImage" src="" alt="Full Image">
    </div>
</div>

<?php include_once __DIR__ . '/../footer.php'; ?>
</body>
</html>