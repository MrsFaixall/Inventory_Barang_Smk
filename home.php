<?php
include "koneksi.php";
require 'vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVENTARIS SEKOLAH</title>
    <!-- Favicon -->
    <link rel="icon" href="img/logo.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-brand img {
            height: 30px;
            width: 30px;
        }

        .navbar-nav .nav-item .nav-link {
            color: white;
        }

        .navbar-nav .nav-item .nav-link:hover {
            color: #f8f9fa;
        }

        .login-btn {
            color: white;
            background-color: #28a745;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .login-btn:hover {
            background-color: #218838;
        }

        body {
            /* background-image: url(img/fapic6.jpeg); */
            background-color: lightgoldenrodyellow;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .kategori {
            text-align: center;
            /* Untuk menempatkan judul teks di tengah */
            margin-bottom: 20px;
            /* Atur jarak antara setiap kategori */
        }

        .card {
            color: black;
            background-color: #F5F5DC;
            border-radius: 10px;
            transition: transform 0.3s ease;
            margin-bottom: 20px;
            /* Menambahkan jarak antara card aset */
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 15px;
            font-weight: bold;
            color: rgba(0, 0, 0, 0.8);
            /* Biru Muda */
            margin-bottom: 6px;
        }

        .card-info {
            font-size: 16px;
            color: #28a745;
            /* Hijau Muda */
            margin-bottom: 10px;
        }

        .card-number {
            font-size: 24px;
            font-weight: bold;
            color: #ffc107;
            /* Oranye */
        }

        .card-img {
            position: center;
        }

        .card-custom {
            margin-bottom: 20px;
            /* Hapus float none dan margin */
        }

        .card-body-table {
            margin-top: 20px;
        }

        .table {
            width: 100%;
        }

        .container {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            min-height: 100vh;
            padding-top: 20px;
            /* Menambah sedikit padding di atas untuk menghindari kartu menempel pada navbar */

        }

        .row {
            width: 100%;
            justify-content: center;
            /* Menengahkan elemen di dalam row */
        }

        .centered-img {
            width: 100%;
            height: auto;
            display: block;
        }

        .welcome-card {
            background-color: #F5F5DC;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
        }

        .welcome-card img {
            max-width: 100%;
            height: 400px;
            border-radius: 10px;
            /* untuk sudut yang melengkung */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* efek bayangan */
        }
    </style>
    <!-- FontAwesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand">
            <img src="./img/logo.png" alt="Logo">
            Inventory
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="true" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="daftar_barang.php">Daftar Barang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="kategori_barang.php">Daftar Kategori</a>
                </li>
            </ul>
            <button class="login-btn" onclick="window.location.href='login.php'">Login</button>
        </div>
    </nav>

    <div class="container">
        <div class="welcome-card">
            <img src="img/fapic6.jpeg" alt="Selamat Datang" class="img-fluid mb-3">
            <h4 class="mt-3">Selamat Datang Di Data Inventaris</h4>
            <p>Anda bisa melihat data yang ada di sini.</p>
        </div>


        <div class="row justify-content-center">
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="daftar_barang.php" style="text-decoration: none; color: inherit;">
                    <div class="widget-stat card bg-info">
                        <div class="card-body p-4">
                            <div class="media">
                                <span class="me-3">
                                    <i class="fas fa-archive fa-3x"></i>
                                </span>
                                <div class="media-body text-white text-end">
                                    <p class="mb-1">Total Barang</p>
                                    <h3 class="text-white">
                                        <?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM barang")); ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="kategori_barang.php" style="text-decoration: none; color: inherit;">
                    <div class="widget-stat card bg-primary">
                        <div class="card-body p-4">
                            <div class="media">
                                <span class="me-3">
                                    <i class="fas fa-school fa-3x"></i>
                                </span>
                                <div class="media-body text-white text-end">
                                    <p class="mb-1">Total Kategori</p>
                                    <h3 class="text-white">
                                        <?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kategori")); ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <a style="text-decoration: none; color: inherit;">
                    <div class="widget-stat card bg-success">
                        <div class="card-body p-4">
                            <div class="media">
                                <span class="me-3">
                                    <i class="fas fa-place-of-worship fa-3x"></i>
                                </span>
                                <div class="media-body text-white text-end">
                                    <p class="mb-1">Total data</p>
                                    <h3 class="text-white">
                                        <?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM barang")) + mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kategori")); ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>