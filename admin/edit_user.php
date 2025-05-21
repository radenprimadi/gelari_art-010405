<?php
session_start();

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['user_id'];
    $password = $_POST['password']; // Password baru dari formulir

    // Enkripsi password baru sebelum menyimpannya ke database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET password = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $hashed_password, $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    // Redirect ke halaman admin setelah berhasil mengubah password
    header("Location: admin_dashboard.php");
    exit();
}

// Ambil ID pengguna dari URL
$id = $_GET['id'];

// Query untuk mendapatkan data pengguna berdasarkan ID
$sql = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Periksa apakah ada hasil dari query
if ($result->num_rows > 0) {
    // Ambil data pengguna dari hasil query
    $row = $result->fetch_assoc();
} else {
    // Tampilkan pesan atau tindakan lain jika data pengguna tidak ditemukan
    echo "Data pengguna tidak ditemukan.";
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User Password</title>
    <link rel="stylesheet" type="text/css" href="Login.css">
</head>
<body>
    <div class="welcome-container">
        <h1>Edit User Password</h1>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="password">Username</label>
            <input type="text" name="id" value="<?php echo $row['username']; ?>"required>
            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password">
            </div>
            <button type="submit" class="btn-enter">Update Password</button>
            <button action="admin_dashboard.php" class="btn-back">Kembali</button>
        </form>
    </div>
</body>
</html>
