<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Aset</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Edit Data Aset</h5>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <?php
                    $id = $_GET['id'];
                    if (isset($_POST['submit'])) {
                        $nama_barang = $_POST['nama_barang'];
                        $jumlah = $_POST['jumlah'];
                        $tanggal = $_POST['tanggal'];
                        $kondisi = $_POST['kondisi'];
                        $foto = $_POST['foto'];
                        $lokasi = $_POST['lokasi'];
                        

                        // Cek apakah ada file gambar yang diunggah
                        if ($_FILES['foto']['name']) {
                            // Mendapatkan informasi file
                            $fileName = $_FILES['foto']['name'];
                            $fileSize = $_FILES['foto']['size'];
                            $fileTmp = $_FILES['foto']['tmp_name'];
                            $fileType = $_FILES['foto']['type'];

                            // Baca konten file
                            $fp = fopen($fileTmp, 'r');
                            $foto = fread($fp, filesize($fileTmp));
                            $foto = addslashes($foto);
                            fclose($fp);

                            $query = mysqli_query($koneksi, "UPDATE barang SET nama_barang='$nama_barang', jumlah='$jumlah', tanggal='$tanggal', kondisi='$kondisi', lokasi='$lokasi', foto='$foto' WHERE id_barang=$id");

                            if ($query) {
                                echo '<script>alert("Data aset Berhasil di Ubah."); location.href="?page=total_barang"</script>';
                            } else {
                                echo '<script>alert("Gagal Mengubah data.");</script>';
                            }
                        }
                    }
                    $query = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang=$id");
                    $data = mysqli_fetch_array($query);
                    ?>
                    
                    <div class="form-group row">
                        <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_barang" value="<?php echo $data['nama_barang'] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="jumlah" value="<?php echo $data['jumlah'] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tanggal" value="<?php echo $data['tanggal'] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kondisi" class="col-sm-2 col-form-label">Kondisi</label>
                        <div class="col-sm-10">
                            <select name="kondisi" required class="form-control">
                                <option value="baik" <?php if ($data['kondisi'] == 'baik') echo 'selected'; ?>>Baik</option>
                                <option value="rusakringan" <?php if ($data['kondisi'] == 'rusakringan') echo 'selected'; ?>>Rusak Ringan</option>
                                <option value="rusakparah" <?php if ($data['kondisi'] == 'rusakparah') echo 'selected'; ?>>Rusak Parah</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasi" class="col-sm-2 col-form-label">Lokasi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="lokasi" value="<?php echo $data['lokasi'] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="foto" class="col-sm-2 col-form-label">foto</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="foto">
                            <?php if ($data['foto']) { ?>
                                <img src="data:image/png;base64,<?php echo base64_encode($data['foto']); ?>" width="100" height="100" alt="Foto">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                            <a href="?page=total_barang" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>