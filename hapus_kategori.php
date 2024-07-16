<?php
include "koneksi.php";

if (isset($_GET['id_kategori'])) {
    $id_kategori = $_GET['id_kategori'];

    // Cek apakah kategori terhubung dengan barang
    $cekBarang = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah FROM barang WHERE id_kategori = '$id_kategori'");
    $dataBarang = mysqli_fetch_assoc($cekBarang);

    if ($dataBarang['jumlah'] > 0) {
        // Jika kategori terhubung dengan barang, tampilkan pesan kesalahan
        echo "<script>
            alert('Kategori tidak dapat dihapus karena masih terhubung dengan barang.');
            window.location.href = 'index.php?page=kategori';
        </script>";
    } else {
        // Jika kategori tidak terhubung dengan barang, hapus kategori
        $queryHapus = mysqli_query($koneksi, "DELETE FROM kategori WHERE id_kategori = '$id_kategori'");

        if ($queryHapus) {
            echo "<script>
                alert('Kategori berhasil dihapus.');
                window.location.href = 'index.php?page=kategori';
            </script>";
        } else {
            echo "<script>
                alert('Gagal menghapus kategori.');
                window.location.href = 'index.php?page=kategori';
            </script>";
        }
    }
} else {
    echo "<script>
        alert('ID kategori tidak ditemukan.');
        window.location.href = 'index.php?page=kategori';
    </script>";
}
