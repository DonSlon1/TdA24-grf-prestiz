<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script defer src="/js/main.js"></script>
    <link href="/css/style.css" rel="stylesheet">
    <title>Vytvořit aktivitu</title>
</head>
<body class="background">
    <div class="content">
        <h1>Vytvořit aktivitu</h1>

        <form id="activityForm">
            <input type="hidden" name="uuid" value="e3b0c442-5b8b-47ba-9d8a-e4d3d2f3d974">

            <label for="activityName">Activity Name:</label>
            <input type="text" id="activityName" name="activityName" required><br><br>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea><br><br>

            <label>Objectives:</label>
            <input type="text" name="objectives[]" placeholder="Objective 1" required>
            <input type="text" name="objectives[]" placeholder="Objective 2"><br><br>

            <label for="classStructure">Class Structure:</label>
            <select id="classStructure" name="classStructure">
                <option value="Group">Group</option>
                <option value="Individual">Individual</option>
            </select><br><br>

            <label for="lengthMin">Length Min:</label>
            <input type="number" id="lengthMin" name="lengthMin" required><br><br>

            <label for="lengthMax">Length Max:</label>
            <input type="number" id="lengthMax" name="lengthMax" required><br><br>

            <label>Education Level:</label>
            <input type="checkbox" id="secondarySchool" name="edLevel[]" value="secondarySchool">
            <label for="secondarySchool">Secondary School</label>
            <input type="checkbox" id="highSchool" name="edLevel[]" value="highSchool">
            <label for="highSchool">High School</label><br><br>

            <label>Tools:</label>
            <input type="text" name="tools[]" placeholder="Tool 1" required>
            <input type="text" name="tools[]" placeholder="Tool 2"><br><br>

            <!-- For simplicity, only showing one home preparation entry -->
            <fieldset>
                <legend>Home Preparation</legend>
                <label for="prepTitle">Title:</label>
                <input type="text" id="prepTitle" name="homePreparation[title]" required><br><br>
                <label for="prepWarn">Warn:</label>
                <input type="text" id="prepWarn" name="homePreparation[warn]"><br><br>
                <label for="prepNote">Note:</label>
                <input type="text" id="prepNote" name="homePreparation[note]"><br><br>
            </fieldset>

            <!-- For simplicity, only showing one instruction entry -->
            <fieldset>
                <legend>Instructions</legend>
                <label for="instrTitle">Title:</label>
                <input type="text" id="instrTitle" name="instructions[title]" required><br><br>
                <label for="instrWarn">Warn:</label>
                <input type="text" id="instrWarn" name="instructions[warn]"><br><br>
                <label for="instrNote">Note:</label>
                <input type="text" id="instrNote" name="instructions[note]"><br><br>
            </fieldset>

            <!-- Additional fields for agenda, links, and gallery can be added similarly -->

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>