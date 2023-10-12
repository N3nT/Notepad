<!DOCTYPE html>
<html lang="pl">
<head>
    <?php
        require('dbconnection.php');
        session_start();
        if($_SESSION['current_user'] == ""){
            header("Location: login.php");
        }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write it, Burn it!</title>
    <!--<title><?php echo $_SESSION["current_user"];?></title>-->
    <link rel="stylesheet" href="style/main_style_light.css">
    <link rel="stylesheet" href="style/main_style.css">
    <link rel="stylesheet" href="style/user.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
</head>
<body onload="doSomething()">
    <menu>
        <a href="user.php" class="menu_icon"><img src="img/user.png" alt="User account"></a>
        <a href="main.php" class="menu_icon"><img src="img/notes.png" alt="Notepad"></a>
        <a href="list.php" class="menu_icon"><img src="img/callendar.png" alt="Callendar"></a>
        <a href="#" class="menu_icon"><img src="img/day-and-night.png" alt="Night Mode" onclick="toggle_mode()"></a>
        <a href="log_off.php" class="menu_icon"><img src="img/turn-off.png" alt="Log-off"></a>
    </menu>
    <div class="wrap">
        <div>
            <form action="note.php" method="POST"><table onload='correction()' class='form_table'>
            <?php
                $user_email = $_SESSION['current_user'];
                $record = mysqli_fetch_assoc(mysqli_query($db_conn, "SELECT * FROM users where Email = '$user_email';"));
                $user_id = $record['ID'];
                $sql = mysqli_query($db_conn, "SELECT * FROM usernotes WHERE UserID = '$user_id' order by CreationDate;");
                echo "<th>Data</th><th></th>";
                while($wiersz = mysqli_fetch_assoc($sql)){
                    echo "<tr><td class='tdClass'>".$wiersz['CreationDate']."</td>
                    <td><button type='submit' value='".$wiersz['CreationDate']."' name='creation_date'>Open</button></td>";
                }
                mysqli_close($db_conn);
            ?>
            </table></form>
        </div>
    </div>
    
    <script src="script.js"></script>
</body>
</html>