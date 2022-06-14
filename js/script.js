// let users = [];

// const addUser = (ev) => {
//   ev.preventDefault;
//   let user = {
//     username: document.getElementById('username').value,
//     password: document.getElementById('password').value
//   }
//   users.push(user);
//   document.forms[0].reset();

//   console.warn('added', {users});

//   localStorage.setItem('User', JSON.stringify(users));
// }

// document.addEventListener('DOMContentLoaded', ()=>{
//   document.getElementById('submit').addEventListener('click', addUser);
// });

// access js data dalam php 

//showHidePw
const container = document.querySelector(".container"),
      pwShowHide = document.querySelectorAll(".showHidePw"),
      pwFields = document.querySelectorAll(".password"),
      signUp = document.querySelector(".signup-link"),
      login = document.querySelector(".login-link");

    //   js code to show/hide password and change icon
    pwShowHide.forEach(eyeIcon =>{
        eyeIcon.addEventListener("click", ()=>{
            pwFields.forEach(pwField =>{
                if(pwField.type ==="password"){
                    pwField.type = "text";

                    pwShowHide.forEach(icon =>{
                        icon.classList.replace("fa-eye-slash", "fa-eye");
                    })
                }else{
                    pwField.type = "password";

                    pwShowHide.forEach(icon =>{
                        icon.classList.replace("fa-eye", "fa-eye-slash");
                    })
                }
            }) 
        })
    })

    // js code to appear signup and login form


// slider home
let slides = document.querySelectorAll(".slide-container");
let index = 0;

function next(){
  slides[index].classList.remove("active");
  index = (index + 1) % slides.length;
  slides[index].classList.add("active");
}

function prev(){
  slides[index].classList.remove("active");
  index = (index - 1 + slides.length) % slides.length;
  slides[index].classList.add("active");
}

//featured
document.querySelectorAll(".featured-image-1").forEach(image_1 =>{
  image_1.addEventListener("click", () =>{
    var src = image_1.getAttribute("src");
    document.querySelector(".big-image-1").src = src;
  });
});

document.querySelectorAll(".featured-image-2").forEach(image_2 =>{
  image_2.addEventListener("click", () =>{
    var src = image_2.getAttribute("src");
    document.querySelector(".big-image-2").src = src;
  });
});

document.querySelectorAll(".featured-image-3").forEach(image_3 =>{
  image_3.addEventListener("click", () =>{
    var src = image_3.getAttribute("src");
    document.querySelector(".big-image-3").src = src;
  });
});

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
  userBox.classList.remove("active");
}


let userBox = document.querySelector('header .user-box');

document.querySelector('#user-icon').onclick = () =>{
   userBox.classList.toggle('active');
   navbar.classList.remove('active');
}

// let searchBox = document.querySelector('header .search-product');

// document.querySelector('#search-icon').onclick = () =>{
//    searchBox.classList.toggle('active');
//    navbar.classList.remove('active');
// }

// LIVESEARCH

// var keyword = document.getElementById('keyword');
// var tombolCari = document.getElementById('tombol-cari');
// var searchContainer = document.getElementById('search-container');

// keyword.addEventListener('keyup', function(){
//   var xhr = new XMLHttpRequest();

//   xhr.onreadystatechange = function(){
//     if(xhr.readyState == 4 & xhr.status== 200){
//        searchContainer.innerHTML = xhr.responseText;
//     }
//   }
  
//   xhr.open('GET', 'ajax/products.php?keyword=' + keyword.value, true);
//   xhr.send();

// })

// cart

class CartItem{
  constructor(name, desc, img, price){
      this.name = name
      this.desc = desc
      this.img=img
      this.price = price
      this.quantity = 1
 }
}


const cartIcon = document.querySelector('.cart-icon')
const wholeCartWindow = document.querySelector('.whole-cart-window')
wholeCartWindow.inWindow = 0


cartIcon.addEventListener('mouseover', ()=>{
if(wholeCartWindow.classList.contains('hide'))
wholeCartWindow.classList.remove('hide')
})

cartIcon.addEventListener('mouseleave', ()=>{
  // if(wholeCartWindow.classList.contains('hide'))
  setTimeout( () =>{
      if(wholeCartWindow.inWindow===0){
          wholeCartWindow.classList.add('hide')
      }
  } ,500 )
  
  })

wholeCartWindow.addEventListener('mouseover', ()=>{
   wholeCartWindow.inWindow=1
})  

wholeCartWindow.addEventListener('mouseleave', ()=>{
  wholeCartWindow.inWindow=0
  wholeCartWindow.classList.add('hide')
})  

// search
let searchText = document.querySelector('header #keyword');

document.querySelector('.search-icon').onclick= () =>{
   searchText.classList.toggle('hide');
}

  
// about

const slider = document.querySelectorAll(".slider");
const nextBtn = document.querySelector(".nextBtn");
const prevBtn = document.querySelector(".prevBtn");
slider.forEach(function (slide, index) {
  slide.style.left = `${index * 100}%`;
});

let counter = 0;
nextBtn.addEventListener("click", function () {
  counter++;
  carousel();
});

prevBtn.addEventListener("click", function () {
  counter--;
  carousel();
});


function carousel() {
  if (counter < slider.length - 1) {
    nextBtn.style.display = "block";
  } else {
    nextBtn.style.display = "none";
  }
  if (counter > 0) {
    prevBtn.style.display = "block";
  } else {
    prevBtn.style.display = "none";
  }
  slider.forEach(function (slide) {
    slide.style.transform = `translateX(-${counter * 100}%)`;
  });
}

prevBtn.style.display = "none";
console.log(carousel)
