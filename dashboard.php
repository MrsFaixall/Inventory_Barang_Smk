<?php
include "koneksi.php"

?>
<div class="container-fluid">

    <head>
        <style>
            .widget-stat.card {
                background-color: #fff;
                border-radius: 15px;
                transition: transform 0.3s ease;
                margin-bottom: 20px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .widget-stat.card:hover {
                transform: translateY(-5px);
            }

            .widget-stat .card-body {
                padding: 20px;
            }

            .widget-stat .media {
                align-items: center;
            }

            .widget-stat .media .icon-container {
                display: flex;
                justify-content: center;
                align-items: center;
                border-radius: 50%;
                padding: 15px;
            }

            .widget-stat .media-body p {
                color: #333;
                font-size: 16px;
                margin-bottom: 0;
            }

            .widget-stat .media-body h3 {
                color: #333;
                font-size: 24px;
                font-weight: bold;
            }

            .kategori {
                text-align: center;
                /* Untuk menempatkan judul teks di tengah */
                margin-bottom: 20px;
                /* Atur jarak antara setiap kategori */
            }

            .garis-pembatas {
                border-top: 1px solid #ccc;
                /* Atur garis pembatas */
                margin: 10px auto;
                /* Atur jarak dari atas dan bawah */
                width: 80%;
                /* Atur lebar garis pembatas */
            }

            .dashboard-container {
                background: #fff;
                border-radius: 15px;
                padding: 20px;
                border: 2px solid #fff;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                margin-bottom: 20px;
                display: flex;
                align-items: center;
                /* Memposisikan elemen ke tengah secara vertikal */
                /* Menambahkan jarak antara dashboard dan card */
            }

            .dashboard-title {
                font-size: 38px;
                font-weight: bold;
                color: #fff;
                text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);
                margin-bottom: 20px;
            }

            .dashboard-text {
                color: #333;
                font-size: 19px;
                margin-bottom: 20px;
            }

            .dashboard-text p {
                margin-bottom: 10px;
            }

            /* Tambahkan CSS untuk mengatur gambar di samping kiri */

            .dashboard-image {
                margin-right: 20px;
                /* Jarak antara gambar dan teks */
            }

            .dashboard-content {
                flex-grow: 1;
                /* Memungkinkan konten untuk mengisi ruang yang tersedia */
            }



            .card {
                background-color: #fff;
                border-radius: 15px;
                transition: transform 0.3s ease;
                margin-bottom: 20px;
                /* Menambahkan jarak antara card aset */
            }



            .card-body {
                padding: 20px;
            }



            .card-title {
                font-size: 30px;
                font-weight: bold;
                color: rgba(0, 0, 0, 0.8);
                /* Biru Muda */
                margin-bottom: 30px;
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

            /* Tambahkan warna untuk garis pembatas */
            .garis-pembatas {
                border-top: 1px solid #007bff;
                /* Biru Muda */
                margin: 10px auto;
                width: 80%;
            }

            .card-custom {
                height: 250px;
                /* Adjust height as needed */
            }

            .card-custom .card-body,
            .card-custom .card-footer {
                padding: 10px;
                /* Adjust padding as needed */
            }

            .card-custom .card-title {
                font-size: 1rem;
                /* Adjust font size as needed */
            }

            .card-custom img {
                height: 100px;
                /* Adjust height as needed */
                object-fit: cover;
            }

            .card-custom .card-text {
                font-size: 0.875rem;
                /* Adjust font size as needed */
            }

            .card-custom {
                height: 325px;
                /* Adjust height as needed */
            }

            .card-custom .card-body,
            .card-custom .card-footer {
                padding: 10px;
                /* Adjust padding as needed */
            }

            .card-custom .card-title {
                font-size: 1.45rem;
                /* Adjust font size as needed */
            }

            .card-custom img {
                height: 220px;
                width: auto;
                /* Adjust height as needed */
                object-fit: cover;
            }

            .card-custom .card-text {
                font-size: 0.950rem;
                /* Adjust font size as needed */
            }

            .btn-large {
                font-size: 1.25rem;
                /* Make font size larger */
                padding: 10px 10px;
                /* Increase padding for a larger button */
                width: 50%;
                /* Make the button full-width */
            }

            /* CSS untuk pop-up dan tombol close */

            .popup-container {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                justify-content: center;
                align-items: center;
                z-index: 1000;
            }

            .popup {
                background-color: white;
                padding: 20px;
                border-radius: 5px;
                text-align: center;
                position: relative;
                max-width: 500px;
                width: 90%;
            }

            .close-btn {
                background: #dc3545;
                border: none;
                font-size: 16px;
                color: white;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
                margin-top: 20px;
                /* Tambahkan margin atas untuk membuat jarak dengan konten lainnya */
            }

            .popup-btn {
                margin: 10px 0;
                /* Add margin to create space between buttons */
            }
        </style>

        <!-- Inventory Dashboard -->
        <div class="container mt-1">
            <div class="row">
                <div class="col-xl-6">
                    <div class="card card-custom">
                        <img class="card-img-top img-fluid" src="images/card/fatahillahBG.jpeg" alt="Card image cap">
                        <div class="card-header">
                            <h4 class="card-title">DATA INVENTARIS SARANA DAN PRASARANA SMK FATAHILLAH CILEUNGSI</h4>
                        </div>


                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between">
                            <div class="card-body">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <h2 class="fs-48 font-w700" id="total-data">0</h2>
                                    <span class="fs-28 font-w500 d-block">Total Data</span>
                                    <span class="d-block fs-16 font-w400">Inventaris Sekolah</span>
                                </div>
                            </div>

                        </div>
                        <?php if ($_SESSION['user']['role'] != 'pengunjung') { ?>
                            <div class="card-footer d-sm-flex justify-content-between align-items-center">
                                <div class="card-footer-link mb-4 mb-sm-0">
                                    <p class="card-text text-dark d-inline">Tekan tombol upload untuk tambah data</p>
                                </div>
                                <button type="button" class="btn btn-rounded btn-primary" onclick="window.location.href='?page=tambah_barang';">
                                    <span class="btn-icon-start text-warning"><i class="fa fa-plus color-info"></i></span>Upload
                                </button>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <!-- Pop-up Container -->




            </div>
        </div>
        <!-- script untuk upload -->
        <script>
            function togglePopup() {
                var popupContainer = document.getElementById('popup-container');
                if (popupContainer.style.display === "flex") {
                    popupContainer.style.display = "none";
                } else {
                    popupContainer.style.display = "flex";
                }
            }
        </script>
        <!-- script untuk total data -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                fetch('dbInventory/fullCount.php')
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('total-data').innerText = data.totalCount;
                    })
                    .catch(error => console.error('Error fetching total data:', error));
            });
        </script>
                       
                       <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a href="?page=aset_sekolah" style="text-decoration: none; color: inherit;">
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
                        <a href="?page=Ruangpembelajaran" style="text-decoration: none; color: inherit;">
                            <div class="widget-stat card bg-primary">
                                <div class="card-body p-4">
                                    <div class="media">
                                        <span class="me-3">
                                            <i class="fas fa-school fa-3x"></i>
                                        </span>
                                        <div class="media-body text-white text-end">
                                            <p class="mb-1">Total Kategory</p>
                                            <h3 class="text-white">
                                                <?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kategori")); ?>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    








            <!-- <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>Total Kategori</td>
                            <td>Total Barang</td>
                            <td>Total Data</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kategori")); ?></td>
                            <td><?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM barang")); ?></td>
                            <td><?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM barang")) + mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kategori")); ?></td>
                        </tr>
                    </tbody>


                </table>
            </div>
        </div> -->
        </div>