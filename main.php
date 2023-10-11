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
<body onload="doSomething(), write_date()">
    <menu>
        <a href="user.php" class="menu_icon"><img src="img/user.png" alt="User account"></a>
        <a href="main.php" class="menu_icon"><img src="img/notes.png" alt="Notepad"></a>
        <a href="list.php" class="menu_icon"><img src="img/callendar.png" alt="Callendar"></a>
        <a href="#" class="menu_icon"><img src="img/settings.png" alt="Settings"></a>
        <a href="#" class="menu_icon"><img src="img/day-and-night.png" alt="Night Mode" onclick="toggle_mode()"></a>
    </menu>
    <div id="headline"></div>
    <form action="save.php" method="post" onload="checkStreak()">
        <input type="hidden" value = "" id="input_streak" name='input_streak'>
        <?php
            $user_email = $_SESSION['current_user'];
            $record = mysqli_fetch_assoc(mysqli_query($db_conn, "SELECT * FROM users where Email = '$user_email';"));
            $user_id = $record['ID'];
            $date_with_days = date("Y-m-d");
            $query_note = mysqli_query($db_conn, "SELECT Content FROM usernotes where UserID = '$user_id' and Content = '' and CreationDate = '$date_with_days';");
            if(mysqli_num_rows($query_note) == 1){
                echo '<textarea name="note" id="notepad" cols="146" rows="40" maxlenght="5945"></textarea>';
            }
            else{
                $note = mysqli_fetch_assoc(mysqli_query($db_conn, "SELECT Content FROM usernotes where UserID = '$user_id' and CreationDate = '$date_with_days';"));
                echo '<textarea name="note" id="notepad" cols="146" rows="40" maxlenght="5945">'.$note['Content'].'</textarea>';
            }
        ?>
        <button type="submit" class="save button" class="button">Save</button></div>
    </form>
    <div class="clear button" class="button" onclick="clear_textarea()">Clear</div>
    <script src="script.js"></script>
</body>
</html>