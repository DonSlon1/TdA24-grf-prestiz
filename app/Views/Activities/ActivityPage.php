<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/style.css" rel="stylesheet">
    <script defer src="/js/main.js"></script>
    <title>Aktivita</title>
</head>
<body class="background">
    <?php
    include_once __DIR__ . '/../nav.php';
    ?>
    <div class="content">
        <h1>Jméno aktivity</h1>

        <div class="blur info">
            <h2>Základní informace</h2>
            <div class="icon-line">
                <div class="icon-txt">
                    <img class="group-icon small-icon" src="\icon\TdA_ikony\SVG\TdA_ikony_konverzace_black.svg" alt="TdA_ikony_konverzace_black.svg">
                    <p>Velikost skupiny</p>
                </div>

                <div class="icon-txt">
                    <img class="group-icon small-icon" src="\icon\TdA_ikony\SVG\TdA_ikony_napad_black.svg" alt="TdA_ikony_konverzace_black.svg">
                    <p>úroveň vzdělání</p>
                </div>

                <div class="icon-txt">
                    <img class="clock small-icon" src="\icon\custom\clock_black.svg" alt="clock">
                    <p>min doba</p> <p>-</p> <p>max doba</p>
                </div>
            </div>

            <h3>Popis</h3>
            <div class="bio">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores commodi cum error inventore iste non obcaecati. Blanditiis ea earum esse eum exercitationem magni modi obcaecati officiis quidem ullam? Beatae, ipsam.
            </div>

            <h3>Cíl</h3>
            <div class="bio">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores commodi cum error inventore iste non obcaecati. Blanditiis ea earum esse eum exercitationem magni modi obcaecati officiis quidem ullam? Beatae, ipsam.
            </div>
        </div>

        <div class="blur info">
            <h2>Organizace aktivity</h2>
            <div>
                <h3>Časový plán</h3>
                <ol class="time-agenda">
                    <li>První krok</li>
                    <li class="warning">Druhý krok</li>
                    <li>Třetí krok</li>
                </ol>
            </div>

            <div class="div-line">
                <div>
                    <h3>Příprava na aktivitu</h3>
                    <ol class="step-list">
                        <li>První krok</li>
                        <li class="warning">Druhý krok</li>
                        <li>Třetí krok</li>
                    </ol>

                </div>

                <div>
                    <h3>Průběh aktivity</h3>
                    <ol class="step-list">
                        <li>První krok</li>
                        <li class="warning">Druhý krok</li>
                        <li>Třetí krok</li>
                    </ol>
                </div>
            </div>


        </div>

    </div>

    <?php
    include_once __DIR__ . '/../footer.php';
    ?>
</body>
</html>