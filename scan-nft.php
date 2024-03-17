<?php
// Define the array of book URLs

$nft_books = array(
    "tsotw",
    "agir",
    "atotc",
    "tbt",
    "ts",
    "jc",
    "tgsohi",
    "aac",
    "fsd",
    "tmmm",
    "dr",
    "pot2",
    "mtpas",
    "sftw",
    "ev",
    "fm",
    "sasriph",
    "crit",
    "cah",
    "cacmom",
    "caohati",
    "taed",
    "a",
    "3cocs",
    "ict",
    "casiep",
    "mbom",
    "fosa",
    "msaad",
    "cs2e",
    "eitac",
    "dome",
    "raam",
    "ddc",
    "ahftsomh",
    "twbhcc",
    "isic",
    "acgifbsp",
    "saphoit",
    "lmibb",
    "hi",
    "unacn",
    "tfim",
    "tfmp",
    "hdi",
    "o",
    "nfaca",
    "msn",
    "smab",
    "cdd"
);

?>
<!doctype HTML>
<html>
    <head>
        <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    
    </head>

<script src="https://cdn.jsdelivr.net/gh/aframevr/aframe@1.3.0/dist/aframe-master.min.js"></script>

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
</style>

<!-- Load AR.js NFT extension 
<script src="https://aframe.io/releases/0.9.2/aframe.min.js"></script>
<script src='../../../../aframe/build/aframe-ar-nft.js'></script>-->
<script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar-nft.js"></script>
<script src="https://raw.githack.com/donmccurdy/aframe-extras/master/dist/aframe-extras.loaders.min.js"></script>

<!--  import events.js script -->
<script src="includes/event.js"></script>

<body style='margin : 0px; overflow: hidden;'>
  <!-- Show loader until image descriptors are loaded -->
  <div class="arjs-loader">
    <div>Loading, please wait...</div>
  </div>
  <!-- AR scene -->
  <a-scene
  id="myS"
    vr-mode-ui='enabled: false;'
    renderer="logarithmicDepthBuffer: true; precision: medium;"
    embedded arjs='trackingMethod: best; sourceType: webcam; debugUIEnabled: true;'>

    <a-assets>
      <a-asset-item id="animated-asset" src="https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/book%20location.glb"></a-asset-item>
    </a-assets>
    <a-assets>
      <a-asset-item id="animated-asset2" src="https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/similar%20books.glb"></a-asset-item>
    </a-assets>
    <a-assets>
      <a-asset-item id="animated-asset3" src="https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/book%20information.glb"></a-asset-item>
    </a-assets>
    <!-- NFT marker definition 
    url='./book/book-image/book'
    url='https://raw.githack.com/AR-js-org/AR.js/master/aframe/examples/image-tracking/nft/trex/trex-image/trex'
    url='https://raw.githack.com/SHERVIOR/workingar/tree/main/aframe/examples/image-tracking/nft2/book/book-image/book'
   
  -->
  <?php foreach ($nft_books as $key => $book): ?>
    <a-nft
      markerhandler 
      emitevents="true" 
      cursor="rayOrigin: mouse"  
      id="animated-marker"
      type='nft' 
      url='https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/nft-books/<?php echo $book ?>'
      width='50'
      value='<?php echo $key + 1 ?>' 
      smooth='true' smoothCount='10' smoothTolerance='0.01' smoothThreshold='5'>

      <!-- Entity displaying the 3D model -->
      <a-entity
        id="model1"
        gltf-model="#animated-asset"
        scale="20 20 20"
        rotation="0 -90 0"
        position="400 -120 -175"> <!-- Book Location 3D model -->
      </a-entity>
      <a-entity
        id="model2"
        gltf-model="#animated-asset2"
        scale="20 20 20"
        rotation="0 -90 0"
        position="225 -120 -175"> <!-- Similar Books 3D model -->
      </a-entity>
      <a-entity
        id="model3"
        gltf-model="#animated-asset3"
        scale="20 20 20"
        rotation="0 -90 0"
        position="313 -120 -100"> <!-- Book Information 3D model -->
      </a-entity>
    </a-nft>
    <?php endforeach; ?>
    <!-- Camera entity -->
    <a-entity camera></a-entity>


  </a-scene>
</body>

</html>