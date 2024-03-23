<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/style.css" rel="stylesheet">
    <script defer src="/js/main.js"></script>
    <title>Admin</title>
</head>
<body class="background">
<?php
include_once __DIR__ . '/../nav.php';
?>

    <div class="content">
        <h1>Admin</h1>

        <div class="blur info">
            <table>
                <thead>
                <tr>
                    <th>Activity Name</th>
                    <th>Doporučení</th>
                </tr>
                </thead>
                <tbody>
                <tr class="clickable-row" data-href="page1.html">
                    <td>Activity 1</td>
                    <td>Bezpečné</td>
                </tr>
                <tr class="clickable-row" data-href="page2.html">
                    <td>Activity 2</td>
                    <td>Vadný obsah</td>
                </tr>
                <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </div>

<?php
include_once __DIR__ . '/../footer.php';
?>
</body>
</html>