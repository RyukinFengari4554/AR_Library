<?php
$nft_book = array(
  30 => 'cs2e',
  24 => '3cocs',
  23 => 'a'
);

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
<a href="index.html"><button class="fixedbutton" style="font-size: medium;"><i class="fa-solid fa-house"></i></button></a>
  <div class="arjs-loader">
    <div>Loading, please wait...</div>
  </div>

  <a-scene
  id="myS"
    vr-mode-ui='enabled: false;'
    renderer="logarithmicDepthBuffer: true; precision: medium;"
    embedded arjs='trackingMethod: best; sourceType: webcam; debugUIEnabled: true;'>

    <a-assets>
      <a-asset-item id="animated-asset" src="includes/book%20location.glb"></a-asset-item>
    </a-assets>
    <a-assets>
      <a-asset-item id="animated-asset2" src="includes/similar%20books.glb"></a-asset-item>
    </a-assets>
    <a-assets>
      <a-asset-item id="animated-asset3" src="includes/book%20information.glb"></a-asset-item>
    </a-assets>
  
  <?php foreach ($nft_book as $id => $marker): ?>
    <a-nft
      markerhandler 
      emitevents="true" 
      cursor="rayOrigin: mouse"  
      id="animated-marker"
      type='nft' 
      url='includes/nft-books/<?php echo $marker ?>'
      width='50'
      value='<?php echo $id ?>' 
      smooth='true' smoothCount='10' smoothTolerance='0.01' smoothThreshold='5'>

      <a-entity
        id="model1"
        gltf-model="#animated-asset"
        scale="20 20 20"
        rotation="0 -90 0"
        position="450 -120 -225"> <!-- Book Location 3D model -->
      </a-entity>
      <a-entity
        id="model2"
        gltf-model="#animated-asset2"
        scale="20 20 20"
        rotation="0 -90 0"
        position="275 -120 -225"> <!-- Similar Books 3D model -->
      </a-entity>
      <a-entity
        id="model3"
        gltf-model="#animated-asset3"
        scale="20 20 20"
        rotation="0 -90 0"
        position="363 -120 -150"> <!-- Book Information 3D model -->
      </a-entity>
    </a-nft>
    <?php endforeach; ?>

    <a-entity camera></a-entity>


  </a-scene>
</body>
<script src="https://kit.fontawesome.com/7dd0b53595.js" crossorigin="anonymous"></script>
</html>