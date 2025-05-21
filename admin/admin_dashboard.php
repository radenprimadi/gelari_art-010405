<?php
session_start();

include 'db.php';
// Query untuk mendapatkan data appointments
$sql_appointments = "SELECT * FROM users";
$result_appointments = $conn->query($sql_appointments);

// Query untuk mendapatkan data contact messages
$sql_messages = "SELECT * FROM karya_seni";
$result_messages = $conn->query($sql_messages);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="../img/rr2.png">
    <link rel="stylesheet" type="text/css" href="admin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="header">
        <h1>Admin Dashboard</h1>
        <a href="index.php" style="color: #fff;">Logout</a>
    </div>
    <div class="sidebar">
        <h2>Menu</h2>
        <a href="#appointments">Users Table</a>
        <a href="#messages">Karya Seni Table</a>
    </div>
    <div class="content">
        <h2 id="appointments">Users</h2>
        <table>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
            <?php
            if ($result_appointments->num_rows > 0) {
                while($row = $result_appointments->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['user_id']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['password']}</td>
                        <td>
                            <a href='edit_user.php?id={$row['user_id']}'>Edit</a> | 
                            <a href='Delete_users.php?id={$row['user_id']}' onclick=\"return confirm('Apakah kamu mau menghapus gambar ini?');\">Delete</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No appointments found</td></tr>";
            }
            ?>
        </table>

        <h2 id="messages">Galeri</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Author</th>
                <th>Deskripsi</th>
                <th>Kategori</th>
            </tr>
            <?php
            if ($result_messages->num_rows > 0) {
                while($row = $result_messages->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['gambar']}</td>
                        <td>{$row['judul']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['deskripsi']}</td>
                        <td>{$row['kategori']}</td>
                        <td>
                            <a href='edit_karya.php?id={$row['id']}'>Edit</a> | 
                            <a href='delete_karya.php?id={$row['id']}' onclick=\"return confirm('Apakah kamu mau menghapus gambar ini?');\">Delete</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No messages found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
