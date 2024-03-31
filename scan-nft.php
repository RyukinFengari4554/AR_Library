<?php
require_once "includes/db.inc.php";

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
</head>

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

<body style='margin : 0px; overflow: hidden;'>
    <div class="arjs-loader">
        <div>Loading, please wait...</div>
    </div>

    <a-scene
        id="myS"
        vr-mode-ui='enabled: false;'
        renderer="logarithmicDepthBuffer: true; precision: medium;"
        embedded arjs='trackingMethod: best; sourceType: webcam; debugUIEnabled: true;'>

        <a-assets>
            <a-asset-item id="animated-asset" src="https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/book%20location.glb"></a-asset-item>
            <a-asset-item id="animated-asset2" src="https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/similar%20books.glb"></a-asset-item>
            <a-asset-item id="animated-asset3" src="https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/book%20information.glb"></a-asset-item>
        </a-assets>
    
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
            // URL of the marker image
            $markerURL = 'https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/nft-books/' . $marker;
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
    ?>

        <a-nft
            markerhandler 
            emitevents="true" 
            cursor="rayOrigin: mouse"  
            id="animated-marker-<?php echo $id ?>"
            type="nft" 
            url="<?php echo $markerURL ?>"
            width="50"
            value="<?php echo $id ?>" 
            smooth="true" smoothCount="10" smoothTolerance="0.01" smoothThreshold="5">

            <a-entity
                id="model1-<?php echo $id ?>"
                gltf-model="#animated-asset"
                scale="20 20 20"
                rotation="0 -90 0"
                position="450 -120 -225"> <!-- Book Location 3D model -->
            </a-entity>
            <a-entity
                id="model2-<?php echo $id ?>"
                gltf-model="#animated-asset2"
                scale="20 20 20"
                rotation="0 -90 0"
                position="275 -120 -225"> <!-- Similar Books 3D model -->
            </a-entity>
            <a-entity
                id="model3-<?php echo $id ?>"
                gltf-model="#animated-asset3"
                scale="20 20 20"
                rotation="0 -90 0"
                position="363 -120 -150"> <!-- Book Information 3D model -->
            </a-entity>
        </a-nft>
    <?php } ?>

        <a-entity camera></a-entity>
    </a-scene>

    <script src="https://kit.fontawesome.com/7dd0b53595.js" crossorigin="anonymous"></script>
</body>
</html>
