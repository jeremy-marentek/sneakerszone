<?php

include 'functions.php';

session_start();

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $placed_on = date('d-M-Y');
   $latitude = $_POST["latitude"];
   $longitude = $_POST["longitude"];

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_products = implode(', ',$cart_products);

   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE  name = '$name' AND number = '$number' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

   if($cart_total == 0){
      $message[] = 'your cart is empty';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'order already placed!'; 
      }else{
         mysqli_query($conn, "INSERT INTO `orders`(user_id, name, latitude, longitude, number, total_products, total_price, placed_on) VALUES('$user_id', '$name','$latitude','$longitude', '$number', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
         $message[] = 'order placed successfully!';
         mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         header("location:https://api.whatsapp.com/send?phone=6282196452272&text=Cek%20pesanan%20saya%20User%20Id:%20$user_id%20%0DNama:%20$user_name%20%0D");
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
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body onload = "getLocation();">
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>checkout</h3>
</div>

<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>
   <p><?php echo $fetch_cart['name']; ?> <span>(<?php echo rupiah($fetch_cart['price']).' x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">your cart is empty</p>';
   }
   ?>
   <div class="grand-total"> grand total : <span><?php echo rupiah($grand_total); ?></span> </div>

</section>

<section class="checkout-page">

   <form class="myForm" action="" method="post">
      <h3>place your order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>Nama :</span>
            <input type="text" name="name" required placeholder="enter your name">
         </div>
         <div class="inputBox">
            <span>Nomor HP:</span>
            <input type="number" name="number" required placeholder="enter your number">
         </div>
         <input type="hidden" name="latitude" value="">
         <input type="hidden" name="longitude" value="">

      </div>
      <input type="submit" value="order now" class="btn" name="order_btn">
   </form>
</section>
<script type="text/javascript">
      function getLocation(){
         if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(showPosition, showError);
         }
      }
      function showPosition(position){
         document.querySelector('.myForm input[name = "latitude"]').value = position.coords.latitude;
         document.querySelector('.myForm input[name = "longitude"]').value = position.coords.longitude;
      }
      function showError(error){
         switch(error.code){
            case error.PERMISSION_DENIED:
            alert("Allow Location");
            location.reload();
            break;
         }
      }
</script>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
