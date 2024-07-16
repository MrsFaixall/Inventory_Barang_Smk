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
    </style>
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




    <?php


    use Picqer\Barcode\BarcodeGeneratorPNG;

    // Tentukan jumlah data per halaman
    $limit = 10;
//LIMIT $limit OFFSET $offset
    // Hitung offset (mulai data)
    $currentPage = isset($_GET['pagenum']) ? intval($_GET['pagenum']) : 1;
    $offset = ($currentPage - 1) * $limit;

    // Hitung jumlah total data pada tabel barang
    $queryTotal = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM barang");
    $row = mysqli_fetch_assoc($queryTotal);
    $totalRows = $row['total'];

    // Hitung jumlah halaman
    $totalPages = ceil($totalRows / $limit);

    // Pastikan nomor halaman valid (minimal 1 dan maksimal total halaman)
    $currentPage = max(1, min($currentPage, $totalPages));

    // Ambil data sesuai dengan limit dan offset
    $query = mysqli_query($koneksi, "SELECT * FROM kategori ");

    // Penanganan Error (Opsional)
    if (!$query) {
        die("Error dalam query: " . mysqli_error($koneksi));
    }

    $baseUrl = 'home.php?page=barang';

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Barang SMK FATAHILLAH</title>
        <style>
            .text-center {
                margin-top: 50px;
            }

            .text-center h1 {
                font-size: 36px;
                font-weight: bold;
                color: #333;
            }

            .text-center hr {
                border: 2px solid #333;
                width: 50px;
                margin: 20px auto;
            }

            .card-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .btn-primary {
                padding: 0.5rem 1rem;
                font-size: 1rem;
                text-align: center;
                text-decoration: none;
                color: white;
                background-color: #007bff;
                border: none;
                border-radius: 5px;
            }

            .btn-secondary {
                padding: 0.5rem 1rem;
                font-size: 1rem;
                text-align: center;
                text-decoration: none;
                color: white;
                background-color: #6c757d;
                border: none;
                border-radius: 5px;
            }

            .card {
                margin: 0 2rem;
                padding: 1rem;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .card-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 1rem;
            }

            .card-header h6 {
                margin: 0;
                font-weight: bold;
                color: #333;
            }

            .btn-primary,
            .btn-secondary {
                padding: 0.5rem 1rem;
                font-size: 1rem;
                text-align: center;
                text-decoration: none;
                color: white;
                background-color: #218838;
                border: none;
                border-radius: 10px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            th,
            td {
                padding: 10px;
                text-align: center;
                border: 1px solid #ddd;
                vertical-align: middle;
            }

            th {
                background-color: #f2f2f2;
                font-weight: bold;
            }

            .table-responsive {
                overflow-x: auto;
            }

            @media print {
        body * {
            visibility: hidden;
        }

        .print-area,
        .print-area * {
            visibility: visible;
        }

        .print-area {
            position: absolute;
            left: 0;
            top: 0;
        }

        .btn,
        .card-header a {
            display: none;
        }
    }
    </style>
    
</head>

<body>
    <div class="container-fluid print-area">
        <!-- Page Heading -->
        <div class="text-center mb-4">
            <h1 class="h3 mb-2 text-gray-800">Kategori</h1>
            <hr>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4" id="printableArea">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Kategori</h6>
                <button onclick="window.print();" class="btn btn-secondary">
                <i class="fas fa-print"></i> Print
            </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1 + $offset; // Mulai nomor urut dari offset + 1
                            while ($data = mysqli_fetch_array($query)) {
                            ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $data['nama_kategori']; ?></td>
                                
                            </tr>

                            
                            <?php 
                            }
                            ?>
                        </table>
                    </div>
                    <!-- <nav>
                        <ul class="pagination pagination-circle">
                            <?php
                            // Tombol Previous (Tidak ada perubahan)
                            if ($currentPage > 1) {
                                $prevPage = $currentPage - 1;
                                echo "<li class='page-item page-indicator'><a class='page-link' href='{$baseUrl}&pagenum={$prevPage}'><i class='la la-angle-left'></i></a></li>";
                            }

                            // Tampilkan tautan halaman (Tidak ada perubahan)
                            for ($i = 1; $i <= $totalPages; $i++) {
                                $activeClass = ($currentPage == $i) ? 'active' : '';
                                echo "<li class='page-item {$activeClass}'><a class='page-link' href='{$baseUrl}&pagenum={$i}'>{$i}</a></li>";
                            }

                            // Tombol Next (Tidak ada perubahan)
                            if ($currentPage < $totalPages) {
                                $nextPage = $currentPage + 1;
                                echo "<li class='page-item page-indicator'><a class='page-link' href='{$baseUrl}&pagenum={$nextPage}'><i class='la la-angle-right'></i></a></li>";
                            }
                            ?>
                        </ul>
                    </nav> -->
                </div>
            </div>
        </div>

        <!-- Bootstrap JS and dependencies -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

        <script>
            function printContent(el) {
                var restorepage = $('body').html();
                var printcontent = $('#' + el).clone();
                $('body').empty().html(printcontent);
                window.print();
                $('body').html(restorepage);
            }
        </script>
    </body>

    </html>