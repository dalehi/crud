<?php
include "includes/helpers.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi CRUD </title>
    <link rel="stylesheet" href="assets/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Font Awesome digunakan untuk icon centang dan x pada konfirmasi proses -->
</head>
<body>
    <!-- Site Navigation -->
    <nav class="nav-menu">
        <ul id="nav-list">
            <li><a href=<?php echo BASE_URL;?>>Beranda</a></li>
            <li><a href="<?php echo ADD_ITEM; ?>">Tambah</a></li>
            <li><a href="<?php echo ABOUT;?>">Tentang</a></li>
        </ul>
    </nav>

    <!-- Site Content -->
    <main>
        <div class="container">
           <?php include "itemDisplay.php";?>
        </div>
    </main>

<?php include 'includes/footer.php'; ?>
</body>
</html>