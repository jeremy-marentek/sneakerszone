<?php 
include 'functions.php';
session_start();
$user_id = $_SESSION['user_id'];

    if(isset($_POST['add_to_cart'])){

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];
 
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
    
    if($user_id == 0){
        header('location: login.php');
    }
    else if(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'already added to cart!';
    }else{
       mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
       $message[] = 'product added to cart!';
    }
 }
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project UTS</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<!-- header section starts  -->

<?php
include("header.php")
?>

<!-- header section ends -->

<!-- home section starts  -->

<!-- service section ends -->

<!-- products section starts  -->

<section class="products" id="products">

    <h1 class="heading-shop"> latest <span>products</span> </h1>

    <div class="box-container" id="search-container">
        <?php 
        if(isset($_GET['product'])){
            $product_id = $_GET['product'];

         $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE id ='$product_id'") or die('query failed');
        }if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
        ?>
        <form action="" method="post" class="box">
            <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
            <div class="content">
                <h3 ><?php echo $fetch_products['name']; ?></h3>
                <div class="price"><?php echo rupiah($fetch_products['price']); ?></div>
                <input type="hidden" min="1" name="product_quantity" value="1" class="qty">
                <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                <input type="submit" value="add to cart" name="add_to_cart" class="btn">
            </div>
        </form>
        <?php 
            }
         }else{
             echo '<p class="empty">no products added yet!</p>';
         }

        ?>
    </div>

</section>

<!-- products section ends -->





<!-- about section starts  -->


<!-- footer section  -->

<section class="footer">

    <div class="box-container">

        <div class="box">
            <h3>our stores</h3>
            <a href="#">Bahu, Malalayang</a>
        </div>

        <div class="box">
            <h3>quick links</h3>
            <a href="#">home</a>
            <a href="#products">products</a>
            <a href="#featured">featured</a>
            <a href="#review">review</a>
            <a href="#about">review</a>
        </div>

        <div class="box">
            <h3>extra links</h3>
            <a href="#">my account</a>
            <a href="#">my favorite</a>
            <a href="#">my orders</a>
            <a href="#">newsletter</a>
        </div>

        <div class="box">
            <h3>follow us</h3>
            <a href="#">facebook</a>
            <a href="#">twitter</a>
            <a href="#">instagram</a>
            <a href="#">linkedin</a>
        </div>

        <div class="credit">created by <span> Gabriel M </span> | all rights reserved</div>

    </div>

</section>


















<!-- custom js file link  -->
<script src="js/script.js"></script>
    
</body>
</html>