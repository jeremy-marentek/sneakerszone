<?php 

$conn = mysqli_connect('localhost','root','','sneakers_zone') or die('connection failed');

function rupiah($angka){
    $hasil = "Rp " . number_format($angka, 0,',','.');
    return $hasil;
}
?>