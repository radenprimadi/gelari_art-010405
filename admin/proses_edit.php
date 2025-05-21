<?php session_start();
include('koneksi.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = $_FILES['gambar']['name'];
    $kategori = $_POST['kategori'];

    // Proses jika ada gambar baru diunggah
    if ($gambar) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            $resized_image = resize_image($target_file, 600, 600);
            imagejpeg($resized_image, $target_file);
            $query = "UPDATE karya_seni SET judul = '$judul', deskripsi = '$deskripsi', gambar = '$gambar',kategori = 'kategori' WHERE id = $id_karya_seni";
        } else {
            echo "Ada problem saat mengupload file.";
        }
    } else {
        // Jika tidak ada gambar baru diunggah, hanya update judul dan deskripsi
        $query = "UPDATE karya_seni SET judul = '$judul', deskripsi = '$deskripsi' WHERE id = $id";
    }

    // Eksekusi query update
    if (mysqli_query($koneksi, $query)) {
        header('Location: admin_dashboard.php');
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}
    ?>