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

$viewapel = mysqli_query($koneksi,"SELECT * FROM apel");

if(isset($_GET['del'])){
    $id = $_GET['del'];
    $delete = mysqli_query($koneksi,"DELETE FROM apel WHERE id='$id'");
    if($delete){
        ?>
      <script>
      alert('Apple berhasil dihapus!');
      document.location = 'apples.php';
      </script>
<?php
    }
}
?>

<img class="img-witch" src="images/witch (3).png" />
<p class="text-witch">Give apples to Snow White!</p>
<a href="insert_apple.php">
  <img src="images/btn-insert.svg" class="btn-insert" />
</a>
<div class="container-table">
  <table>
    <thead>
      <tr>
        <th>No.</th>
        <th>Type</th>
        <th>Detail</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
    $no = 1;
    while ($lihatapel = mysqli_fetch_array($viewapel)){
        echo "
            <tr>
                <td>$no</td>
                <td>$lihatapel[jenis_apel]</td>
                <td>$lihatapel[detail_apel]</td>
                <td><a class='update' href=update_apple.php?edit=$lihatapel[id]>update</a>
      <a class='delete' href=apples_witch.php?del=$lihatapel[id]>delete</a></td>
      </tr>

      ";?>
      <?php 
        $no++;
    }
    ?>

    </tbody>
  </table>
</div>