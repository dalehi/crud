<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Item</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <main class="container">
        <h2 class="centered-text">Add New Item</h2>
        <div class="row boxed-layout">
           <button type="button" onclick="window.closeAdd()">Back</button>
            <div class="spacer"></div>
            <form action="exec_addItem.php" method="post" enctype="multipart/form-data">
                <label for="id_brg">ID Barang:</label>
                <input type="text" id="id_brg" name="id_brg" required><br>

                <label for="nama_brg">Nama Barang:</label>
                <input type="text" id="nama_brg" name="nama_brg" required><br>

                <label for="stok">Stok:</label>
                <input type="number" id="stok" name="stok" required><br>

                <label for="ket">Keterangan:</label>
                <input type="text" id="ket" name="ket"><br>

                <label for="file">Gambar:</label>
                <input type="file" id="file" name="file"><br>

                <button type="submit" name="submit">Submit</button>
                <button type="reset">Reset</button>
                <button type="button" onclick="window.closeAdd()">Cancel</button>
            </form>
            <script>
                window.closeAdd = function(){
                    if (window.opener){
                        window.close();
                    } else{
                        history.back();
                    }
                }
            </script>
        </div>
    </main>
    <?php include "includes/footer.php"; ?>
</body>
</html>