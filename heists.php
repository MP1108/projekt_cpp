<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Napady</title>
    <link rel="stylesheet" href="heists.css">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/8svqj0643ful18uuhtv9vyoeghio49nkhmdq42hbcyavw0k9/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea.opis',
            height: 200,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste'
            ],
            toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist outdent indent | link image',
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save(); 
                });
            }
        });
    </script>
</head>
<body>
    <div class="controls">
        <button id="increase-font">A+</button>
        <button id="decrease-font">A-</button>
        <button id="toggle-dark-mode">Tryb ciemny</button>
    </div>

    <div class="container">
        <h1>Napady</h1>
        <?php
        $conn = mysqli_connect('localhost', 'root', '', 'gta');

        if (isset($_POST['insert'])) {
            $nazwa = $_POST['nazwa'];
            $lokalizacja = $_POST['lokalizacja'];
            $nagroda = $_POST['nagroda'];
            $opis = $_POST['opis'];
            $pojazd_id = $_POST['pojazd_id'] ?: null; 
            $q = "INSERT INTO napady (nazwa, lokalizacja, nagroda, opis, pojazd_id) VALUES ('$nazwa', '$lokalizacja', '$nagroda', '$opis', " . ($pojazd_id ? "'$pojazd_id'" : "NULL") . ")";
            mysqli_query($conn, $q);
            header("Location: heists.php");
            exit; 
        }

        if (isset($_POST['update'])) {
            $id = $_POST['id'];
            $nazwa = $_POST['nazwa'];
            $lokalizacja = $_POST['lokalizacja'];
            $nagroda = $_POST['nagroda'];
            $opis = $_POST['opis'];
            $pojazd_id = $_POST['pojazd_id'] ?: null;
            $q = "UPDATE napady SET nazwa='$nazwa', lokalizacja='$lokalizacja', nagroda='$nagroda', opis='$opis', pojazd_id=" . ($pojazd_id ? "'$pojazd_id'" : "NULL") . " WHERE id='$id'";
            mysqli_query($conn, $q);
            header("Location: heists.php");
            exit;
        }
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $q = "DELETE FROM napady WHERE id='$id'";
            mysqli_query($conn, $q);
            header("Location: heists.php");
            exit;
        }

        $q = "SELECT napady.*, pojazdy_specjalne.nazwa AS pojazd_nazwa 
              FROM napady 
              LEFT JOIN pojazdy_specjalne ON napady.pojazd_id = pojazdy_specjalne.id";
        $r = mysqli_query($conn, $q);

        if ($r) {
            if (mysqli_num_rows($r) > 0) {
                echo "<table class='heists-table'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Nazwa</th>";
                echo "<th>Lokalizacja</th>";
                echo "<th>Nagroda</th>";
                echo "<th>Opis</th>";
                echo "<th>Pojazd</th>"; 
                echo "<th>Akcje</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while ($row = mysqli_fetch_array($r)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nazwa'] . "</td>";
                    echo "<td>" . $row['lokalizacja'] . "</td>";
                    echo "<td>" . $row['nagroda'] . "</td>";
                    echo "<td><textarea class='opis' name='opis[]' readonly>" . $row['opis'] . "</textarea></td>";
                    echo "<td>" . ($row['pojazd_nazwa'] ? $row['pojazd_nazwa'] : 'Brak') . "</td>"; 
                    echo "<td>";
                    echo "<a href='?edit=" . $row['id'] . "' class='edit-btn'>Edytuj</a> ";
                    echo "<a href='?delete=" . $row['id'] . "' class='delete-btn' onclick='return confirm(\"Czy na pewno chcesz usunąć ten rekord?\")'>Usuń</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            }
            mysqli_free_result($r);
        }

        if (isset($_GET['edit'])) {
            $id = $_GET['edit'];
            $q = "SELECT * FROM napady WHERE id='$id'";
            $result = mysqli_query($conn, $q);
            $row = mysqli_fetch_array($result);

            echo "<h2>Edytuj Napad</h2>";
            echo '<div class="form-container">';
            echo '<form method="POST" action="heists.php">';
            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
            echo '<div class="form-group">';
            echo '<label for="nazwa_edit">Nazwa:</label>';
            echo '<input type="text" name="nazwa" id="nazwa_edit" value="' . $row['nazwa'] . '" required>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label for="lokalizacja_edit">Lokalizacja:</label>';
            echo '<input type="text" name="lokalizacja" id="lokalizacja_edit" value="' . $row['lokalizacja'] . '" required>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label for="nagroda_edit">Nagroda:</label>';
            echo '<input type="number" name="nagroda" id="nagroda_edit" value="' . $row['nagroda'] . '" required>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label for="pojazd_id_edit">Pojazd (ID):</label>';
            echo '<input type="number" name="pojazd_id" id="pojazd_id_edit" value="' . $row['pojazd_id'] . '" placeholder="ID pojazdu (opcjonalne)">';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label for="opis_edit">Opis:</label>';
            echo '<textarea name="opis" id="opis_edit" class="opis">' . $row['opis'] . '</textarea>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<input type="submit" name="update" value="Zaktualizuj">';
            echo '</div>';
            echo '</form>';
            echo '</div>';
        } else {
            echo "<h2>Dodaj Napad</h2>";
            echo '<div class="form-container">';
            echo '<form method="POST" action="heists.php">';
            echo '<div class="form-group">';
            echo '<label for="nazwa">Nazwa:</label>';
            echo '<input type="text" name="nazwa" id="nazwa" placeholder="Nazwa" required>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label for="lokalizacja">Lokalizacja:</label>';
            echo '<input type="text" name="lokalizacja" id="lokalizacja" placeholder="Lokalizacja" required>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label for="nagroda">Nagroda:</label>';
            echo '<input type="number" name="nagroda" id="nagroda" placeholder="Nagroda" required>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label for="pojazd_id">Pojazd (ID):</label>';
            echo '<input type="number" name="pojazd_id" id="pojazd_id" placeholder="ID pojazdu (opcjonalne)">';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label for="opis">Opis:</label>';
            echo '<textarea name="opis" id="opis" class="opis" placeholder="Opis"></textarea>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<input type="submit" name="insert" value="Dodaj">';
            echo '</div>';
            echo '</form>';
            echo '</div>';
        }

        echo '<p class="back-link"><a href="gta.php">Powrót do strony głównej</a></p>';

        echo '<div class="heists-links">';
        echo '<h6><a href="https://gta.fandom.com/pl/wiki/Akcja_we_Fleeca">Napad na bank Flecca</a></h6>';
        echo '<h6><a href="https://gta.fandom.com/pl/wiki/Pacific_Standard">Napad na Pacific</a></h6>';
        echo '</div>';

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