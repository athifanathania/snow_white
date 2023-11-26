<?php
include "koneksi.php";
session_start();

if(isset($_POST['btn_heal'])){
    $query = mysqli_query($koneksi,"UPDATE user SET status = 'healthy' where id=1");
    if($query){
        $snow_white_status = "healthy";

        header("Location: apples.php");
        exit();
    }else{
        ?><script>alert('Failed to cure Snow White. Please try again.')</script><?php
    }
}

?>

<img class="img-prince" src="images/snowWhite__death-removebg-preview.png" />
<p class="text-prince">CLICK THE BUTTON BELOW TO CURE SNOW WHITE</p>

<form method="post" action="">
    <button type="submit" name="btn_heal">
        <img class="btn-heal" src="images/btn_heal.svg" />
    </button>
</form>