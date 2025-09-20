<?php
/*
ABOUT THE APP
This is a simple CRUD (Create, Read, Update, Delete) application for managing warehouse items.
It allows users to add, view, update, and delete items in a warehouse inventory.
The app is used to demonstrate basic PHP and MySQL operations along with HTML/CSS for the frontend.
Author: r4ndiel
Date: 2025-09-15
*/
include "includes/helpers.php";
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Aplikasi CRUD</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
    <body>
    <!-- Site Navigation -->
    <nav class="nav-menu">
        <ul id="nav-list">
            <li><a href="<?php echo BASE_URL;?>">Beranda</a></li>
            <li><a href="<?php echo ADD_ITEM;?>">Tambah</a></li>
            <li><a href="<?php echo ABOUT;?>">Tentang</a></li>
        </ul>
    </nav>
        <main>
            <div class="container">
                <h1>Tentang Aplikasi CRUD</h1>
                <div class="spacer"></div>
                <p>Aplikasi CRUD ini dibuat untuk mengelola data barang di gudang. Dengan aplikasi ini, pengguna dapat menambah, melihat, memperbarui, dan menghapus data barang dengan mudah.</p>
                <p>Fitur utama aplikasi ini meliputi:</p>
                <ul class="list">
                    <li>Tambah Barang: Menambahkan data barang baru ke dalam database.</li>
                    <li>Lihat Barang: Menampilkan daftar semua barang yang ada di gudang.</li>
                    <li>Perbarui Barang: Memperbarui informasi barang yang sudah ada.</li>
                    <li>Hapus Barang: Menghapus data barang yang tidak diperlukan lagi.</li>
                </ul>
                <p>Aplikasi ini dibangun menggunakan PHP untuk backend dan MySQL sebagai database. Antarmuka pengguna dirancang dengan HTML dan CSS untuk memberikan pengalaman yang sederhana dan intuitif.</p>
                <p>Pengembang: r4ndiel</p>
                <p>Tahun: 2025</p>
            </div>
            <div class="container">
                <?php include "includes/footer.php";?>
            </div>
        </main>
    </body>
    </html>