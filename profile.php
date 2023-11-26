
<?php
include "koneksi.php";
session_start();
$id = $_SESSION['id'];
$snowwhite = mysqli_query($koneksi,"SELECT name, status,foto,bio FROM user WHERE id='$id';");

if($snowwhite){
  $row = mysqli_fetch_assoc($snowwhite);
  $name = $row['name'];
  $status = $row['status'];
  $bio = $row['bio'];
  $foto = $row['foto'];
}
if(isset($_POST['update_profile'])){
    $id = $_POST['upd'];
    $name = $_POST['name'];
    $bio = $_POST['bio'];
    $upd = $_POST['upd'];
  
    $update = mysqli_query($koneksi, "UPDATE user SET name='$name', bio='$bio' WHERE id='$id'");
    if($update){
        header("Location:profile.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile</title>
    <link rel="stylesheet" href="css/home.css" />
    <link rel="stylesheet" href="css/profile.css" />
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
        <img src="images/profile/<?php echo $foto; ?>" width="400" />
        <div class="form-profile">
          <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <input type="hidden" name="upd" value="<?php echo $id; ?>">
            <h2>PROFILE</h2>
            <div class="input-wrapper">
              <label>Name</label>
              <input type="text" name="name" value="<?php echo $name; ?>"/>
            </div>
            <div class="input-wrapper">
              <label>Bio</label>
              <textarea name="bio" id="" style="height: 160px"><?php echo $bio; ?></textarea>
            </div>
            <input type="submit" value="SAVE" name="update_profile" style="margin-top:70px;"/>
          </form>

          <!-- TOMBOL DELETE ACCOUNT -->

          <?php if ($_SESSION['role']=='dwarf'){
              ?><a href="delete_dwarf.php" id="delete" style="margin-top:70px;">Delete Account</a>
          <?php
          } ?>
        </div>
      </div>
    </div>
  </body>
</html>
