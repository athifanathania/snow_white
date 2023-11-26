<?php
include("../koneksi.php");
session_start();

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];
    $bio = $_POST['bio'];
    $status = $_POST['status'];
    $name = $_POST['name'];
    $foto = $_FILES['foto']['name'];
    if($foto!=''){
        $upload = 'image/'.$foto;
        move_uploaded_file($_FILES["foto"]["tmp_name"],$upload);
    }
    $query = mysqli_query($koneksi,"SELECT * FROM user WHERE username='$username'");
    if($query -> num_rows > 0){
        $row = $query -> fetch_assoc();
        if($password == $row['password']){
            $_SESSION['name'] = $name;
            $_SESSION['username'] = $username;
            
            header("Location:index.php");
        }else{
            echo "Password salah. silahkan coba lagi.";
        }
    }else{
        echo "Username tidak ditemukan. Silakan registrasi <a href='register.php'>di sini</a>.";
    }
}
?>