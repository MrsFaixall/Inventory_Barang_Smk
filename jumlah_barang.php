<?php
include "koneksi.php";

use Picqer\Barcode\BarcodeGeneratorPNG;

// Tentukan jumlah data per halaman
$limit = 10;

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
$query = mysqli_query($koneksi, "SELECT barang.*, kategori.nama_kategori FROM barang LEFT JOIN kategori ON barang.id_kategori = kategori.id_kategori LIMIT $limit OFFSET $offset");

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

        .btn-primary,
        .btn-secondary {
            padding: 0.5rem 1rem;
            font-size: 1rem;
            text-align: center;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 10px;
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

        /* CSS for green border */
        .input-group .form-control,
        .input-group .form-select {
            border: 2px solid lightgray;
            border-radius: 5px;
        }
    </style>

</head>


<body>
    <div class="container-fluid print-area">
        <!-- Page Heading -->
        <div class="text-center mb-4">
            <h1 class="h3 mb-2 text-gray-800">DAFTAR BARANG SMK FATAHILLAH</h1>
            <hr>
        </div>
        <div class="row justify-content-center mb-3">


        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4" >
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Barang</h6>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchInput" placeholder="Cari barang disini....">
                        <button class="btn btn-light" type="button" onclick="scrollToTable('down')">
                            <i class="bi bi-arrow-down"></i>
                        </button>
                    </div>

                </div>
                <div class="col-md-2">
                    <select class="form-select" id="categoryFilter" onchange="filterTable()">
                        <option value="">Semua Kategori</option>
                        <?php
                        $kategoriQuery = mysqli_query($koneksi, "SELECT * FROM kategori");
                        while ($kategori = mysqli_fetch_array($kategoriQuery)) {
                            echo "<option value='" . $kategori['nama_kategori'] . "'>" . $kategori['nama_kategori'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <button onclick="window.print();" class="btn btn-secondary">
                <i class="fas fa-print"></i> Print
            </button>
                <div class="col-md-4" id="printableArea">
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchInput" placeholder="Cari barang disini....">
                        <button class="btn btn-light" type="button" onclick="scrollToTable('down')">
                            <i class="bi bi-arrow-down"></i>
                        </button>
                    </div>

                </div>
                <div class="col-md-2" id="printableArea">
                    <select class="form-select" id="categoryFilter" onchange="filterTable()">
                        <option value="">Semua Kategori</option>
                        <?php
                        $kategoriQuery = mysqli_query($koneksi, "SELECT * FROM kategori");
                        while ($kategori = mysqli_fetch_array($kategoriQuery)) {
                            echo "<option value='" . $kategori['nama_kategori'] . "'>" . $kategori['nama_kategori'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                                <th>Detail</th>
                                <th>Kode Barang & Barcode</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1 + $offset;
                            while ($data = mysqli_fetch_array($query)) {
                                $generator = new BarcodeGeneratorPNG();
                                $barcode = base64_encode($generator->getBarcode($data['kode_barang'], $generator::TYPE_CODE_128));
                            ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $data['nama_barang']; ?></td>
                                    <td><?php echo $data['nama_kategori']; ?></td>
                                    <td><?php echo $data['jumlah']; ?></td>
                                    <td><?php echo $data['tanggal']; ?></td>
                                    <td>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#detailModal<?php echo $data['kode_barang']; ?>">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <?php echo $data['kode_barang']; ?><br>
                                        <img src="data:image/png;base64,<?php echo $barcode; ?>" alt="Barcode">
                                    </td>
                                    <td>
                                        <?php if ($_SESSION['user']['role'] != 'pengunjung') { ?>
                                            <a href="?page=edit_barang&&id=<?php echo $data['id_barang'] ?>" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                                            <a onclick="return confirm('Yakin di Hapus nih? ');" href="?page=hapus_barang&&id=<?php echo $data['id_barang'] ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <!-- Detail Modal -->
                                <div class="modal fade" id="detailModal<?php echo $data['kode_barang']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detail Barang</h5>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Tampilkan gambar dari data BLOB -->
                                                <img src="data:image/jpeg;base64,<?php echo base64_encode($data['foto']); ?>" class="card-img-top" alt="Detail Aset">
                                                <div class="card-body">
                                                    <h4 class="card-title"><?php echo $data['nama_barang']; ?></h4>
                                                    <h5 class="card-text">Jumlah : <?php echo $data['jumlah']; ?></h5>
                                                    <h5 class="card-text">Status : <?php echo $data['kondisi']; ?></h5>
                                                    <h5 class="card-text">Lokasi : <?php echo $data['lokasi']; ?></h5>
                                                    <p>Keterangan Status : <br> baik -> Barang tidak
                                                        <?php echo $data['lokasi']; ?></h5>
                                                    <p>Keterangan Status : <br> baik -> Barang tidak ada yang rusak <br> rusak ringan -> beberapa rusak <br> rusak parah -> kebanyakan rusak </p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <!-- Tambahkan tombol "Close" -->
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Akhir Detail Modal -->
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <nav>
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
                </nav>
            </div>
        </div>
    </div>

    <script>

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('searchInput').addEventListener('input', filterTable);
            document.getElementById('categoryFilter').addEventListener('change', filterTable);
        });

        function filterTable() {
            const searchInput = document.getElementById('searchInput').value.toUpperCase();
            const categoryFilter = document.getElementById('categoryFilter').value.toUpperCase();
            const table = document.getElementById('dataTable1');
            const tr = table.querySelectorAll('tbody tr');

            for (let i = 0; i < tr.length; i++) {
                let match = false;
                const td = tr[i].getElementsByTagName('td');
                for (let j = 0; j < td.length; j++) {
                    if (td[j]) {
                        const textValue = td[j].innerText.toUpperCase();
                        if (textValue.indexOf(searchInput) > -1 &&
                            (categoryFilter === "" || (j === 2 && textValue === categoryFilter))) {
                            match = true;
                            break;
                        }
                    }
                }
                tr[i].style.display = match ? '' : 'none';
            }
        }

        function scrollToTable(direction) {
            const table = document.getElementById('dataTable1');
            const rows = table.querySelectorAll('tbody tr');
            let targetRow;

            if (direction === 'down') {
                for (let i = 0; i < rows.length; i++) {
                    if (rows[i].style.display !== 'none') {
                        targetRow = rows[i];
                        break;
                    }
                }
            } else {
                for (let i = rows.length - 1; i >= 0; i--) {
                    if (rows[i].style.display !== 'none') {
                        targetRow = rows[i];
                        break;
                    }
                }
            }

            if (targetRow) {
                targetRow.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }
    </script>
</body>

</html>