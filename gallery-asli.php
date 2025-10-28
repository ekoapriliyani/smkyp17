<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpdasar";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM gallery ORDER BY uploaded_on DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <style>
        .gallery-item {
            display: inline-block;
            margin: 10px;
            text-align: center;
            /* border: 1px solid red; */
            max-width: 400px;
        }

        .gallery-item img {
            width: 100%;
            height: auto;
            display: block;
        }
    </style>
</head>

<body>
    <h2>Gallery</h2>
    <div class="gallery-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='gallery-item'>";
                echo "<img src='" . $row["image"] . "' alt='" . $row["caption"] . "'><br>";
                echo "<p>" . $row["caption"] . "</p>";
                echo "</div>";
            }
        } else {
            echo "No images found.";
        }
        $conn->close();
        ?>
    </div>
</body>

</html>