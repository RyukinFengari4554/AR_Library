<?php
require_once "includes/db.inc.php";
session_start();
if(isset($_SESSION['my_array'])) {
  // Retrieve the array from the session
  $nft_books = $_SESSION['my_array'];

  // Output the array to JavaScript console
  echo '<script>';
  echo 'console.log("NFT books:", ' . json_encode($nft_books) . ');';
  echo '</script>';
} else {
  // Session variable doesn't exist
  echo '<script>';
  echo 'console.log("Session variable my_array does not exist.");';
  echo '</script>';
}

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

.fixed-buttons {
    position: fixed;
    bottom: 5rem; /* Adjust the distance from the bottom */
    left: 50%; /* Place buttons in the center horizontally */
    transform: translateX(-50%); /* Center buttons horizontally */
    z-index: 9999; /* Ensure buttons appear on top of other content */
  }
</style>


<script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar-nft.js"></script>
<script src="https://raw.githack.com/donmccurdy/aframe-extras/master/dist/aframe-extras.loaders.min.js"></script>


<script src="includes/event.js"></script>

<body style='margin : 0px; overflow: hidden;'>
<div class="fixed-buttons">
<a href="index.html"><button style="font-size: medium;"><i class="fa-solid fa-house"></i></button></a>
<a href="javascript:history.back()"><button style="font-size: medium;"><i class="fa-solid fa-arrow-left"></i></button></a>
</div> 
<div class="arjs-loader">
    <div>Loading, please wait...</div>
  </div>

  <a-scene
    id="myS"
    vr-mode-ui='enabled: false;'
    renderer="logarithmicDepthBuffer: true; precision: medium;"
    embedded>

    <a-assets>
      <a-asset-item id="animated-asset" src="includes/book%20location.glb"></a-asset-item>
    </a-assets>
    <a-assets>
      <a-asset-item id="animated-asset2" src="includes/similar%20books.glb"></a-asset-item>
    </a-assets>
    <a-assets>
      <a-asset-item id="animated-asset3" src="includes/book%20information.glb"></a-asset-item>
    </a-assets>
  
  <?php if (!empty($nft_books)): ?>
    <?php foreach ($nft_books as $id => $marker): ?>
    <a-nft 
         markerhandler
                emitevents="true"
                cursor="rayOrigin: mouse"
                id="animated-marker-<?php echo $id ?>"
                type='nft'
                url='includes/nft-books/<?php echo $marker ?>'
                width='50'
                value='<?php echo $id ?>'
                smooth='true' smoothCount='10' smoothTolerance='0.01' smoothThreshold='5'>

            <a-entity
                    id="model1-<?php echo $id ?>" 
                    gltf-model="#animated-asset"
                    scale="20 20 20"
                    rotation="0 -90 0"
                    position="
                    <?php 
                    if ($id == 19) {
                      // Code to execute if $id is equal to 19
                      echo '450 -70 -225';
                  } else {
                      // Code to execute if $id is not equal to 19
                      echo '450 -120 -225';
                  }
                    ?>
                    " > <!-- Book Location 3D model -->
            </a-entity>
            <a-entity
                    id="model2-<?php echo $id ?>" 
                    gltf-model="#animated-asset2"
                    scale="20 20 20"
                    rotation="0 -90 0"
                    position="
                    <?php 
                    if ($id == 19) {
                      // Code to execute if $id is equal to 19
                      echo '275 -70 -225';
                  } else {
                      // Code to execute if $id is not equal to 19
                      echo '275 -120 -225';
                  }
                    ?>
                    "> <!-- Similar Books 3D model -->
            </a-entity>
            <a-entity
                    id="model3-<?php echo $id ?>" 
                    gltf-model="#animated-asset3"
                    scale="20 20 20"
                    rotation="0 -90 0"
                    position="
                    <?php 
                    if ($id == 19) {
                      // Code to execute if $id is equal to 19
                      echo '363 -70 -150';
                  } else {
                      // Code to execute if $id is not equal to 19
                      echo '363 -120 -150';
                  }
                    ?>
                    "> <!-- Book Information 3D model -->
            </a-entity>
        </a-nft>

    <?php endforeach; ?>

    <a-entity camera></a-entity>
    <?php endif; ?>

  </a-scene>
</body>
<script src="https://kit.fontawesome.com/7dd0b53595.js" crossorigin="anonymous"></script>
</html>