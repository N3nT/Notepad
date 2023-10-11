<!DOCTYPE html>
<html lang="pl">
<head>
    <?php
        require('dbconnection.php');
        session_start();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write it, Burn it!</title>
    <!--<title><?php echo $_SESSION["current_user"];?></title>-->
    <link rel="stylesheet" href="style/main_style_light.css">
    <link rel="stylesheet" href="style/main_style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
</head>
<body onload="doSomething()">
    <menu>
        <a href="user.php" class="menu_icon"><img src="img/user.png" alt="User account"></a>
        <a href="main.php" class="menu_icon"><img src="img/notes.png" alt="Notepad"></a>
        <a href="list.php" class="menu_icon"><img src="img/callendar.png" alt="Callendar"></a>
        <a href="#" class="menu_icon"><img src="img/settings.png" alt="Settings"></a>
        <a href="#" class="menu_icon"><img src="img/day-and-night.png" alt="Night Mode" onclick="toggle_mode()"></a>
    </menu>
    <div class="wrap">
        <div>
            <?php
                $user_email = $_SESSION['current_user'];
                $record = mysqli_fetch_assoc(mysqli_query($db_conn, "SELECT * FROM users where Email = '$user_email';"));
                $user_id = $record['ID'];
                $creation_date = $_POST['creation_date'];
                $query_note = mysqli_query($db_conn, "SELECT Content FROM usernotes where UserID = '$user_id' and CreationDate = '$creation_date';");
                $note = mysqli_fetch_assoc($query_note);
                echo '<textarea name="note" id="notepad" cols="146" rows="40" maxlenght="5945" disabled>'.$note['Content'].'</textarea>';
            ?>
        </div>
    </div>
    
    <script src="script.js"></script>
</body>
</html>