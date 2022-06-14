// responsive mode
let menu = document.querySelector("#menu-bar");
let navbar = document.querySelector(".navbar");
let shopcart = document.querySelector(".cart");

menu.onclick = () =>{
  menu.classList.toggle("fa-times");
  navbar.classList.toggle("active");
}

window.onscroll = () =>{
  menu.classList.remove("fa-times");
  navbar.classList.remove("active");
  shopcart.classList.remove("active");
  userBox.classList.remove("active");
}

let userBox =  document.querySelector("header .user-box");
document.querySelector('#user-icon').onclick = () =>{
  userBox.classList.toggle('active');
}

document.querySelector('#close-update').onclick = () =>{
    document.querySelector('.edit-product-form').style.display = 'none';
    window.location.href = 'admin_products.php';
}