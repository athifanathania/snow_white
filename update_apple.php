<?php
include "koneksi.php";
session_start();
if(!isset($_SESSION['role'])){
  header('Location: login_register.php');
  exit();
} elseif($_SESSION['role'] != 'witch'){
  header('Location: home.php');
  exit();
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $jenis_apel = $_POST['jenis_apel'];
    $detail_apel = $_POST['detail_apel'];
    $id_upd = $_POST['id_upd'];

    $update = mysqli_query($koneksi, "UPDATE apel SET jenis_apel='$jenis_apel', detail_apel='$detail_apel' WHERE id='$id_upd' ");
    if($update){
        header("Location:apples.php");
    }
}

if(isset($_GET['edit'])){
    $id_edit = $_GET['edit'];
    $edit = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM apel WHERE id='$id_edit'"));

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Insert Apples</title>
  <link rel="stylesheet" href="css/home.css" />
  <link rel="stylesheet" href="css/apples.css" />
  <link rel="stylesheet" href="css/insert_apple.css" />
  <style>
    select {
      border-style: none;
      height: 30px;
      border-radius: 5px;
      -webkit-border-radius: 5px;
      -moz-border-radius: 5px;
      -ms-border-radius: 5px;
      -o-border-radius: 5px;
      padding-left: 10px;
    }

    select:focus {
      outline: 3px solid #e99ee9fc;
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
      <img class="img-witch" src="images/witch (3).png" />
      <div class="form-apple">
        <form class="insert-apple" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
          <input type="hidden" name="id_upd" value="<?php echo $edit['id'];?>">
          <label for="">Type :</label>
          <input type="text" name="jenis_apel" value="<?php echo $edit['jenis_apel']?>" /><br />
          <label for="">Detail :</label>
          <select name="detail_apel">
            <option><?php echo $edit['detail_apel']?></option>
            <option>Fresh</option>
            <option>Poisonous</option>
          </select>
          <input type="submit" name="update" id="" class="btn-submit" value="Update" />
        </form>
      </div>
    </div>
  </div>
</body>

</html>
<?php
}
?>
</body>