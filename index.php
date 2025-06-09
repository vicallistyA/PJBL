<?php
require 'config.php'; // Menghubungkan ke database

// Proses login jika ada data yang dikirim dari form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa username dan password
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $hashed_password = md5($password); // Menggunakan md5 untuk hashing password
    $stmt->bind_param("ss", $username, $hashed_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login berhasil
        echo "<h2>Welcome, " . htmlspecialchars($username) . "!</h2>";
    } else {
        // Login gagal
        echo "<h2>Login failed. Please try again.</h2>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Backend - Garasi Helm Semarang/title>
</head>
<body>
    <h1>Login to Admin Panel</h1>
    <form action="index.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
