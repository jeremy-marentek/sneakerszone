<?php
$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}
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

<header>
    <div id="menu-bar" class="fas fa-bars"></div>

    <a href="#" class="logo">Admin Panel</a>

    <nav class="navbar">
        <a href="admin_page.php">Dashboard</a>
        <a href="admin_products.php">Products</a>
        <a href="admin_users.php">Users</a>
        <a href="admin_orders.php">Orders</a>
    </nav>


    <div class="icons">
        <i></i>
        <i></i>
        <i></i>
        <i></i>
        <i></i>
        <i></i>
        <i class="fas fa-user" id="user-icon"></i>
    </div>

    <div class="user-box">
        <?php if(!isset($_SESSION["admin_name"])){ ?>
        <a href="login.php" class="delete-btn">Login</a>
        <?php }else{ ?>
        <p>username: <span><?php echo $_SESSION["admin_name"]; ?></span></p> 
        <a href="logout.php" class="delete-btn">Logout</a>   
        <?php } ?>
    </div>
</header>