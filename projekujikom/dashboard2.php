<?php
session_start();
include "koneksi.php";

// Pastikan user login sebagai Kaprodi
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'prodi') {
    header("Location: index.php");
    exit();
}

// Query untuk mengambil data pengajuan dari database
$query = "SELECT j.*, m.nama_mahasiswa FROM judul j 
          INNER JOIN mahasiswa m ON j.nim = m.nim";
$result = mysqli_query($koneksi, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard2.css">
    <title>Dashboard Pengajuan topik skripsi</title>
</head>

<body>
    <div class="navbar">
        <div class="logo">
            <a href="#">MyUniversity</a>
        </div>
        <ul class="nav-links">
            <li><a href="#">Home</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="wrapper">
        <div class="main-content">

            <div class="list-pengajuan">
                <p>List Pengajuan</p>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>topik 1</th>
                            <th>topik 2</th>
                            <th>topik 3</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <td>{$no}</td>
                                <td>{$row['topik1']}</td>
                                <td>{$row['topik2']}</td>
                                <td>{$row['topik3']}</td>
                                <td>
                                    <a href='edit.php?id={$row['id_judul']}'>Edit</a> |
                                    <a href='delete.php?id={$row['id_judul']}' onclick=\"return confirm('Are you sure you want to delete this item?');\">Delete</a>
                                </td>
                              </tr>";
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>