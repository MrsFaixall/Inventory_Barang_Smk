<?php
include "koneksi.php";
require 'vendor/autoload.php';


if (isset($_POST['submit'])) {
    $nama_kategori = $_POST['nama_kategori'];
    

    // Simpan Data ke Database
    $query = "INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')";
    if (mysqli_query($koneksi, $query)) {
        
        echo '<script>alert("Tambah Data Berhasil."); location.href="?page=kategori"</script>';
    } else {
        echo '<script>alert("Tambah Data Gagal.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Aset</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            margin: 20px auto;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: white;
            padding: 10px;
            font-weight: bold;
            text-align: center;
        }

        .tambah-aset-header {
            background-color: #FFA500;
            color: #696969;
            padding: 10px;
            font-weight: bold;
            margin-top: 20px;
            text-align: center;
            font-size: 20px;
        }

        h1 {
            color: orange;
            font-size: 24px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="tambah-aset-header">Formulir Tambah Kategori</div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="nama_kategori$nama_kategori" class="col-md-2 col-form-label">Nama Kategori</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="nama_kategori" id="nama_kategori" required>
                        </div>
                    </div>
                    
                    <div class="form-group row text-right">
                        <div class="col-md-10 offset-md-2">
                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <a href="?page=kategori" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
