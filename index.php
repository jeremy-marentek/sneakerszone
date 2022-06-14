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

<section class="home" id="home">

    <div class="slide-container active">
        <div class="slide">
            <div class="content">
                <span>nike red shoes</span>
                <h3 class = "product-title"> nike metcon shoes</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat maiores et eos eaque veritatis aut laboriosam earum dolorem iste atque.</p>
            </div>
            <div class="image">
                <img src="images/home-shoe-1.png" class="shoe" alt="">
                <img src="images/home-text-1.png" class="text" alt="">
            </div>
        </div>
    </div>

    <div class="slide-container">
        <div class="slide">
            <div class="content">
                <span>nike blue shoes</span>
                <h3>nike metcon shoes</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat maiores et eos eaque veritatis aut laboriosam earum dolorem iste atque.</p>
            </div>
            <div class="image">
                <img src="images/home-shoe-2.png" class="shoe" alt="">
                <img src="images/home-text-2.png" class="text" alt="">
            </div>
        </div>
    </div>

    <div class="slide-container">
        <div class="slide">
            <div class="content">
                <span>nike yellow shoes</span>
                <h3>nike metcon shoes</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat maiores et eos eaque veritatis aut laboriosam earum dolorem iste atque.</p>
            </div>
            <div class="image">
                <img src="images/home-shoe-3.png" class="shoe" alt="">
                <img src="images/home-text-3.png" class="text" alt="">
            </div>
        </div>
    </div>

    <div id="prev" class="fas fa-chevron-left" onclick="prev()"></div>
    <div id="next" class="fas fa-chevron-right" onclick="next()"></div>

</section>

<!-- home section ends -->

<!-- service section starts  -->

<section class="service">

    <div class="box-container">

        <div class="box">
            <i class="fas fa-shipping-fast"></i>
            <h3>Pengiriman Cepat</h3>
            <p>Tidak Perlu Menunggu Lama.</p>
        </div>

        <div class="box">
            <i class="fas fa-undo"></i>
            <h3>Garansi 10 hari</h3>
            <p>Untuk semua produk</p>
        </div>

        <div class="box">
            <i class="fas fa-headset"></i>
            <h3>Fast Respon</h3>
            <p>Respon cepat untuk para pelanggan</p>
        </div>

    </div>

</section>

<!-- service section ends -->

<!-- products section starts  -->


<section class="products" id="products">

    <h1 class="heading"> latest <span>products</span> </h1>

    <div class="box-container" id="search-container">
        <?php 
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 4") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
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
    <div class="load-more" style="margin-top: 2rem; text-align:center">
            <a href="shop.php" class="option-btn">load more</a>
              </div>
</section>

<!-- products section ends -->

<!-- featured section starts  -->


<!-- featured section ends -->

<!-- review section starts  -->

<section class="review" id="review">

    <h1 class="heading"> customer's <span> review </span> </h1>

    <div class="box-container">

        <div class="box">
            <img src="images/pic1.png" alt="">
            <h3>john deo</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugiat, quos eum. Laborum aut a consequatur ducimus, molestias possimus quisquam rerum temporibus ipsum voluptate accusamus, unde ab asperiores? Exercitationem, unde rem.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
            </div>
        </div>

        <div class="box">
            <img src="images/pic2.png" alt="">
            <h3>john deo</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugiat, quos eum. Laborum aut a consequatur ducimus, molestias possimus quisquam rerum temporibus ipsum voluptate accusamus, unde ab asperiores? Exercitationem, unde rem.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
        </div>

        <div class="box">
            <img src="images/pic3.png" alt="">
            <h3>john deo</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugiat, quos eum. Laborum aut a consequatur ducimus, molestias possimus quisquam rerum temporibus ipsum voluptate accusamus, unde ab asperiores? Exercitationem, unde rem.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
        </div>

    </div>

</section>

<!-- review section ends -->

<!-- about section starts  -->

<section class="review" id="about">

    <h1 class="heading"> <span>About</span> Us </h1>

<div class="slider-container">
    <div>

    </div>
    <div class="slider">
      <div>
        <img src="images/jeremy.jpg" class="person-img" alt="" />
        <h4>Gabriel Marentek | 20021106087</h4>
        <h1>1</h1>
      </div>
    </div>
    <div class="slider">
      <div>
        <img src="images/edyss.jpg" class="person-img" alt=""  />
        <h4>Gledys Langi | 20021106025</h4>
        <h1>2</h1>
      </div>
    </div>
    <div class="slider">
      <div>
        <img src="images/ariel.jpg" class="person-img" alt="" />
        <h4>Ariel Runtuarow | 20021106034</h4>
        <h1>3</h1>
      </div>
    </div>
    <div class="slider">
      <div>
        <img src="images/josh.jpg" class="person-img" alt="" />
        <h4>Joshua Korobu | 20021106018</h4>
        <h1>4</h1>
      </div>
    </div>
  </div>
  <div class="btn-container">
    <button type="button" class="prevBtn">
      prev
    </button>
    <button type="button" class="nextBtn">
      next
    </button>
  </div>
</section>

<!-- footer section  -->

<?php 

include 'footer.php';

?>


















<!-- custom js file link  -->
<script src="js/script.js"></script>
    
</body>
</html>