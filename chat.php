<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GTA Chat z Franklinem</title>
    <link rel="stylesheet" href="chat.css">
</head>
<body>
    <div id="container">
        <h1>GTA Chat z Franklinem</h1>
        <div id="chat"></div>
        <div id="input-area">
            <input type="text" id="wiadomosc" placeholder="Wpisz wiadomość...">
            <button onclick="wyslij()">Wyślij</button>
            <button onclick="generuj()">Odpowiedź od Franklina</button>
        </div>
    </div>
    <div class="footer">
        <p><a href="gta.php">Powrót do strony głównej</a></p>
    </div>
    <script src="script.js"></script>
</body>
</html>