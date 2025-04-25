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
    <title>Strona fanowska GTA5 i GTA6</title>
    <link rel="stylesheet" href="gta.css">
</head>
<body>
    <div class="controls">
        <button id="increase-font">A+</button>
        <button id="decrease-font">A-</button>
        <button id="toggle-dark-mode">Tryb ciemny</button>
    </div>

    <div class="preloader" id="preloader">
        <img src="logoG6.png" alt="Logo GTA 6">
    </div>

    <iframe class="video-background" src="https://www.youtube.com/embed/QdBZY2fkU-0?autoplay=1&mute=1&controls=0&loop=1&playlist=QdBZY2fkU-0" frameborder="0" allow="autoplay"></iframe>

    <header>
        <img src="logoG5.png" alt="Logo GTA 5">
        <img src="logoG6.png" alt="Logo GTA 6">
    </header>

    <h1>Strona fanowska GTA5 i GTA6</h1>
    <div class="links">
        <a href="weapons.php" target="_blank">Broń w GTA 5</a>
        <a href="vehicles.php" target="_blank">Pojazdy w GTA 5</a>
        <a href="heists.php" target="_blank">Napady w GTA 5</a>
        <a href="postacie.php" target="_blank">Postacie w GTA 5</a>
        <a href="chat.php" target="_blank">Chat z Franklinem</a>
    </div>

    <div class="footer">
        <p>GTA Fan Page - <a href="https://www.rockstargames.com/" target="_blank">Oficjalna strona Rockstar Games</a></p>
    </div>

    <script>
    setTimeout(() => {
        const preloader = document.getElementById('preloader');
        preloader.classList.add('hidden');
        
        setTimeout(() => {
            preloader.style.display = 'none';
        }, 1000);
    }, 3000);
    
    const body = document.body;
    const increaseBtn = document.getElementById('increase-font');
    const decreaseBtn = document.getElementById('decrease-font');
    const darkModeBtn = document.getElementById('toggle-dark-mode');
    let fontSize = 16; 

    increaseBtn.addEventListener('click', () => {
        fontSize += 2;
        body.style.fontSize = fontSize + 'px';
    });

    decreaseBtn.addEventListener('click', () => {
        fontSize -= 2;
        if (fontSize < 12) fontSize = 12; 
        body.style.fontSize = fontSize + 'px';
    });

    darkModeBtn.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
        darkModeBtn.textContent = body.classList.contains('dark-mode') ? 'Tryb jasny' : 'Tryb ciemny';
    });
</script>
</body>
</html>