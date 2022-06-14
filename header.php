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


if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
    header('location:index.php');
 }
//  if(isset($_GET['product'])){
//     $product_id = $_GET['delete'];
//     mysqli_query($conn, "SELECT * FROM `cart` WHERE id = '$product_id'") or die('query failed');
//     header('location:product.php');
//  }

?>


<header>
    <div id="menu-bar" class="fas fa-bars"></div>

    <a href="index.php" class="logo">Sneakers Zone</a>

    <nav class="navbar">
        <a href="index.php">home</a>
        <a href="shop.php">shop</a>
        <a href="orders.php">orders</a>
    </nav>

    <div class="search">
        <form action="" method="post">
        <input type="text" class="hide" name="search" id="keyword" placeholder="Search Product Here">
        <button type="submit" name="submit"></i>
        </form>
    </div>


    <div class="icons">
    <?php
        $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        $cart_rows_number = mysqli_num_rows($select_cart_number); 
    ?> 
    <label for="keyword" class="fas fa-search search-icon"></label> 
        <i class="fas fa-user" id="user-icon"></i>
          <a href ="cart.php" class="fas fa-cart-arrow-down fa-2x cart-icon"><span>(<?php echo $cart_rows_number; ?>)</span></a>
    </div>

    <div class="user-box">
        <?php if(!isset($_SESSION["user_name"])){ ?>
        <a href="login.php" class="option-btn">Login</a>
        <?php }else{ ?>
        <p>username: <span><?php echo $_SESSION["user_name"]; ?></span></p> 
        <a href="logout.php" class="delete-btn">Logout</a>   
        <?php } ?>
    </div>
    <!-- cart side-bar      -->
      <div class="cart-box">
        <div class="whole-cart-window hide">
          <h2>Shopping Bag</h2>
          <div class="cart-wrapper">
            <?php 
                $grand_total=0;
                $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
                $fetch_products = mysqli_fetch_assoc($select_products);
                 $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                 if(mysqli_num_rows($select_cart) > 0){
                    while($fetch_cart = mysqli_fetch_assoc($select_cart)){  
            ?>
            <div class="cart-item">
                       <img src="uploaded_img/<?php echo $fetch_cart['image']?>"> 
                       <div class="details">
                           <h3><?php echo $fetch_cart['name']?></h3>
                           <p>
                            <span class="price"><?php echo rupiah($fetch_cart['price']); ?></span>
                               <span class="price"><?php $fetch_cart['price']; ?></span>
                           </p>
                       </div>
                       <div class="cancel"><a href="index.php?delete=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('delete this from cart?');" class="fas fa-window-close"></a></div>
            </div> 
            <?php }};?>
          </div>
          <?php 
           $grand_total=0;
            $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
            if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){ 
                $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']);
                $grand_total += $sub_total;?>    
                            <?php }}; ?>
          <div class="subtotal">Total : <?php echo rupiah($grand_total) ?></div>
          <div class="view-cart">
             <a href="cart.php">View Cart</a>
            </div>
        </div>
      </div>

      <!-- search -->
      <div class="search-box">
        <div class="whole-search-window hide">
        <i class="fa-solid fa-xmark close-search" id="close-search"></i>
          <h2>Result :</h2>
          <div class="search-wrapper">
          <?php
      if(isset($_POST['submit'])){ ?>
      <script>
          let searchBox = document.querySelector('header .whole-search-window');
        searchBox.classList.toggle('hide');
        document.querySelector('.close-search').onclick= () =>{
   searchBox.classList.toggle('hide');
}
        
      </script>
         <?php $search_item = $_POST['search'];
         $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE name LIKE '%{$search_item}%'") or die('query failed'); ?>
        <?php if(mysqli_num_rows($select_products) > 0){ ?>
            <?php while($fetch_product = mysqli_fetch_assoc($select_products)){ ?>
            <div class="search-item">
                    <a href="product.php?product=<?php echo $fetch_product['id']?>">
                       <img src="uploaded_img/<?php echo $fetch_product['image']?>"> 
                       </a>
                       <div class="details">
                           <h3><a href="product.php?product=<?php echo $fetch_product['id']?>"><?php echo $fetch_product['name'] ?></a></h3>
                           <p>
                            <span class="price"><?php echo rupiah($fetch_product['price']); ?></span>
                               <span class="price"><?php $fetch_product['price']; ?></span>
                           </p>
                       </div>
            </div> 
            <?php
            }
         }else{
            echo '<p class="empty">no result found!</p>';
         }
      }
   ?>     
          </div>
          <!-- <div class="view-cart">
             <a href="cart.php">View Cart</a>
            </div> -->
        </div>
      </div>
</header>
