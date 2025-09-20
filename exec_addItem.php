<?php
// Include database connection
include_once 'config/dbConnect.php';
include 'includes/helpers.php';

// Check connection
if ($conn->connect_error) {
    $status = 'error';
    $message = 'Database connection failed: ' . $conn->connect_error;
} else {
    // Get POST data
    $id_brg   = isset($_POST['id_brg']) ? $conn->real_escape_string($_POST['id_brg']) : '';
    $nama_brg = isset($_POST['nama_brg']) ? $conn->real_escape_string($_POST['nama_brg']) : '';
    $stok     = isset($_POST['stok']) ? (int)$_POST['stok'] : 0;
    $ket      = isset($_POST['ket']) ? $conn->real_escape_string($_POST['ket']) : '';
    $file     = isset($_POST['file']) ? $conn->real_escape_string($_POST['file']) : '';

    //handle image upload and directory
    $targetDir = "uploads/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    $allowedTypes = array("jpg", "jpeg", "png", "gif");

    if(in_array($fileType, $allowedTypes)){
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
        // Insert into gudang table
            $sql = "INSERT INTO gudang (id_brg, nama_brg, stok, foto, ket) 
                        VALUES ('$id_brg', '$nama_brg', $stok, '$fileName', '$ket')";
            if ($conn->query($sql) === TRUE) {
                $status = 'success';
                $message = 'Item added successfully!';
            } else {
                $status = 'error';
                $message = 'Error: ' . $conn->error;
            }
        }
    }

 
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Item Result</title>
    <!-- Bootstrap 5 CDN for modal -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .modal-backdrop.show { opacity: 0.5; }
        .fa-check-circle { color: #28a745; font-size: 3rem; }
        .fa-times-circle { color: #dc3545; font-size: 3rem; }
    </style>
</head>
<body>
<!-- Modal -->
<div class="modal fade show" id="resultModal" tabindex="-1" aria-modal="true" role="dialog" style="display:block;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-body">
                <?php if ($status === 'success'): ?>
                        <i class="fas fa-check-circle"></i>
                <?php else: ?>
                        <i class="fas fa-times-circle"></i>
                <?php endif; ?>
                <h5 class="mt-3"><?php echo htmlspecialchars($message); ?></h5>
                <button id="okBtn" class="btn btn-primary mt-3">OK</button>
            </div>
        </div>
    </div>
</div>
<div class="modal-backdrop fade show"></div>
<script>
        // Redirect to addItem.php when OK button is clicked
        document.getElementById('okBtn').addEventListener('click', function() {
                window.location.href = 'addItem.php';
        });

        // Optional: Close modal when clicking outside (if you want to keep this)
        document.addEventListener('click', function(event) {
                var modal = document.getElementById('resultModal');
                var okBtn = document.getElementById('okBtn');
                if (modal && !modal.contains(event.target) && event.target !== okBtn) {
                        window.location.href = 'addItem.php';
                }
        });
</script>

</body>
</html>