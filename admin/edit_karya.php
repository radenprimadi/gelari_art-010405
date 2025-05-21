<?php
session_start();

include 'db.php';

$id = $_GET['id'];

$sql = "SELECT * FROM karya_seni WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$stmt->close();
$conn->close();
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
    <form method="post" action="proses_edit.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>" required>
        <label>Judul</label><br>
        <input type="text" name="judul" value="<?php echo $row['judul']; ?>" required><br><br>
        <label>Author</label><br>
        <input type="text" name="username" value="<?php echo $row['username']; ?>"  required><br><br>
        <label>Kategori</label><br>
        <select class="kategori" name="kategori" id="kategori" required>
        <option value="" selected>Select Kategori</option>
        <option value="Anime Art">Anime Art</option>
        <option value="Realistic">Realistic</option>
        </select><br>
        <label>Deskripsi</label><br>
        <textarea name="deskripsi"><?php echo $row['deskripsi']; ?></textarea><br><br>
        <label>Gambar</label><br>
        <input type="file" name="gambar"><?php echo $row['gambar']; ?><br><br>
        <input type="submit" value="Update" class="btn-update">
        <button action="admin_dashboard.php" class="btn btn-back">Kembali ke Galeri</botton>
    </form>
</body>
</html>
