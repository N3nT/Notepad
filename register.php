<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require("dbconnection.php");
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style/register_style.css">
</head>
<body>
    <div class="wrap">
        <form action="" method="post" enctype="multipart/form-data">
            Name: <input type="text" name="name" id=""><br>
            Surname: <input type="text" name="surname" id=""><br>
            Email: <input type="email" name="email" id=""><br>
            Password: <input type="password" name="password" id=""><br>
            Confirm password: <input type="password" name="confirm_password" id=""><br>
            Profile photo: <input type="file" name="profile_photo" id="">
            <input type="submit" id="register_button" value="Register">
        </form>
        <?php
            session_start();
            @$user_name = mysqli_real_escape_string($db_conn, $_POST["name"]);
            @$user_surname = mysqli_real_escape_string($db_conn, $_POST["surname"]);
            @$user_email = mysqli_real_escape_string($db_conn, $_POST["email"]);
            @$user_password = mysqli_real_escape_string($db_conn, $_POST["password"]);
            @$user_confirm_password = mysqli_real_escape_string($db_conn, $_POST["confirm_password"]);
            @$user_photo = $_FILES["profile_photo"];

            if($user_password == $user_confirm_password){
                $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);
                if($user_name == null or $user_surname == null or $user_email == null or $user_password == null or $user_confirm_password == null or $user_photo == null){

                }
                else{
                    if(mysqli_num_rows(mysqli_query($db_conn, "SELECT Email From users where email = '".$user_email."';")) != 0){
                        $_POST = null;
                    }
                    else{
                        $img_name = $_FILES['profile_photo']['name'];
                        $tmp_name = $_FILES['profile_photo']['tmp_name'];
                        $error = $_FILES['profile_photo']['error'];

                        if($error === 0){
                            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                            $img_ex_to_lc = strtolower($img_ex);
                            $allowed_exs = array('jpg', 'jpeg', 'png');
                            if(in_array($img_ex_to_lc, $allowed_exs)){
                                $new_img_name = uniqid($user_name, true).'.'.$img_ex_to_lc;
                                $img_upload_path = 'upload/'.$new_img_name;
                                move_uploaded_file($tmp_name, $img_upload_path);
                            }
                            else{
                                echo "<script>alert('Wrong file format')</script>";
                            }
                        }
                        mysqli_query($db_conn, "INSERT INTO users(FirstName, LastName, Email, Password, ProfilePicture) values ('$user_name','$user_surname','$user_email','$user_password_hash','$new_img_name')");
                        $today = date("Y-m-d H:i:s"); 
                        $sql = mysqli_query($db_conn, "SELECT * FROM users where email = '".$user_email."';");
                        $row = mysqli_fetch_assoc($sql);
                        $user_id = $row['ID'];
                        mysqli_query($db_conn, "INSERT INTO userstatistics(UserID, TotalLogins, TotalNotes, DaysRow, LastLogin) values ('$user_id','0','0','0','$today')");
                        header('Location: login.php');
                    }
                }
            }
            else{
                echo "<script>alert('Your email is occupied')</script>";
            }
            mysqli_close($db_conn);
        ?>
        <p>Do you have account?<br><a href="login.php">Log in!</a></p>
    </div>
</body>
</html>