<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Sekolah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .video-container {
            width: 80%;
            max-width: 800px;
            aspect-ratio: 16 / 9;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            border-radius: 10px;
            overflow: hidden;
            background: #000;
        }
        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>
<body>

<?php
// ID video YouTube (ambil dari URL, misalnya: https://www.youtube.com/watch?v=abc123 -> ID = abc123)
$video_id = "dQw4w9WgXcQ"; // ganti dengan ID video sekolah kamu

// parameter autoplay=1 agar otomatis jalan, mute=1 agar bisa autoplay di browser modern
$embed_url = "https://www.youtube.com/embed/$video_id?autoplay=1&mute=1&rel=0";
?>

<div class="video-container">
    <iframe src="<?= $embed_url; ?>" allow="autoplay; encrypted-media" allowfullscreen></iframe>
</div>

</body>
</html>
