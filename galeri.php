<?php
session_start();
include('koneksi.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Galeri Seni</title>
    <link rel="shortcut icon" type="x-icon" href="img/rr2.png">
    <link rel="stylesheet" type="text/css" href="Index.css">
</head>
<body>
    <header>
        <div class="btn-login">
            <h1>Art Gallery</h1>
            <?php if (isset($_SESSION['username'])): ?>
                <a href="logout.php" class="btn-enter">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn-enter">Login</a> | <a href="register.php" class="btn-enter">Register</a>
            <?php endif; ?>
        </div>
    </header>

    <div class="search-container">
        <form action="" method="GET">
            <input type="text" name="search" placeholder="Cari judul, author, atau kategori...">
            <br>
            <button type="submit">Search</button>
            <a href="galeri.php" class="btn-reset">Kembali ke Awal</a>
        </form>
    </div>

    <?php if (isset($_SESSION['username'])): ?>
        <div class="add-button-container">
            <a href="tambah.php" class="btn-add">+</a>
        </div>
    <?php endif; ?>

    <?php
    // Ambil semua kategori yang tersedia
    $search_query = "";
    if (isset($_GET['search'])) {
        $search_query = mysqli_real_escape_string($koneksi, $_GET['search']);
    }
    
    $query_kategori = "SELECT DISTINCT kategori FROM karya_seni";
    $result_kategori = mysqli_query($koneksi, $query_kategori);

    if ($search_query != "") {
        // Jika ada pencarian, ambil semua karya seni yang cocok dengan pencarian
        $query = "SELECT * FROM karya_seni WHERE judul LIKE '%$search_query%' OR username LIKE '%$search_query%' OR kategori LIKE '%$search_query%'";
        $result = mysqli_query($koneksi, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<div class='search-results'>";
            echo "<h2>Hasil Pencarian:</h2>";
            echo "<div class='gallery-row'>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='gallery-item'>";
                echo "<img src='uploads/".$row['gambar']."' class='gallery-image'>";
                echo "<div class='gallery-info'>";
                echo "<p class='title'>".$row['judul']."</p>";
                echo "<p class='Author'>".$row['username']."</p>";
                echo "<p class='description'>".$row['deskripsi']."</p>";
                if (isset($_SESSION['username']) && $row['username'] == $_SESSION['username']) {
                    echo "<a href='edit.php?id=".$row['id']."' class='btn-edit'>Edit</a>";
                    echo "<a href='hapus.php?id=".$row['id']."' onclick=\"return confirm('Apakah Anda yakin?')\" class='btn-delete'>Delete</a>";
                }
                echo "</div>"; // Close gallery-info div
                echo "</div>"; // Close gallery-item div
            }
            echo "</div>"; // Close gallery-row div
            echo "</div>"; // Close search-results div
        } else {
            echo "<p>Tidak ada hasil ditemukan.</p>";
        }
    } else {
        // Jika tidak ada pencarian, tampilkan semua kategori dan karya seni
        while ($row_kategori = mysqli_fetch_assoc($result_kategori)) {
            $kategori = $row_kategori['kategori'];
            echo "<div class='category-container'>";
            echo "<h2>$kategori</h2>";
            echo "<div class='gallery-row'>";

            $query = "SELECT * FROM karya_seni WHERE kategori = '$kategori'";
            $result = mysqli_query($koneksi, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='gallery-item'>";
                echo "<img src='uploads/".$row['gambar']."' class='gallery-image'>";
                echo "<div class='gallery-info'>";
                echo "<p class='title'>".$row['judul']."</p>";
                echo "<p class='Author'>".$row['username']."</p>";
                echo "<p class='description'>".$row['deskripsi']."</p>";
                if (isset($_SESSION['username']) && $row['username'] == $_SESSION['username']) {
                    echo "<a href='edit.php?id=".$row['id']."' class='btn-edit'>Edit</a>";
                    echo "<a href='hapus.php?id=".$row['id']."' onclick=\"return confirm('Apakah Anda yakin?')\" class='btn-delete'>Delete</a>";
                }
                echo "</div>"; // Close gallery-info div
                echo "</div>"; // Close gallery-item div
            }
            echo "</div>"; // Close gallery-row div
            echo "</div>"; // Close category-container div
        }
    
    }
    ?>
</body>
</html>
