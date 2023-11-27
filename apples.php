<?php
include "koneksi.php";
session_start();
if(!isset($_SESSION['role'])){
  header('Location: login_register.php');
  exit();
}
$snow_white_status = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE username='snow_white' LIMIT 1"));


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['select_apple'])) {
            $selected_apple = $_POST['selected_apple'];
            $selected_apel_index = $_POST['selected_apple_index'];
            $selected_query = mysqli_query($koneksi, "SELECT * FROM apel WHERE id='$selected_apple'");
            $selected_apel = mysqli_fetch_array($selected_query);

            if ($selected_apel['detail_apel'] === 'Poisonous') {
                $query = mysqli_query($koneksi, "UPDATE user SET status = 'poisoned' WHERE id=1");
                if ($query) {
                    header("Location: apple_poison.php");
                    exit();
                }
            }
}
          
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Apples</title>
  <link rel="stylesheet" href="css/home.css" />
  <link rel="stylesheet" href="css/apples.css" />
  <style>
  #btn_apple:hover {
    transform: scale(1.1);
  }

  .hidden {
    display: none;
  }
  </style>
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
          <a href="home.php">
            <li>HOME</li>
          </a>
          <a href="profile.php">
            <li>PROFILE</li>
          </a>
          <a href="apples.php">
            <li>APPLES</li>
          </a>
          <a href="logout.php">
            <li id="logout">LOG OUT</li>
          </a>
        </ul>
      </div>
      <img src="images/now whit.svg" alt="logo" />
    </nav>
    <div class="content">

      <?php
        $role = $_SESSION['role'];
      
        switch ($role) {
          case "prince":
            if ($snow_white_status['status'] === "poisoned") {
                // Snow White belum di-cure, include apples_prince1.php
                include "apples_prince1.php";
            } else if($snow_white_status['status'] === "healthy"){
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
          case "snow_white":
            ?>
      <img class="snow-white-apple" src="images/apples_img.png" width="250px" />
      <p class="p-snow-white">
        Snow White is hungry. Choose an apple for Snow White !
      </p>

      <div class="grid-apples">
        <?php
              
              $viewapel = mysqli_query($koneksi,"SELECT * FROM apel");
              $images = glob('images/apples/{*.svg}', GLOB_BRACE);

              // Inisialisasi atau perbarui sesi untuk menyimpan apel yang telah dipilih
              if (!isset($_SESSION['selected_apples'])) {
                  $_SESSION['selected_apples'] = array();
                }

              if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                  $selected_apple_id = $_POST['selected_apple'];
                  $selected_apple_index = $_POST['selected_apple_index'];
                  $_SESSION['selected_apples'][$selected_apple_id] = $selected_apple_index;
              }
              
              while($lihatapel = mysqli_fetch_array($viewapel)){
                $random = array_rand($images);
                $randomImage = $images[$random];
                $is_selected = isset($_SESSION['selected_apples'][$lihatapel['id']]);
                ?>

        <?php if (!$is_selected) : ?>
        <form method="post" action="">
          <input type="hidden" name="selected_apple" value="<?php echo $lihatapel['id']; ?>">
          <input type="hidden" name="selected_apple_index" value="<?php echo $random; ?>">
          <button type="submit" name="select_apple" id="btn_apple"
            style="background-color: transparent; border-style: none; margin-bottom: 20px; margin-right: 20px; cursor: pointer;">
            <img src="<?php echo $randomImage; ?>" />
          </button>
        </form>
        <?php endif; ?>
        <?php
                }
                ?>

      </div>
      <?php
            break;
          default:
          }?>


    </div>
  </div>
</body>

</html>