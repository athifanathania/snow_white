<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['role'])){
  header('Location: login_register.php');
  exit();
} elseif($_SESSION['role'] != 'dwarf'){
  header('Location: home.php');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_SESSION['id'];
    $delete_query = mysqli_query($koneksi, "DELETE FROM user WHERE id='$id'");

    if ($delete_query) {
        session_destroy(); 
        header("Location: login_register.php"); 
        exit();
    } else {
        echo "Failed to delete account. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/home.css" />
  <title>Delete Account</title>
  <style>
  body {
    width: 100%;
    height: 100vh;
  }

  h1 {
    color: white;
    text-align: center;
    padding-top: 140px;
    font-family: new-walt-disney;
    font-size: 70px;
    z-index: 1;
  }

  p {
    color: white;
    text-align: center;
    margin-top: 50px;
    font-family: new-walt-disney;
    font-size: 30px;
  }

  input {
    position: absolute;
    width: 130px;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 15px;
    background: red;
    color: white;
    font-family: dans-disney-ui;
    font-size: 20px;
    font-weight: 400;
    line-height: normal;
    cursor: pointer;
    border-style: none;
    align: center;
    margin-left: 570px;
    margin-top: 30px;
  }

  .cancel {
    text-decoration: none;
    position: absolute;
    width: 130px;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 15px;
    background: #F9E322;
    color: black;
    font-family: dans-disney-ui;
    font-size: 20px;
    font-weight: 400;
    line-height: normal;
    cursor: pointer;
    border-style: none;
    align: center;
    margin-left: 720px;
    margin-top: 30px;
  }

  input[type="submit"]:hover,
  .cancel:hover {
    transform: scale(1.1);
  }
  </style>
</head>

<body>
  <h1 style="color:white;">Delete Account</h1>
  <p>Are you sure want to delete your account?</p>
  <form method="post" action="">
    <input type="submit" name="confirm_delete" value="Delete">
  </form>
  <a href="profile.php" class="cancel">Cancel</a>
</body>

</html>