<?php
include "koneksi.php";
$viewuser = mysqli_query($koneksi, "SELECT * FROM user");


while($lihat = mysqli_fetch_array($viewuser)){
echo "
<table>
    <tr>
        <td>User</td>
        <td>:</td>
        <td>$lihat[name]</td>
    </tr>
    <tr>
        <td>Bio</td>
        <td>:</td>
        <td>$lihat[bio]</td>
    </tr>
    <tr>
        <td>Status</td>
        <td>:</td>
        <td>$lihat[status]</td>
    </tr>
    
</table>
";
}
?>