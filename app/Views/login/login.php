<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="/icon/TdA_sipka/png/TdA_sipka_cernomodra.png" rel="icon" type="image/x-icon"/>
    <link href="/icon/TdA_sipka/png/TdA_sipka_cernomodra.png" rel="shortcut icon" type="image/x-icon"/>
    <link href="/css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script defer src="/js/main.js"></script>
    <script src="/js/login/login.js"></script>
    <title>Přihlášení</title>
</head>
<body class="background <?php echo ($_COOKIE['theme'] ?? '') == 'disabled' ? 'dark-mode' : '' ?>">
<?php
    include_once __DIR__ . '/../nav.php';

?>
<div class="content">
    <form class="blur form-content circle-margin" action="/lektor/interface" id="login-form">
        <div class="blur circle-background">
            <img src="/icon/TdA_ikony/SVG/TdA_ikony_studium_blue.svg" alt="studium">
        </div>
        <h1>Přihlásit se</h1>
        <div class="search-bar">
            <input class="input-text" id="username" type="text" placeholder="Uživatelské jméno ">
            <input class="input-text" id="password" type="password" placeholder="Heslo">
        </div>
        <input class="medium button" type="submit" value="Přihlásit">
        <div class="error" id="login-error" title="Chybějící data" style="display:none;">
            <p>Chybí nám některé kontaktní údaje.</p>
            <button class="close small button">Ok</button>
        </div>
    </form>
</div>


<?php
    include_once __DIR__ . '/../footer.php';
?>
</body>
</html>
