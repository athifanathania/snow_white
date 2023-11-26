<?php
include "koneksi.php";
session_start();
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
        <div id="menuToggle">
          <input type="checkbox" />
          <span></span>
          <span></span>
          <span></span>
          <ul id="menu">
            <a href="home.html"><li>HOME</li></a>
            <a href="profile.html"><li>PROFILE</li></a>
            <a href="apples.html"><li>APPLES</li></a>
            <a href="logout.php"><li id="logout">LOG OUT</li></a>
          </ul>
        </div>
        <img src="images/now whit.svg" alt="logo" />
      </nav>
      <div class="content">
        <img src="images/snowWhite__death-removebg-preview.png" width="500" />
        <p>THANK YOU FOR YOUR STUPID CHOICE</p>
      </div>
    </div>
  </body>
</html>
