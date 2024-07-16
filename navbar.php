<?php 

include 'koneksi.php';

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Navbar with Login</title>
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
    <a class="navbar-brand" href="#">
        <img src="./img/logo.png" alt="Logo">
        Inventory
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
        </ul>
        <button class="login-btn" onclick="window.location.href='login.php'">Login</button>
    </div>
</nav>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
