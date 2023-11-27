<?php
include "koneksi.php";
session_start();

if(!isset($_SESSION['role'])){
  header('Location: login_register.php');
  exit();
} elseif($_SESSION['role'] != 'dwarf'){
  header('Location: home.php');
  exit();
}
?>

<img class="img-prince2" src="images/apples_img.png" />
<p class="text-dwarf">Hello,My Dwarf...</p>
