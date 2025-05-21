<?php
include('koneksi.php');

$id = $_GET['id'];
$query = "DELETE FROM karya_seni WHERE id = $id";
if (mysqli_query($koneksi, $query)) {
    header('Location: galeri.php');
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}
?>
