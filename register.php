<?php 

include 'functions.php';

if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
    $user_type = $_POST['user_type'];
 
    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE name = '$name' AND password = '$pass'") or die('query failed');
 
    if(mysqli_num_rows($select_users) > 0){
       $message[] = 'Pengguna sudah ada';
    }else{
       if($pass != $cpass){
          $message[] = 'Konfirm pass tidak sesuai';
       }else{
          mysqli_query($conn, "INSERT INTO `users`(name, password, user_type) VALUES('$name', '$cpass', '$user_type')") or die('query failed');
          $message[] = 'Pendaftaran berhasil';
          header('location:login.php');
       }
    }
 
} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    
</head>
<body>
    <div class="headerLogin">
        <a href="index.php" class="logo">Sneakers Zone
        </a>
        <span>Register</span>
    </div>




<div class="login-content">
    <div class="container">
    <?php
    if(isset($message)){
     foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
        <div class="forms">
            <div class="form login">
                <span class="title">Register</span>

                <form action="" method="post">
                    <div class="input-field">
                        <input type="text" name="name" id="username" placeholder="Enter your username" required>
                        <i class="fa-solid fa-user icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" class="password" id="password" placeholder="Enter your password" required>
                        <i class="fa-solid fa-lock icon"></i>
                        <i class="fa-solid fa-eye-slash showHidePw"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="cpassword" class="password" placeholder="Confirm your password" required>
                        <i class="fa-solid fa-lock icon"></i>
                        <i class="fa-solid fa-eye-slash showHidePw"></i>
                        <input type="hidden" name="user_type" class="box" value="user">
                    </div>
                    
                    <div class="input-field button">
                        <input type="submit" name="submit" id="submit" value="Register Now">
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Already have account?
                        <a href="login.php" class="text signup-link">Login now</a>
                    </span>
        </div>
    </div>
</div>

<script src="script.js"></script>
</body>
</html>
