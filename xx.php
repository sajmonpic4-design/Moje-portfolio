<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$database = "aplikacja_sajmonc4";

$conn = new mysqli($host, $user, $password, $database);

if($conn->connect_error){
    die("Błąd połączenia: " . $conn->connect_error);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $tytul = $_POST['tytul'];
    $opis = $_POST['opis'];
    $technologia = $_POST['technologia'];
    
    if(empty($tytul) || empty($opis) || $technologia == " "){
        $_SESSION['komunikat'] = "<div class='error'>Wypełnij wszystkie pola!</div>";
    } else {
        $stmt = $conn->prepare("INSERT INTO pracownik(tytul, opis, technologia) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $tytul, $opis, $technologia); // 3 stringi

        if($stmt->execute()){
            $_SESSION['komunikat'] = "
                <div class='wpisy'>
                    <h2>Dodano projekt!</h2>
                    <p><b>tytuł:</b> $tytul</p>
                    <p><b>opis:</b> $opis</p>
                    <p><b>technologia:</b> $technologia</p>
                    <p><b>data_dodania:</b> " . date('Y-m-d H:i:s') . "</p>
                </div>
            ";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $_SESSION['komunikat'] = "<div class='error'>Błąd: " . $stmt->error . "</div>";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>My app market - sajmonc4</title>
</head>
<body>
    <header>
        <h1>My app market - sajmonc4</h1>
    </header>
    <hr style="color: whitesmoke; width: 80%; margin: auto; margin-top: 20px; height: 5px">
    <main>
        <section>
            <form action="" method="post" autocomplete="off"> 
                <h2>Dodaj rekord do mojej bazy danych</h2>
                <div class="pola">
                    <input type="text" name="tytul" id="tytul" placeholder="Tytuł projektu:" required> <br><br>
                    <textarea name="opis" id="opis" placeholder="Opisz swój projekt..." rows="4" cols="40" required></textarea><br><br>
                    <select name="technologia" id="technologia" required>
                        <option value=" ">||===Wybierz język programowania===||</option>
                        <option value="python">Python</option>
                        <option value="js">JavaScript</option>
                        <option value="mysql">MySQL</option>
                        <option value="php">PHP</option>
                        <option value="css">CSS</option>
                    </select><br><br>
                    <button type="submit">Wyślij</button>
                </div>
            </form>
        </section>
        <aside>
            <h2>Wpisy:</h2>
            <?php 
            if(isset($_SESSION['komunikat'])){
                echo $_SESSION['komunikat'];
                unset($_SESSION['komunikat']);
            }
            ?>
        </aside>
    </main>
</body>
</html>