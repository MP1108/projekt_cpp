<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista broni w GTA 5</title>
    <link rel="stylesheet" href="weapons.css">
</head>
<body>
    <div class="controls">
        <button id="increase-font">A+</button>
        <button id="decrease-font">A-</button>
        <button id="toggle-dark-mode">Tryb ciemny</button>
    </div>

    <?php
    $conn = new mysqli('localhost', 'root', '', 'gta');
    $q = "SELECT * FROM bron";
    $r = $conn->query($q);
    if ($r->num_rows > 0) {
        echo "<h2>Lista broni</h2>";
        echo "<div class='table-container'>";
        echo "<table><tr><th>ID</th><th>Nazwa</th><th>Typ</th><th>Obrażenia</th><th>Opis</th><th>Akcja</th></tr>";
        while ($row = mysqli_fetch_assoc($r)) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["nazwa"] . "</td>";
            echo "<td>" . $row["typ"] . "</td>";
            echo "<td>" . $row["obrazenia"] . "</td>";
            echo "<td>" . $row["opis"] . "</td>";
            echo "<td><button class='edytuj' data-id='" . $row["id"] . "' data-nazwa='" .$row["nazwa"] . "' data-typ='" .$row["typ"] . "' data-obrazenia='" . $row["obrazenia"] . "' data-opis='" . htmlspecialchars($row["opis"]) . "'>Edytuj</button></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        echo "Brak danych.";
    }

    echo "<h2>Dodaj Broń</h2>";
    echo '<div class="form-container">';
    echo '<form method="POST" action="weapons.php">';
    echo '<div class="form-group">';
    echo '<label for="id">ID:</label>';
    echo '<input type="number" name="id" id="id" placeholder="ID" required>';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label for="nazwa">Nazwa:</label>';
    echo '<input type="text" name="nazwa" id="nazwa" placeholder="Nazwa">';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label for="typ">Typ:</label>';
    echo '<input type="text" name="typ" id="typ" placeholder="Typ">';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label for="obrazenia">Obrażenia:</label>';
    echo '<input type="number" name="obrazenia" id="obrazenia" placeholder="Obrażenia">';
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
        $obrazenia = $_POST['obrazenia'];
        $opis = $_POST['opis'];
        $q4 = "INSERT INTO `bron`(`id`, `nazwa`, `typ`, `opis`, `obrazenia`) VALUES (NULL,'$nazwa','$typ','$opis','$obrazenia')";
        $conn->query($q4);
        header("Location: weapons.php");
    }

    echo "<h2>Aktualizuj broń</h2>";
    echo '<div class="form-container">';
    echo '<form method="POST" action="">';
    echo '<div class="form-group">';
    echo '<label for="id_update">ID broni:</label>';
    echo '<input type="number" name="id" id="id_update" placeholder="ID broni" required>';
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
    echo '<label for="obrazenia_update">Obrażenia:</label>';
    echo '<input type="number" name="obrazenia" id="obrazenia_update" placeholder="Obrażenia">';
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
        $obrazenia = $_POST['obrazenia'];
        $opis = $_POST['opis'];
        $q2 = "UPDATE bron SET nazwa='$nazwa', typ='$typ', opis='$opis', obrazenia='$obrazenia' WHERE id='$id'";
        $conn->query($q2);
        header("Location: weapons.php");
    }

    echo "<h2>Usuń broń</h2>";
    echo '<div class="form-container">';
    echo '<form method="POST" action="weapons.php">';
    echo '<div class="form-group">';
    echo '<label for="id_delete">ID broni do usunięcia:</label>';
    echo '<input type="number" name="id_delete" id="id_delete" placeholder="ID broni do usunięcia" required>';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<input type="submit" name="delete" value="Usuń">';
    echo '</div>';
    echo '</form>';
    echo '</div>';

    if (isset($_POST['delete'])) {
        $id_delete = $_POST['id_delete'];
        $q3 = "DELETE FROM `bron` WHERE id='$id_delete'";
        $conn->query($q3);
        header("Location: weapons.php");
    }

    echo '<p><a href="gta.php">Powrót do strony głównej</a></p>';
    mysqli_close($conn);
    ?>

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

        const buttons = document.querySelectorAll('.edytuj');
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nazwa = this.getAttribute('data-nazwa');
                const typ = this.getAttribute('data-typ');
                const obrazenia = this.getAttribute('data-obrazenia');
                const opis = this.getAttribute('data-opis');
                const updateForm = document.querySelector('form[action=""][method="POST"]');
                updateForm.querySelector('input[name="id"]').value = id;
                updateForm.querySelector('input[name="nazwa"]').value = nazwa;
                updateForm.querySelector('input[name="typ"]').value = typ;
                updateForm.querySelector('input[name="obrazenia"]').value = obrazenia;
                if (typeof tinymce !== 'undefined') {
                    tinymce.get('opis').setContent(opis);
                } else {
                    updateForm.querySelector('textarea[name="opis"]').value = opis;
                }
            });
        });
    });
    </script>
</body>
</html>