<?php include "koneksi.php" ?>
<?php include "header.html" ?>
<?php include "navbar.html" ?>


<div class="container mt-3">
    <h2>Gallery</h2>
    <div class="gallery-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='gallery-item'>";
                echo "<img src='admin/" . $row["image"] . "' alt='" . $row["caption"] . "'><br>";
                echo "<p>" . $row["caption"] . "</p>";
                echo "</div>";
            }
        } else {
            echo "No images found.";
        }
        $conn->close();
        ?>
    </div>
</div>





<?php include "footer.html" ?>