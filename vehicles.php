<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pojazdy Specjalne</title>
    <link rel="stylesheet" href="vehicles.css">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="controls">
        <button id="increase-font">A+</button>
        <button id="decrease-font">A-</button>
        <button id="toggle-dark-mode">Tryb ciemny</button>
    </div>

    <div class="container">
        <h1>Pojazdy Specjalne</h1>
        <?php
        $conn = mysqli_connect('localhost', 'root', '', 'gta');

        $q = "SELECT * FROM pojazdy_specjalne"; 
        $result = mysqli_query($conn, $q);

        if (mysqli_num_rows($result) > 0) {
            echo "<table class='vehicles-table'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Nazwa</th>";
            echo "<th>Typ</th>";
            echo "<th>Opis</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nazwa'] . "</td>";
                echo "<td>" . $row['typ'] . "</td>";
                echo "<td>" . $row['opis'] . "</td>";
                echo "</tr>";
            }
            
            echo "</tbody>";
            echo "</table>";
        }

        echo "<h2>Dodaj pojazd specjalny</h2>";
        echo '<div class="form-container">';
        echo '<form method="POST" action="vehicles.php">';
        echo '<div class="form-group">';
        echo '<label for="id">ID:</label>';
        echo '<input type="number" name="id" id="id" placeholder="ID" required>';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<label for="nazwa">Nazwa:</label>';
        echo '<input type="text" name="nazwa" id="nazwa" placeholder="Nazwa" required>';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<label for="typ">Typ:</label>';
        echo '<input type="text" name="typ" id="typ" placeholder="Typ">';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<label for="opis">Opis:</label>';
        echo '<textarea name="opis" id="opis" placeholder="Opis"></textarea>';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<input type="submit" name="insert" value="Dodaj">';
        echo '</div>';
        echo '</form>';
        echo '</div>';
        
        if (isset($_POST['insert'])) {
            $id = $_POST['id'];
            $nazwa = $_POST['nazwa'];
            $typ = $_POST['typ'];
            $opis = $_POST['opis'];
            $q4 = "INSERT INTO pojazdy_specjalne (`id`, `nazwa`, `typ`, `opis`) VALUES ('$id', '$nazwa', '$typ', '$opis')";
            mysqli_query($conn, $q4);
            header("Location: vehicles.php");
        }
        
        echo "<h2>Aktualizuj pojazd specjalny</h2>";
        echo '<div class="form-container">';
        echo '<form method="POST" action="">';
        echo '<div class="form-group">';
        echo '<label for="id_update">ID pojazdu:</label>';
        echo '<input type="number" name="id" id="id_update" placeholder="ID pojazdu" required>';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<label for="nazwa_update">Nazwa:</label>';
        echo '<input type="text" name="nazwa" id="nazwa_update" placeholder="Nazwa">';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<label for="typ_update">Typ:</label>';
        echo '<input type="text" name="typ" id="typ_update" placeholder="Typ">';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<label for="opis_update">Opis:</label>';
        echo '<textarea name="opis" id="opis_update" placeholder="Opis"></textarea>';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<input type="submit" name="update" value="Aktualizuj">';
        echo '</div>';
        echo '</form>';
        echo '</div>';
        
        if (isset($_POST["update"])) {
            $id = $_POST['id'];
            $nazwa = $_POST['nazwa'];
            $typ = $_POST['typ'];
            $opis = $_POST['opis'];
            $q2 = "UPDATE pojazdy_specjalne SET nazwa='$nazwa', typ='$typ', opis='$opis' WHERE id='$id'";
            mysqli_query($conn, $q2);
            header("Location: vehicles.php");
        }
        
        echo "<h2>Usuń pojazd specjalny</h2>";
        echo '<div class="form-container">';
        echo '<form method="POST" action="vehicles.php">';
        echo '<div class="form-group">';
        echo '<label for="id_delete">ID pojazdu do usunięcia:</label>';
        echo '<input type="number" name="id_delete" id="id_delete" placeholder="ID pojazdu do usunięcia" required>';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<input type="submit" name="delete" value="Usuń">';
        echo '</div>';
        echo '</form>';
        echo '</div>';
        
        if (isset($_POST['delete'])) {
            $id_delete = $_POST['id_delete'];
            $q3 = "DELETE FROM pojazdy_specjalne WHERE id='$id_delete'";
            mysqli_query($conn, $q3);
            header("Location: vehicles.php");
        }
        
        echo '<p class="back-link"><a href="gta.php">Powrót do strony głównej</a></p>';
        mysqli_close($conn);
        ?>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
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
    });
    </script>
</body>
</html>