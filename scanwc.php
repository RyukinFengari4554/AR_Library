<?php
require_once "includes/db.inc.php";
session_start();
$nft_books = array();

$sql = "SELECT id, marker FROM books";

$result = $mysqli->query($sql);

if ($result) {

    while ($row = $result->fetch_assoc()) {
        $nft_books[$row['id']] = $row['marker'];
    }

    $result->free();
} else {
   
    echo "Error: " . $mysqli->error;
}

$mysqli->close();

?>

<!doctype HTML>
<html>
<head>
    <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <script src="https://cdn.jsdelivr.net/gh/aframevr/aframe@1.3.0/dist/aframe-master.min.js"></script>
    <link href="styles/home.css" rel="stylesheet">
    <style>
        .arjs-loader {
            height: 100%;
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }
      
        .arjs-loader div {
            text-align: center;
            font-size: 1.25em;
            color: white;
        }
        .icon {
            font-size: 2.5rem;
            color: #333;
            cursor: pointer;
            transition: color 0.3s;
        }
        .fixedbutton {
            position: fixed;
            bottom: 5rem;
            left: 0;
            right: 0;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            width: 7rem;
        }
    </style>

    <script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar-nft.js"></script>
    <script src="https://raw.githack.com/donmccurdy/aframe-extras/master/dist/aframe-extras.loaders.min.js"></script>
    <script src="includes/event.js"></script>
</head>

<body style='margin : 0px; overflow: hidden;'>
<a href="index.html"><button class="fixedbutton" style="font-size: medium;"><i class="fa-solid fa-house"></i></button></a>
    <div class="arjs-loader">
        <div>Loading, please wait...</div>
    </div>

    <a-scene
        id="myS"
        vr-mode-ui='enabled: false;'
        renderer="logarithmicDepthBuffer: true; precision: medium;"
        embedded arjs='trackingMethod: best; sourceType: webcam; debugUIEnabled: true;'>
    
    <?php
        // Define cache directory
        $cacheDir = 'nft_cache/';
        // Ensure cache directory exists
        if (!file_exists($cacheDir)) {
            try {
                mkdir($cacheDir, 0755, true);
            } catch (Exception $e) {
                echo "<p>Error creating cache directory: " . $e->getMessage() . "</p>";
            }
        }

        

        foreach ($nft_books as $id => $marker) {
            $_SESSION['nft_id'] = $id;
            $_SESSION['nft_marker'] = $marker;
      
   // URL of the marker image
   $markerURL = 'nft.php?marker=' . $marker;
   // File path to save the cached marker image
   $cachedMarkerPath = $cacheDir . $marker;

   // Check if the marker is cached
   if (!file_exists($cachedMarkerPath)) {
       try {
           // Fetch the marker and save to cache
           $markerData = file_get_contents($markerURL);
           file_put_contents($cachedMarkerPath, $markerData);
       } catch (Exception $e) {
           echo "<p>Error fetching and caching marker: " . $e->getMessage() . "</p>";
           continue; // Skip to the next marker on error
       }
   } else {
       // Retrieve the marker from cache
       $markerData = file_get_contents($cachedMarkerPath);
   }
  } ?>

        <a-entity camera></a-entity>
    </a-scene>

    <script src="https://kit.fontawesome.com/7dd0b53595.js" crossorigin="anonymous"></script>
</body>
</html>