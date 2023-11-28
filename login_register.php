<?php
include("koneksi.php");
session_start();
if(isset($_SESSION['role'])){
  header ('Location: home.php');
  exit();
}

//Login halaman snow white
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi,"SELECT * FROM user WHERE username = '$username' AND password = '$password'");
    if($query -> num_rows == 1){
        $row = $query->fetch_assoc();
        if ($row['role'] == 'snow_white' && $row['status'] == 'poisoned') {
          ?>
<script>
alert("You cannot log in. Snow White is poisoned!");
document.location = 'login_register.php';
</script>
<?php
          exit(); // Stop execution if Snow White is poisoned
        }

        $_SESSION["id"] = $row["id"];
        $_SESSION["role"] = $row["role"];
        
        switch($row["role"]){
          case "snow_white":
            header("Location: home.php");
            break;
          case "witch":
            $message = "This page is specifically for non-witches";
            echo "<script type='text/javascript'>alert('$message');</script>";
            break;
          case "prince":
            header("Location: home.php");
            break;
          case "dwarf":
            header("Location: home.php");
            break;
          default:
          
        }
    }else{
        ?>
<script>
alert("Username atau password salah");
document.location = "login_register.php";
</script>
<?php
    }
}

//Login halaman witch
if(isset($_POST['login2'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi,"SELECT * FROM user WHERE username = '$username' AND password = '$password'");
    if($query -> num_rows == 1){
        $row = $query->fetch_assoc();
        $_SESSION["id"] = $row["id"];
        $_SESSION["role"] = $row["role"];
        switch($row["role"]){
          case "snow_white":
            $message1 = "This page is specifically for witches.";
            echo "<script type='text/javascript'>alert('$message1');</script>";
            break;
          case "witch":
            header("Location: home.php");
            break;
          case "prince":
            $message1 = "This page is specifically for witches.";
            echo "<script type='text/javascript'>alert('$message1');</script>";
            break;
          case "dwarf":
            $message1 = "This page is specifically for witches.";
            echo "<script type='text/javascript'>alert('$message1');</script>";
            break;
          default:
            header("Location: login_register.php");
        }
    }else{
      ?><script>
alert("Username atau password salah");
</script><?php
    }
  }

//Register akun
if(isset($_POST['register'])){
    $username = $_POST['username'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];

    if ($role == 'prince') {
        $foto = 'prince_profile.svg';
    } else if ($role == 'dwarf') {
        $foto = 'dwarf_profile.svg';
    }

    $check_query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");
    $check_result = mysqli_fetch_assoc($check_query);

    if($check_result) {
        ?><script>
alert('Password sudah digunakan. Silakan gunakan yang lain.');
document.location = 'login_register.php';
</script> <?php
        exit(); 
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if($password == $confirm_password){
        $register = mysqli_query($koneksi, "INSERT INTO user (username, name, password, role, foto) VALUES ('$username', '$name', '$password', '$role', '$foto')");
        if ($register) {
        ?><script>
alert('Berhasil registrasi');
document.location = "login_register.php"
</script><?php
        } else {
            echo "Gagal mendaftar. Pesan kesalahan: " . mysqli_error($koneksi);
        }
    } else {
      ?><script>
alert('Password tidak sesuai. Silakan coba lagi.');
</script> <?php
    }    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="css/login_register.css" />
  <style>
  .hidden {
    visibility: hidden;
    transition: none !important;
  }

  .visible {
    visibility: visible;
  }

  .witch-mode {
    background: url(images/Storm.gif);
    background-size: cover;
    background-repeat: no-repeat;
  }
  </style>
</head>

<body class="snow witch">
  <label class="switch">
    <input type="checkbox" id="checkbox" onclick="switchRole(); hideAnimated()" />
    <span class="slider round"></span>
  </label>
  <div class="container">
    <div class="card-login-snow-white">
      <div class="left-login-snow"></div>
      <div class="right-login">
        <img src="images/snowwhite.svg" class="logo" />
        <div class="form-box">
          <!-- toggle button  login-register -->
          <div class="button-box">
            <div id="btn"></div>
            <button type="button" class="toggle-btn" onclick="login()">
              Log in
            </button>
            <button type="button" class="toggle-btn" onclick="register()">
              Register
            </button>
          </div>
          <p id="text-log">Welcome to Your Story</p>
          <!-- form login -->
          <form action="" id="login" class="input-group" method="post">
            <input type="text" class="input-field" placeholder="Username" name="username" required />
            <input type="password" class="input-field" placeholder="Password" name="password" required /><button
              type="submit" class="submit-btn" name="login">Log In</button>
          </form>
          <!-- Form Register -->
          <form action="" method="post" id="register" class="input-group hidden">
            <p>Start Your Story</p>
            <input type="text" class="input-field" placeholder="Username" name="username" required />

            <input type="text" class="input-field" placeholder="Name" name='name' required />

            <input type="password" class="input-field" placeholder="Password" name="password" required />

            <input type="password" class="input-field" placeholder="Confirm Password" name="confirm_password" />
            <div>
              <label>Role :</label>
              <label><input type="radio" name="role" value="prince" required/>Prince</label>
              <label><input type="radio" name="role" value="dwarf" required/>Dwarf</label>
            </div>

            <button type="submit" class="btn-register" name="register">Register</button>
          </form>
        </div>
      </div>
    </div>
    <div class="card-login-witch">
      <div class="left-login-witch"></div>
      <div class="right-login">
        <img src="images/snowwhite.svg" class="logo" />
        <div class="form-box">
          <p id="text-log-witch">Welcome to Your Story</p>
          <!-- form login -->
          <form action="" id="login" class="input-group" method="post">
            <input type="text" class="input-field" placeholder="Username" name="username" required />
            <input type="password" class="input-field" placeholder="Password" name="password" required /><button
              type="submit" class="submit-btn" name="login2">Log In</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
  var log = document.getElementById("login")
  var textLog = document.getElementById("text-log")
  var reg = document.getElementById("register")
  var button = document.getElementById("btn")
  var left_card = document.querySelector(".left-login-snow")

  function register() {
    log.classList.add("hidden")
    textLog.classList.add("hidden")
    reg.classList.add("visible")
    log.classList.remove("visible")
    textLog.classList.remove("visible")
    left_card.classList.remove("left-login-snow")
    left_card.classList.add("left-register")
    button.style.left = "90px"
  }

  function login() {
    log.classList.add("visible")
    textLog.classList.add("visible")
    reg.classList.remove("visible")
    left_card.classList.toggle("left-register")
    left_card.classList.remove("left-register")
    left_card.classList.add("left-login-snow")
    button.style.left = "0"
  }

  function switchRole() {
    var element = document.body
    element.classList.toggle("witch-mode")

    var checkbox = document.getElementById("checkbox")
    var snowWhite = document.querySelector(".card-login-snow-white")
    var witch = document.querySelector(".card-login-witch")
    var logreg = document.querySelector(".button-box")
    if (checkbox.checked == true) {
      snowWhite.classList.add("hidden")
      snowWhite.classList.remove("visible")
      witch.classList.add("visible")
    } else {
      snowWhite.classList.add("visible")
      witch.classList.add("hidden")
      witch.classList.remove("visible")
    }
  }

  function hideAnimated() {
    var btn = document.getElementById("btn")
    var toggle = document.querySelector(".toggle-btn")

    btn.classList.toggle("hidden")
    toggle.classList.toggle("hidden")
  }
  </script>
</body>

</html>