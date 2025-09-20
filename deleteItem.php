<?php
// Include database connection
include 'config/dbConnect.php';

// Get the ID from request (GET or POST)
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Initialize variables for modal
$success = false;
$message = '';

if ($id > 0) {
    // Prepare and execute delete query
    $stmt = $conn->prepare("DELETE FROM gudang WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $success = true;
        $message = "Item deleted successfully.";
    } else {
        $message = "Failed to delete item.";
    }
    $stmt->close();
} else {
    $message = "Invalid ID.";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Item</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <div class="modal">
        <div class="modal-content">
            <?php if ($success): ?>
                <div class="icon success">&#10004;</div>
            <?php else: ?>
                <div class="icon error">&#10006;</div>
            <?php endif; ?>
            <div><?php echo htmlspecialchars($message); ?></div>
            <button class="ok-btn" onclick="window.location.href='index.php'">OK</button>
        </div>
    </div>
</body>
</html>