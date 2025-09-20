<?php
// detailItem.php

include 'config/dbConnect.php';
include 'includes/helpers.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$row = null;
if ($id > 0) {
    $stmt = $conn->prepare("SELECT id_brg, nama_brg, stok, foto, ket FROM gudang WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
}
$foto = getItemImage($row['foto']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Barang</title>
    <link rel="stylesheet" href="assets/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            body, .modal-content {
                width: 105mm;
                height: 148mm;
                margin: 0 auto;
                box-shadow: none;
            }
            .modal-header, .modal-footer, .btn-close, .btn {
                display: none !important;
            }
            .modal-content {
                border: none;
            }
        }
        .modal-content {
            width: 100%;
            max-width: 350px;
            margin: auto;
            font-size: 14px;
        }
        .detail-label {
            font-weight: bold;
        }
        .detail-value {
            margin-bottom: 8px;
            display: block;
        }
    </style>
</head>
<body>
    <div class="modal show" tabindex="-1" style="display:block; background:rgba(0,0,0,0.2);" id="detailModal">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3">
          <div class="modal-header">
            <h5 class="modal-title">Detail Barang</h5>
            <button type="button" class="btn-close" aria-label="Close" onclick="window.closeModal()"></button>
          </div>
          <div class="modal-body">
            <?php if ($row): ?>
                <label class="detail-label">ID Barang:</label>
                <span class="detail-value"><?= htmlspecialchars($row['id_brg']) ?></span>
                <label class="detail-label">Nama Barang:</label>
                <span class="detail-value"><?= htmlspecialchars($row['nama_brg']) ?></span>
                <label class="detail-label">Jumlah Stok:</label>
                <span class="detail-value"><?= htmlspecialchars($row['stok']) ?></span>
                <label class="detail-value">Gambar:</label>
                <img id="detail-img" class="detail-value" src="<?= htmlspecialchars(BASE_URL)?>uploads/<?= htmlspecialchars($foto)?>" alt="Foto" height="200" width="200"></img>
                <label class="detail-label">Keterangan:</label>
                <span class="detail-value"><?= nl2br(htmlspecialchars($row['ket'])) ?></span>
            <?php else: ?>
                <div class="alert alert-warning">Data tidak ditemukan.</div>
            <?php endif; ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="window.closeModal()">Tutup</button>
            <button type="button" class="btn btn-primary" onclick="window.print()">Cetak</button>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.closeModal = function() {
            if (window.opener) {
                window.close();
            } else {
                window.location.href = 'index.php';
            }
        }
    </script>
    <?php include "includes/footer.php";?>
</body>
</html>
