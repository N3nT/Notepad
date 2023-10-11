<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style/register_style.css">
</head>
<body>
<?php
    require('dbconnection.php');
?>
<div class="wrap">
        <form action="" method="post">
            Email: <input type="email" name="email" id=""><br>
            Password: <input type="password" name="password" id=""><br>
            <input type="submit" id="register_button" value="Log in">
        </form>
<?php
    session_start();
    @$user_email = mysqli_real_escape_string($db_conn, $_POST["email"]);
    @$user_password = mysqli_real_escape_string($db_conn, $_POST['password']);
    @$query_login = mysqli_query($db_conn, "SELECT * FROM users where Email = '$user_email'");

    if(mysqli_num_rows($query_login) > 0){
        $record = mysqli_fetch_assoc($query_login);
        $hash = $record['Password'];
        if(password_verify($user_password, $hash)){
            $_SESSION['current_user'] = htmlspecialchars($user_email);
            $date_with_hours = date("Y-m-d H:i:s");
            $date_with_days = date("Y-m-d");
            $user_id = $record['ID'];

            $query_stat = mysqli_query($db_conn, "SELECT * FROM userstatistics where UserID = '$user_id'");
            $stat = mysqli_fetch_assoc($query_stat);

            $stat_totalLogin = $stat['TotalLogins'] + 1;

            mysqli_query($db_conn, "UPDATE userstatistics SET LastLogin = '$date_with_hours', TotalLogins = '$stat_totalLogin' where UserID = '$user_id';");
            $query_note = mysqli_query($db_conn, "SELECT NoteID FROM usernotes where UserID = '$user_id' and CreationDate = '$date_with_days';");
            
            if(mysqli_num_rows($query_note) == 0){
                mysqli_query($db_conn, "INSERT INTO usernotes (UserID, Content, CreationDate) values ('$user_id', '', '$date_with_days');");
            }
            header('Location: main.php');
         }
        else{
            echo "<script>alert('Something went wrong')</script>";
            $_POST = null;
        }
    }
    mysqli_close($db_conn);
?>
        <p>Do you want to create account?<br><a href="register.php">Register here!</a></p>
    </div>
</body>
</html>