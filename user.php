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
            <?php
            @$id = mysqli_fetch_assoc(mysqli_query($db_conn, "SELECT ID,ProfilePicture FROM users WHERE email = '".$_SESSION["current_user"]."';"));
            @$sql = mysqli_query($db_conn, "SELECT * FROM UserStatistics WHERE UserID = '".$id['ID']."';");
            $data = mysqli_fetch_assoc($sql);

            ?>
            <div class='user_photo' style="background: url('upload/<?php echo $id['ProfilePicture'] ?>');background-position: center; background-size: cover;"></div>
            <?php
            echo '<div class="statistic">
                <p id="email" class="stat"><span class="stat_number">'. $_SESSION["current_user"] .'</span></p>
                <p id="total_login" class="stat">Total login: <span class="stat_number">'. $data['TotalLogins'] .'</span></p>
                <p id="last_login" class="stat">Last login: <span class="stat_number">'. $data['LastLogin'] .'</span></p>
                <p id="total_notes" class="stat">Total notes: <span class="stat_number">'. $data['TotalNotes'] .'</span></p>
            </div>';
            mysqli_close($db_conn);
            ?>
        </div>
    </div>
    
    <script src="script.js"></script>
</body>
</html>