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
        body{color:white;text-align:center;margin-top:100px;font-family: dans-disney-ui;}

        input{
            position: absolute;
            width: 300px;
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
            align:center;
            margin-left:610px
        }

        input[type="submit"]:hover {
            opacity: 0.7;
        }
    </style>
</head>
<body>
    <h1 style="color:white;">Delete Account</h1>
    <pre>Are you sure you want to delete your account?</pre>
    <form method="post" action="">
        <input type="submit" name="confirm_delete" value="Yes, delete my account">
    </form>
</body>
</html>
