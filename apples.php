<?php
include "koneksi.php";
session_start();
        $role = $_SESSION['role'];
$snow_white_status = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE username='snow_white' LIMIT 1"));

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
              
              while($lihatapel = mysqli_fetch_array($viewapel)){
                $random = array_rand($images);
                $randomImage = $images[$random];
                ?>
                <form method="post" action="">
                  <input type="hidden" name="selected_apple" value="<?php echo $lihatapel['id']; ?>">
                  <button type="submit" name="select_apple">
                    <img src="<?php echo $randomImage; ?>" />
                  </button>
                </form>
                <?php
                }
                ?>
        
            </div>
      <?php
            break;
          default:
          }

          if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['select_apple'])){
            $selected_apple = $_POST['selected_apple'];
            $selected_query = mysqli_query($koneksi, "SELECT * FROM apel WHERE id='$selected_apple'");
            $selected_apel = mysqli_fetch_array($selected_query);
            $query = mysqli_query($koneksi,"UPDATE user SET status = 'poisoned' where id=1");
            if($selected_apel['detail_apel'] === 'Poisonous' && $query){
              header("Location: apple_poison.php");
              exit();
            }elseif ($selected_apel['detail_apel'] === 'Fresh'){
              if (isset($_SESSION['apples_count']) && $_SESSION['apples_count'] > 0) {
                $_SESSION['apples_count']--;
              }
            }
          }
          
          
          ?>
    </div>
  </div>
</body>

</html>