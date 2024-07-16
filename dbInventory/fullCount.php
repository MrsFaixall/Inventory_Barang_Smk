<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventoryy";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Dapatkan daftar tabel dalam database
$tables = array();
$result = $conn->query("SHOW TABLES");
while ($row = $result->fetch_array()) {
    $tables[] = $row[0];
}

// Hitung total data dalam semua tabel
$totalCount = 0;
foreach ($tables as $table) {
    $result = $conn->query("SELECT COUNT(*) as count FROM $table");
    $row = $result->fetch_assoc();
    $totalCount += $row['count'];
}

// Kembalikan total count sebagai JSON
echo json_encode(array("totalCount" => $totalCount));

$conn->close();
?>
