<?php include "../koneksi.php" ?>
<?php include "../header.html" ?>



<div class="container mt-3">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
        Tambahkan Gambar
    </button>
    <a href="index.php"><button class="btn btn-danger">Kembali</button></a>
    <h2>Gallery</h2>
    <div class="gallery-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='gallery-item'>";
                echo "<img src='" . $row["image"] . "' alt='" . $row["caption"] . "'><br>";
                echo "<p>" . $row["caption"] . "</p>";
                echo "<a href='hapusgallery.php?id={$row["id"]}'>Hapus</a>";
                echo "</div>";
            }
        } else {
            echo "No images found.";
        }
        $conn->close();
        ?>
    </div>
</div>


<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambahkan Gambar</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <label for="image" class="form-label">Pilih Gambar :</label><br>
                    <input type="file" name="image" id="image" required>
                    <br><br>
                    <label for="caption" class="form-label">Keterangan :</label>
                    <input type="text" name="caption" id="caption" class="form-control" required>
                    <br>
                    <button class="btn btn-info" type="submit" name="submit">Upload</button>

                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<?php include "../footer.html"; ?>