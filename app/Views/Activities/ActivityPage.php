<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/style.css" rel="stylesheet">
    <script defer src="/js/main.js"></script>
    <script defer src="/js/gallery.js"></script>
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
            <div class="time-agenda-container">
                <h3>Časový plán</h3>
                <ul class="time-agenda">
                    <li>
                        <span>První krok</span>
                        <p>časové rozmezí</p>
                        <p>popis kroku</p>
                    </li>
                    <li>
                        <span>Druhý krok</span>
                        <p>časové rozmezí</p>
                        <p>popis kroku</p>
                    </li>

                    <li>
                        <span>Třetí krok</span>
                        <p>časové rozmezí</p>
                    </li>

                    <li>
                        <span>Čtvrtý krok</span>
                        <p>časové rozmezí</p>
                    </li>

                    <li>
                        <span>Pátý krok</span>
                        <p>časové rozmezí</p>
                    </li>

                    <li>
                        <span>Šestý krok</span>
                        <p>časové rozmezí</p>
                    </li>

                    <li>
                        <span>Sedmý krok</span>
                        <p>časové rozmezí</p>
                    </li>
                </ul>
            </div>

            <div class="div-line">
                <div>
                    <h3>Příprava na aktivitu</h3>
                    <ol class="step-list">
                        <li>
                            <span>První krok</span>
                            <p>popis kroku</p>
                        </li>
                        <li>
                            <span>Druhý krok</span>
                            <p>popis kroku</p>
                            <p class="warning">warning</p>
                        </li>

                        <li>
                            <span>Třetí krok</span>
                            <p class="warning">warning</p>
                        </li>

                        <li>
                            <span>Čtvrtý krok</span>
                        </li>
                    </ol>

                </div>

                <div>
                    <h3>Průběh aktivity</h3>
                    <ol class="step-list">
                        <li>
                            <span>První krok</span>
                            <p>popis kroku</p>
                        </li>
                        <li>
                            <span>Druhý krok</span>
                            <p>popis kroku</p>
                            <p class="warning">warning</p>
                        </li>

                        <li>
                            <span>Třetí krok</span>
                            <p class="warning">warning</p>
                        </li>

                        <li>
                            <span>Čtvrtý krok</span>
                        </li>
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
                        <li>Předmět</li>
                        <li>Předmět</li>
                        <li>Předmět</li>
                        <li>Předmět</li>
                        <li>Předmět</li>
                        <li>Předmět</li>
                        <li>Předmět</li>
                        <li>Předmět</li>
                    </ul>
                </div>

                <div>
                    <h3>Doporučené odkazy</h3>
                    <ul>
                        <li><a href="">Odkaz</a></li>
                        <li><a href="">Odkaz</a></li>
                        <li><a href="">Odkaz</a></li>
                        <li><a href="">Odkaz</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="blur info">
            <h2>Galerie</h2>

            <div id="gallery">
                <!-- Example images -->
                <img class="preview-img" src="/icon/TdA_LOGO/TeacherDigitalAgency_LOGO_black.png" data-full="/icon/TdA_LOGO/TeacherDigitalAgency_LOGO_black.png" alt="Image 1">
                <img class="preview-img" src="/icon/TdA_LOGO/TeacherDigitalAgency_LOGO_black.png" data-full="/icon/TdA_LOGO/TeacherDigitalAgency_LOGO_black.png" alt="Image 2">
                <!-- Add more images as needed -->
            </div>

            <div id="fullImageModal" class="modal">
                <span id="closeModal" class="close">&times;</span>
                <img id="fullImage" src="" alt="Full Image">
            </div>
        </div>
    </div>

    <?php
    include_once __DIR__ . '/../footer.php';
    ?>
</body>
</html>