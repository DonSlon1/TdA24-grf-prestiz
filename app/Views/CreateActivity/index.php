<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script defer src="/js/main.js"></script>
    <script defer src="/js/createActivity.js"></script>
    <link href="/css/style.css" rel="stylesheet">
    <title>Vytvořit aktivitu</title>
</head>
<body class="background">
<?php
include_once __DIR__ . '/../nav.php';
?>
    <div class="content">
        <h1>Vytvořit aktivitu</h1>

        <form class="blur" id="activityForm">
            <div class="search-bar">
                <input class="input-text" type="text" id="activityName" name="activityName" placeholder="Název aktivity">
            </div>

            <label for="description">Popis:</label>
            <textarea id="description" name="description"></textarea>

            <!-- Inside the <form> element, after existing fields -->

            <label for="classStructure">Struktura třídy:</label>
            <select id="classStructure" name="classStructure">
                <option value="Group">Skupina</option>
                <option value="Individual">Individuální</option>
                <option value="All">Všichni</option>
            </select><br><br>

            <label for="lengthMin">Minimální délka:</label>
            <input type="number" id="lengthMin" name="lengthMin" required><br><br>

            <label for="lengthMax">Maximální délka:</label>
            <input type="number" id="lengthMax" name="lengthMax" required><br><br>

            <fieldset id="edLevelContainer">
                <legend>Vzdělávací úroveň:</legend>
                <input type="checkbox" id="secondarySchool" name="edLevel[]" value="primarySchool">
                <label for="secondarySchool">1. stupeň ZŠ</label>
                <input type="checkbox" id="highSchool" name="edLevel[]" value="secondarySchool">
                <label for="highSchool">2. stupeň ZŠ</label>
                <input type="checkbox" id="university" name="edLevel[]" value="highSchool">
                <label for="university">Střední škola</label>
            </fieldset><br>

            <!-- Simplified representations for agenda, links, and gallery -->
            <div id="agendaContainer">
                <label>Agenda:</label>
                <button type="button" onclick="addAgenda()">+</button>
            </div><br>

            <div id="linksContainer">
                <label>Odkazy:</label>
                <button type="button" onclick="addLink()">+</button>
            </div><br>

            <div id="galleryContainer">
                <label>Galerie:</label>
                <button type="button" onclick="addGalleryItem()">+</button>
            </div><br>

            <div id="objectivesContainer">
                <label>Cíle:</label>
                <button type="button" onclick="addObjective()">+</button>
            </div><br>

            <div id="toolsContainer">
                <label>Nástroje:</label>
                <button type="button" onclick="addTool()">+</button>
            </div><br>

            <div id="homePreparationsContainer">
                <label>Příprava doma:</label>
                <button type="button" onclick="addHomePreparation()">+</button>
            </div><br>

            <div id="instructionsContainer">
                <label>Instrukce:</label>
                <button type="button" onclick="addInstruction()">+</button>
            </div><br>

            <label for="uuid">UUID:</label>
            <input type="text" id="uuid" name="uuid" title="Enter a valid UUID" required>
            <span id="uuidError" style="color: red; display: none;">Invalid UUID format.</span>

            <button type="submit">Odeslat</button>
        </form>

        <script src="formScript.js"></script>

        </body>
        </html>
    </div>

<?php
include_once __DIR__ . '/../footer.php';
?>
</body>
</html>