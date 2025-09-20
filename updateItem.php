<?php
include 'config/dbConnect.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$item = [
    'id' => '',
    'id_brg' => '',
    'nama_brg' => '',
    'stok' => '',
    'foto' => '',
    'ket' => ''
];

if ($id) {
    $stmt = $conn->prepare("SELECT id, id_brg, nama_brg, stok, foto, ket FROM gudang WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($item['id'], $item['id_brg'], $item['nama_brg'], $item['stok'], $item['foto'], $item['ket']);
    $stmt->fetch();
    $stmt->close();
}

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_brg = $_POST['id_brg'];
    $nama_brg = $_POST['nama_brg'];
    $stok = intval($_POST['stok']);
    $ket = $_POST['ket'];

    // Check if a file was uploaded
    if (!isset($_FILES["file"]) || $_FILES["file"]["error"] != UPLOAD_ERR_OK) {
        // No file uploaded, update without foto
        $stmt = $conn->prepare("UPDATE gudang SET id_brg=?, nama_brg=?, stok=?, ket=? WHERE id=?");
        $stmt->bind_param("ssisi", $id_brg, $nama_brg, $stok, $ket, $id);

        if ($stmt->execute()) {
            $success = true;
            $item = ['id' => $id, 'id_brg' => $id_brg, 'nama_brg' => $nama_brg, 'stok' => $stok, 'ket' => $ket];
        } else {
            $error = "Update failed: " . $stmt->error;
        }
    } else {
        // Handle image upload
        $targetDir = "uploads/";
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowedTypes = array("jpg", "jpeg", "png", "gif");

        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                $stmt = $conn->prepare("UPDATE gudang SET id_brg=?, nama_brg=?, stok=?, foto=?, ket=? WHERE id=?");
                $stmt->bind_param("ssissi", $id_brg, $nama_brg, $stok, $fileName, $ket, $id);

                if ($stmt->execute()) {
                    $success = true;
                    $item = ['id' => $id, 'id_brg' => $id_brg, 'nama_brg' => $nama_brg, 'stok' => $stok, 'foto' => $fileName, 'ket' => $ket];
                } else {
                    $error = "Update failed: " . $stmt->error;
                }
            } else {
                $error = "File upload failed.";
            }
        } else {
            $error = "Invalid file type. Only JPG, JPEG, PNG, GIF are allowed.";
        }
    }
    $stmt->close();
}

?>

<link rel="stylesheet" href="assets/styles.css">

<div class="modal" style="display:block;">
    <div class="modal-content">
        <?php if ($success): ?>
            <div class="icon success">&#10004;</div>            
            <p>Item updated successfully.</p>
            <a href="index.php" class="ok-btn">OK</a>
        <?php else: ?>
            <?php if ($error): ?>
                <div class="icon error">&#10006;</div>
                <p><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <form method="post" enctype="multipart/form-data">
                <label for="id">ID (Auto-increment)</label>
                <input type="text" name="id" id="id" value="<?php echo htmlspecialchars($item['id']); ?>" readonly>

                <label for="id_brg">ID Barang</label>
                <input type="text" name="id_brg" id="id_brg" value="<?php echo htmlspecialchars($item['id_brg']); ?>" required>

                <label for="nama_brg">Nama Barang</label>
                <input type="text" name="nama_brg" id="nama_brg" value="<?php echo htmlspecialchars($item['nama_brg']); ?>" required>

                <label for="stok">Stok</label>
                <input type="number" name="stok" id="stok" value="<?php echo htmlspecialchars($item['stok']); ?>" required>

                <label for="file">Gambar</label>
                <input type="file" name="file" id="file" value="<?php echo htmlspecialchars($item['foto'])?>">
                <img src="uploads/<?php echo htmlspecialchars($item['foto']);?>" alt="Gambar" height="200" width="200">

                <label for="ket">Keterangan</label>
                <textarea name="ket" id="ket" required><?php echo htmlspecialchars($item['ket']); ?></textarea>

                <button type="submit" class="ok-btn">Update</button>
            </form>
        <?php endif; ?>
         <!-- Add Cancel button to return-->
        <button type="cancel" class="reset-btn" onclick="window.closePage()">Cancel</button>
    </div>
        <?php include "includes/footer.php"; ?>
</div>
    <script>
        window.closePage = function() {
            if (window.opener) {
                window.close();
            } else {
                history.back();
                // window.location.href = 'index.php';
            }
        }
    </script>
