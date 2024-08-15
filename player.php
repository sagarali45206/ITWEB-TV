<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HLS Player</title>
    <link href="https://vjs.zencdn.net/7.14.3/video-js.css" rel="stylesheet">
    <script src="https://vjs.zencdn.net/7.14.3/video.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-hls/5.14.1/videojs-contrib-hls.min.js"></script>
    <style>

        body {
    display: block;
    margin: 0px;
    margin-top: ;
    margin-right: ;
    margin-bottom: ;
    margin-left: ;
}
        .hls-video-dimensions {
            width: 100%;
            height: 400px;
            border-radius: 15px;
        }
        h2{
            text-align: center;
            border-radius: 10px;
        }

        .card1 {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 0px;
    max-width: 60px;
    margin: 2px auto;
    margin-bottom: 2px;
    background-color: #ffffff8f;
}

    .card1 img {
        max-width: 60px;
        max-height: 60px;
        border-radius: 15%;
        margin-bottom: 2px;
    }

    .card1 h2 {
        margin: 0;
        font-size: 11px;
        font-weight: bold;
        color: #333;
        margin-bottom: 2px;
    }
    </style>
</head>
<body>
    <?php
    include('db.php');
    $url = isset($_GET['channel']) ? $_GET['channel'] : '';
    if ($url) {
        // Prepare the SQL query to fetch CNAME and CLOGO
        $stmt = $conn->prepare("SELECT CNAME, CLOGO FROM `tv channels` WHERE CURL = ?");
        $stmt->bind_param("s", $url);
        $stmt->execute();
        $stmt->bind_result($cname, $clogo);
        $stmt->fetch();
        $stmt->close();
        $conn->close();
    ?>

    <?php if (isset($cname) && isset($clogo)): ?>
        <div class="card1">
            <img src="<?php echo htmlspecialchars($clogo); ?>" alt="<?php echo htmlspecialchars($cname); ?>">
            <h2><?php echo htmlspecialchars($cname); ?></h2>
        </div>
    <?php else: ?>
        <h2>Channel not found</h2>
    <?php endif; ?>

    <video id="hls-video" class="video-js vjs-default-skin" controls preload="auto" width="100%" height="100%"
           data-setup='{"techOrder":["html5","flash"], "autoplay": true}'>
        <source src="<?php echo htmlspecialchars($url); ?>" type="application/x-mpegURL">
    </video>
    <script>
        var player = videojs('hls-video');
        player.ready(function() {
            player.play();
        });
    </script>
    <?php } else { ?>
        <p>No video URL provided.</p>
    <?php } ?>
</body>

</html>
