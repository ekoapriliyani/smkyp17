<?php include "koneksi.php" ?>

<?php

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM gallery WHERE id = $id");
header("location: gallery.php");

?>