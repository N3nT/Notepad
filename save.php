<?php
    require('dbconnection.php');
    session_start();
    session_start();
        if($_SESSION['current_user'] == ""){
            header("Location: login.php");
        }
        else{
            $textarea = mysqli_real_escape_string($db_conn, $_POST['note']);
            $cookie_streak = $_POST['input_streak'];
            $user_email = $_SESSION['current_user'];
            $date_with_days = date("Y-m-d");

            $record = mysqli_fetch_assoc(mysqli_query($db_conn, "SELECT * FROM users where Email = '$user_email';"));
            $user_id = $record['ID'];
            mysqli_query($db_conn, "UPDATE usernotes SET Content = '$textarea' where UserID = '$user_id' and CreationDate = '$date_with_days';");
            $total_note = mysqli_num_rows(mysqli_query($db_conn, "SELECT NoteID FROM usernotes where UserID = '$user_id';"));
            $actual_total_note = mysqli_fetch_assoc(mysqli_query($db_conn, "SELECT TotalNotes FROM userstatistics WHERE UserID = '$user_id';"));
            if($actual_total_note['TotalNotes'] < $total_note){
                mysqli_query($db_conn, "UPDATE userstatistics SET TotalNotes = '$total_note' where UserID = '$user_id';");
            }
        }   
    mysqli_close($db_conn);
    header("Location: main.php");
?>