<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postacie GTA</title>
    <link rel="stylesheet" href="postacie.css">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="controls">
        <button id="increase-font">A+</button>
        <button id="decrease-font">A-</button>
        <button id="toggle-dark-mode">Tryb ciemny</button>
    </div>

    <div class="container">
        <h1>Postacie Specjalne</h1>
        <?php
        $conn = mysqli_connect('localhost', 'root', '', 'gta');
        $q = "SELECT * FROM postacie";
        $result = mysqli_query($conn, $q);

        if (mysqli_num_rows($result) > 0) {
            echo "<table class='characters-table'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Id</th>";
            echo "<th>Imię</th>";
            echo "<th>Nazwisko</th>";
            echo "<th>Rodzina</th>";
            echo "<th>Opis</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['imie'] . "</td>";
                echo "<td>" . $row['nazwisko'] . "</td>";
                echo "<td>" . $row['rodzina'] . "</td>";
                echo "<td>" . $row['opis'] . "</td>";
                echo "</tr>";
            }
            
            echo "</tbody>";
            echo "</table>";
        }

        echo "<h2>Dodaj postać</h2>";
        echo '<div class="form-container">';
        echo '<form method="POST" action="postacie.php">';
        echo '<div class="form-group">';
        echo '<label for="id">ID:</label>';
        echo '<input type="number" name="id" id="id" placeholder="ID" required>';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<label for="imie">Imię:</label>';
        echo '<input type="text" name="imie" id="imie" placeholder="Imię" required>';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<label for="nazwisko">Nazwisko:</label>';
        echo '<input type="text" name="nazwisko" id="nazwisko" placeholder="Nazwisko" required>';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<label for="rodzina">Rodzina:</label>';
        echo '<input type="text" name="rodzina" id="rodzina" placeholder="Rodzina" required>';
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
            $imie = $_POST['imie'];
            $nazwisko = $_POST['nazwisko'];
            $rodzina = $_POST['rodzina'];
            $opis = $_POST['opis'];
            $q4 = "INSERT INTO postacie (`id`, `imie`, `nazwisko`, `rodzina`, `opis`) VALUES ('$id', '$imie', '$nazwisko', '$rodzina', '$opis')";
            mysqli_query($conn, $q4);
            header("Location: postacie.php");
        }
        
        echo "<h2>Aktualizuj postać</h2>";
        echo '<div class="form-container">';
        echo '<form method="POST" action="">';
        echo '<div class="form-group">';
        echo '<label for="id_update">ID postaci:</label>';
        echo '<input type="number" name="id" id="id_update" placeholder="ID postaci" required>';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<label for="imie_update">Imię:</label>';
        echo '<input type="text" name="imie" id="imie_update" placeholder="Imię">';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<label for="nazwisko_update">Nazwisko:</label>';
        echo '<input type="text" name="nazwisko" id="nazwisko_update" placeholder="Nazwisko">';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<label for="rodzina_update">Rodzina:</label>';
        echo '<input type="text" name="rodzina" id="rodzina_update" placeholder="Rodzina">';
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
            $imie = $_POST['imie'];
            $nazwisko = $_POST['nazwisko'];
            $rodzina = $_POST['rodzina'];
            $opis = $_POST['opis'];
            $q2 = "UPDATE postacie SET imie='$imie', nazwisko='$nazwisko', rodzina='$rodzina', opis='$opis' WHERE id='$id'";
            mysqli_query($conn, $q2);
            header("Location: postacie.php");
        }
        
        echo "<h2>Usuń postać</h2>";
        echo '<div class="form-container">';
        echo '<form method="POST" action="postacie.php">';
        echo '<div class="form-group">';
        echo '<label for="id_delete">ID postaci do usunięcia:</label>';
        echo '<input type="number" name="id_delete" id="id_delete" placeholder="ID postaci do usunięcia" required>';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<input type="submit" name="delete" value="Usuń">';
        echo '</div>';
        echo '</form>';
        echo '</div>';
        
        if (isset($_POST['delete'])) {
            $id_delete = $_POST['id_delete'];
            $q3 = "DELETE FROM postacie WHERE id='$id_delete'";
            mysqli_query($conn, $q3);
            header("Location: postacie.php");
        }
        
        echo '<p><a href="gta.php">Powrót do strony głównej</a></p>';
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