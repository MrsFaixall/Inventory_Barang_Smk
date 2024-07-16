<?php
include "koneksi.php";
$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM barang where id_barang=$id");
?>
<script>
    alert("Hapus Data Berhasil");
    location.href = "index.php?page=total_barang";
</script> 