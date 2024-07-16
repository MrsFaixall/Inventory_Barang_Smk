<?php
include "koneksi.php";
require 'vendor/autoload.php';

use Picqer\Barcode\BarcodeGeneratorPNG;

if (isset($_POST['submit'])) {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $id_kategori = $_POST['id_kategori'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];
    $kondisi = $_POST['kondisi'];
    $lokasi = $_POST['lokasi'];
    $foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));

    // Generate Barcode
    $generator = new BarcodeGeneratorPNG();
    $barcode = $generator->getBarcode($kode_barang, $generator::TYPE_CODE_128);
    $barcode_base64 = base64_encode($barcode);

    // Simpan Data ke Database
    $query = "INSERT INTO barang (kode_barang, nama_barang, id_kategori, jumlah, tanggal, kondisi, lokasi, foto) VALUES ('$kode_barang', '$nama_barang', '$id_kategori', '$jumlah', '$tanggal', '$kondisi', '$lokasi', '$foto')";
    if (mysqli_query($koneksi, $query)) {
        // Simpan barcode sebagai file
        $barcode_path = 'barcodes/' . $kode_barang . '.png';
        file_put_contents($barcode_path, $barcode);
        echo '<script>alert("Tambah Data Berhasil."); location.href="?page=total_barang"</script>';
    } else {
        echo '<script>alert("Tambah Data Gagal.");</script>';
    }
}

// Ambil data kategori dari database
$queryKategori = mysqli_query($koneksi, "SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
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

        .tambah-barang-header {
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
            <div class="tambah-barang-header">Formulir Tambah Barang</div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="kode_barang" class="col-md-2 col-form-label">Kode Barang</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="kode_barang" id="kode_barang" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_barang" class="col-md-2 col-form-label">Nama Barang</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="nama_barang" id="nama_barang" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id_kategori" class="col-md-2 col-form-label">Kategori</label>
                        <div class="col-md-10">
                            <select name="id_kategori" id="id_kategori" class="form-control" required>
                                <?php
                                while ($kategori = mysqli_fetch_assoc($queryKategori)) {
                                    echo "<option value='{$kategori['id_kategori']}'>{$kategori['nama_kategori']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah" class="col-md-2 col-form-label">Jumlah</label>
                        <div class="col-md-10">
                            <input type="number" class="form-control" name="jumlah" id="jumlah" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal" class="col-md-2 col-form-label">Tanggal</label>
                        <div class="col-md-10">
                            <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kondisi" class="col-md-2 col-form-label">Kondisi</label>
                        <div class="col-md-10">
                            <select name="kondisi" id="kondisi" class="form-control" required>
                                <option value="baik">Baik</option>
                                <option value="rusak ringan">Rusak Ringan</option>
                                <option value="rusak parah">Rusak Parah</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasi" class="col-md-2 col-form-label">Lokasi</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="lokasi" id="lokasi" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="foto" class="col-md-2 col-form-label">Foto</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="foto" id="foto" accept="image/*" required>
                        </div>
                    </div>
                    <div class="form-group row text-right">
                        <div class="col-md-10 offset-md-2">
                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <a href="?page=total_barang" class="btn btn-danger">Kembali</a>
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
