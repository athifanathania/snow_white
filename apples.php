<?php
include "koneksi.php";
session_start();


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Apples</title>
    <link rel="stylesheet" href="css/home.css" />
    <link rel="stylesheet" href="css/apples.css" />
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
            <a href="home.php"><li>HOME</li></a>
            <a href="profile.php"><li>PROFILE</li></a>
            <a href="apples.php"><li>APPLES</li></a>
            <a href="logout.php"><li id="logout">LOG OUT</li></a>
          </ul>
        </div>
        <img src="images/now whit.svg" alt="logo" />
      </nav>
      <div class="content">
        <?php
        $role = $_SESSION['role'];
        $snow_white_status = "poisoned";

        switch ($role) {
          case "prince":
            if ($snow_white_status === "poisoned") {
                // Snow White belum di-cure, include apples_prince1.php
                include "apples_prince1.php";
            } else if($snow_white_status === "poisoned"){
                // Snow White sudah di-cure, include apples_prince2.php
                include "apples_prince2.php";
            }
            break;
          case "witch":
            include ("apples_witch.php");
            break;
          case "dwarf":
            include ("apples_dwarf.php");
            break;
          case "snow_white":?>
            <img
              class="snow-white-apple"
              src="images/apples_img.png"
              width="250px"
            />
            <p class="p-snow-white">
              Snow White is hungry. Choose an apple for Snow White !
            </p>
            <div class="grid-apples">
              <!-- 
                1. while
                2. href diisi jenis apel
                3. jika memilih apel beracun, location header=apple_poison
              -->
              <a href="" class="grid-item"
                ><img src="images/apples/apel 2.svg"
              /></a>
              <a href="" class="grid-item"
                ><img src="images/apples/apel 4.svg"
              /></a>
              <a href="" class="grid-item"
                ><img src="images/apples/apel 3.svg"
              /></a>
              <a href="" class="grid-item"
                ><img src="images/apples/apel 1.svg"
              /></a>
              <a href="" class="grid-item"
                ><img src="images/apples/apel 3.svg"
              /></a>
              <a href="" class="grid-item"
                ><img src="images/apples/apel 2.svg"
              /></a>
              <a href="" class="grid-item"
                ><img src="images/apples/apel 2.svg"
              /></a>
              <a href="" class="grid-item"
                ><img src="images/apples/apel 1.svg"
              /></a>
              <a href="" class="grid-item"
                ><img src="images/apples/apel 4.svg"
              /></a>
            </div>
            <?php
            break;
          default:
          
          }
          ?>
      </div>
    </div>
  </body>
</html>
