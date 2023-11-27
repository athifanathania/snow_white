<?php
include "koneksi.php";
session_start();

if(!isset($_SESSION['role'])){
  header('Location: login_register.php');
  exit();
} elseif($_SESSION['role'] != 'snow_white'){
  header('Location: home.php');
  exit();
}

?><script>
alert('You ate a poisoned apple! You will be redirected to the login page in 5 seconds.')
</script><?php
header('Refresh: 5; URL=logout.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Poisoned</title>
  <link rel="stylesheet" href="css/home.css" />
  <link rel="stylesheet" href="css/apple_poison.css" />
</head>

<body>
  <div class="container">
    <nav>

      <img src="images/snowwhite.svg" alt="logo" style="margin-left:1050px" />
    </nav>
    <div class="content">
      <img src="images/snowWhite__death-removebg-preview.png" width="500" />
      <p>THANK YOU FOR YOUR STUPID CHOICE</p>
    </div>
  </div>
</body>

</html>