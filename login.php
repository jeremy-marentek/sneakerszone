<?php 
include 'functions.php';
session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE name = '$name' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){

      $row = mysqli_fetch_assoc($select_users);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_id'] = $row['id'];
         header('location:index.php');

      }

   }else{
      $message[] = 'Username atau Password salah';
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
    <span>Login</span>
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
                <span class="title">Login</span>
                <form action="" method="post">
                    <div class="input-field">
                        <input type="text" placeholder="Enter your username" name="name" required>
                        <i class="fa-solid fa-user icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" class="password" placeholder="Enter your password" name="password" required>
                        <i class="fa-solid fa-lock icon"></i>
                        <i class="fa-solid fa-eye-slash showHidePw"></i>
                    </div>

                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="logCheck">
                            <label for="logCheck" class="text">Remember me</label>
                        </div>
                        <a href="#" class="text">Forgot password?</a>
                    </div>

                    <div class="input-field button">
                        <input type="submit" name="submit" id="submit" value="Login Now">
                    </div>
                </form>
                <div class="login-signup">
                    <span class="text">Not a member?
                        <a href="register.php" class="text signup-link">Signup now</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/script.js"></script>
</body>
</html>
