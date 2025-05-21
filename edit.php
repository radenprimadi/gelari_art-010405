<?php
include('koneksi.php');

// Validasi parameter ID karya seni
$id_karya_seni = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Periksa izin akses pengguna
session_start();
if (!isset($_SESSION['username'])) {
    echo "Anda tidak memiliki izin untuk mengedit karya seni ini.";
    exit();
}

// Ambil username pengguna yang saat ini masuk
$user_id_pengguna = $_SESSION['username'];

// Periksa izin akses pengguna berdasarkan user_id
$query = "SELECT * FROM karya_seni WHERE id = $id_karya_seni";
$result = mysqli_query($koneksi, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "Karya seni tidak ditemukan.";
    exit();
}

$row = mysqli_fetch_assoc($result);

// Periksa apakah pengguna memiliki izin untuk mengedit karya seni ini
if ($row['username'] != $user_id_pengguna) {
    echo "Anda tidak memiliki izin untuk mengedit karya seni ini.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = $_FILES['gambar']['name'];
    $kategori = $_POST['deskripsi'];

    // Proses jika ada gambar baru diunggah
    if ($gambar) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            $resized_image = resize_image($target_file, 600, 600);
            imagejpeg($resized_image, $target_file);
            $query = "UPDATE karya_seni SET judul = '$judul', deskripsi = '$deskripsi', gambar = '$gambar',kategori = $kategori WHERE id = $id_karya_seni";
        } else {
            echo "Ada problem saat mengupload file.";
        }
    } else {
        // Jika tidak ada gambar baru diunggah, hanya update judul dan deskripsi
        $query = "UPDATE karya_seni SET judul = '$judul', deskripsi = '$deskripsi' WHERE id = $id_karya_seni";
    }

    // Eksekusi query update
    if (mysqli_query($koneksi, $query)) {
        header('Location: galeri.php');
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Galeri Seni</title>
    <link rel="shortcut icon" type="x-icon" href="img/rr2.png">
    <link rel="stylesheet" type="text/css" href="tambah.css">
</head>
<body>
    <header>
        <h1>Art Gallery</h1>
    </header>
    <form method="post" action="" enctype="multipart/form-data">
        <label>Judul</label><br>
        <input type="text" name="judul" value="<?php echo $row['judul']; ?>"><br><br>
        <select class="kategori" name="kategori" id="kategori" required>
        <option value="" selected>Select Kategori</option>
        <option value="Anime Art">Anime Art</option>
        <option value="Realistic">Realistic</option></select><br><br>
        <label>Deskripsi</label><br>
        <textarea name="deskripsi"><?php echo $row['deskripsi']; ?></textarea><br><br>
        <label>Gambar</label><br>
        <input type="file" name="gambar"><?php echo $row['gambar']; ?><br><br>
        <input type="submit" value="Update" class="btn-update">
    </form>
    <a href="galeri.php" class="btn btn-back">Kembali ke Galeri</a>
</body>
</html>
