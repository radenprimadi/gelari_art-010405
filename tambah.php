<?php
include('koneksi.php');
session_start();
if (!isset($_SESSION['username'])) {
    echo "Anda tidak memiliki izin untuk menambahkan karya seni.";
    exit();
}

function resize_image($file, $w, $h) {
    $info = getimagesize($file);
    $mime = $info['mime']; // Mengganti ukuran gambar

    switch ($mime) { //jika format file berbeda
        case 'image/jpeg':
            $src = imagecreatefromjpeg($file);
            break;
        case 'image/png':
            $src = imagecreatefrompng($file);
            break;
        case 'image/gif':
            $src = imagecreatefromgif($file);
            break;
        default:
            throw new Exception('File tidak disupport');
    }

    list($width, $height) = getimagesize($file);
    $dst = imagecreatetruecolor($w, $h);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
    return $dst;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $kategori = $_POST['kategori'];
    $gambar = $_FILES['gambar']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);

    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        try {
            $resized_image = resize_image($target_file, 300, 300); // ubah ukuran ke 300x300
            imagejpeg($resized_image, $target_file);

            $query = "INSERT INTO karya_seni (judul, deskripsi, gambar, username, kategori) VALUES ('$judul', '$deskripsi', '$gambar','{$_SESSION['username']}','$kategori')";
            if (mysqli_query($koneksi, $query)) {
                header('Location: galeri.php');
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
            }
        } catch (Exception $e) {
            echo 'Error: ',  $e->getMessage(), "\n";
        }
    } else {
        echo "Ada problem saat mengupload file.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Galeri Seni</title>
    <link rel="shortcut icon" type="x-icon" href="img/rr2.png">
    <link rel="stylesheet" type="text/css" href="Tambah.css">
</head>
<body>
    <header>
        <h1>Art Gallery</h1>
    </header>
    <form method="post" action="" enctype="multipart/form-data">
        <label>Judul</label><br>
        <input type="text" name="judul"><br><br>
        <label>Kategori</label><br>
        <select class="kategori" name="kategori" id="kategori" required>
        <option value="" selected>Select Kategori</option>
        <option value="Anime Art">Anime Art</option>
        <option value="Realistic">Realistic</option>
        <option value="Abstracks">Abstrack</option>
    </select><br><br>

        <label>Deskripsi</label><br>
        <textarea name="deskripsi"></textarea><br><br>
        <label>Gambar</label><br>
        <a class="alert">Disarankan gambar rasio 1:1</a>
        <input type="file" name="gambar"><br><br>
        <input type="submit" value="Tambah" class="btn-update">
    </form>
    <a href="galeri.php" class="btn btn-back">Kembali ke Galeri</a>
</body>
</html>
