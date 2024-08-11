<?php
session_start();
include('koneksi.php'); // Sertakan file untuk koneksi database

if (isset($_POST['submit'])) {
    // Mengambil data dari form
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $kompetensi = $_POST['kompetensi'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah NIM sudah ada di database
    $check_nim = "SELECT * FROM mahasiswa WHERE nim='$nim'";
    $result_nim = mysqli_query($koneksi, $check_nim);

    if (mysqli_num_rows($result_nim) > 0) {
        echo "<script>alert('NIM sudah digunakan, silakan gunakan NIM lain.');</script>";
    } else {

        // Cek apakah username sudah ada di database
        $check_username = "SELECT * FROM mahasiswa WHERE username='$username'";
        $result = mysqli_query($koneksi, $check_username);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Username sudah ada, silakan gunakan username lain.');</script>";
        } else {
            // Enkripsi password sebelum menyimpannya ke database
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Menyimpan data ke tabel mahasiswa
            $query = "INSERT INTO mahasiswa (nim, nama_mahasiswa, program_studi, kompetensi, username, password) 
                    VALUES ('$nim', '$nama', '$prodi', '$kompetensi', '$username', '$password')";

            if (mysqli_query($koneksi, $query)) {
                echo "<script>alert('Registrasi berhasil. Silakan login.');</script>";
                header('Location: index.php'); // Mengarahkan pengguna ke halaman login
                exit();
            } else {
                echo "<script>alert('Terjadi kesalahan, silakan coba lagi.');</script>";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/login.css">

    <title>Register Form </title>
</head>

<body>
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
            <div class="input-group">
                <input type="text" placeholder="NIM" name="nim" required>
            </div>
            <div class="input-group">
                <input type="text" placeholder="Nama Mahasiswa" name="nama" required>
            </div>
            <select name="prodi" required>
                <option value="">select program studi</option>
                <option value="ti">Informatika</option>
                <option value="si">Sistem Informasi</option>
                <option value="tk">Teknik Komputer</option>
                <option value="tl">Teknik Lingkungan</option>
            </select>
            <select name="kompetensi" required>
                <option value="">select kompetensi</option>
                <option value="rpl">RPL</option>
                <option value="iot">IOT</option>
                <option value="mm">MM</option>
                <option value="jaringan">Jaringan</option>
            </select>
            <div class="input-group">
                <input type="text" placeholder="Username" name="username" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" required>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Register</button>
            </div>
            <p class="login-register-text">Have an account? <a href="index.php">Login Here</a>.</p>
        </form>
    </div>
</body>

</html>