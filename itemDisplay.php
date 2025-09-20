<?php
require_once 'config/dbConnect.php';

// Fetch data from 'gudang' table
$sql = "SELECT * FROM gudang";
$result = $conn->query($sql);
?>


    <a href="addItem.php"><button class="btn-primary">Tambah</button></a>
    <div class="spacer"></div>
    <table>
        <thead>
            <tr>
                <th>ID Barang</th>
                <th class="left">Nama Barang</th>
                <th>Stok</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id_brg']); ?></td>
                        <td class="left"><?php echo htmlspecialchars($row['nama_brg']); ?></td>
                        <td class="centered-text"><?php echo htmlspecialchars($row['stok']); ?></td>
                        <td><a href="updateItem.php?id=<?php echo htmlspecialchars($row['id']); ?>">
                            <i class="fa fa-edit" title="Edit"></i></a> | <a href="deleteItem.php?id=<?php echo htmlspecialchars($row['id']); ?>"><i class="fa fa-trash" title="Delete"></i></a> | <a href="detailItem.php?id=<?php echo htmlspecialchars($row['id']); ?>"><i class="fa fa-eye" title="View"></i>
                        </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align:center;">Tidak ada data.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>


<?php
$conn->close();
?>