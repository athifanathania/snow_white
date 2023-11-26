<?php
include "../koneksi.php";
if(isset($_POST['register'])){
    $username = $_POST['username'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];
    $bio = $_POST['bio'];
    $status = $_POST['status'];

    if($role == 'Prince'){
        $foto = 'image/character-snow-white/prince (4).png';
    }else if($role == 'Dwarf'){
        $foto = 'image/character-snow-white/pngegg (5).png';
    }

    if($password == $confirm_password){
        $register = mysqli_query($koneksi, "INSERT INTO user (username, name, password, role, foto) VALUES ('$username', '$name', '$password', '$role', 'foto')");
        if($register){
            header("Location: login.php");
        } else {
            echo "Gagal mendaftar. Silakan coba lagi.";
        }
    } else {
        echo "Password tidak sesuai. Silakan coba lagi.";
    }
    
}
?>