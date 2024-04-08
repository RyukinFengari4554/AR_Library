<?php
require_once "includes/db.inc.php";
session_start();
$_SESSION['my_array'] =array(
  24 => '3cocs'
);
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    </head>
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
<!--
https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/similar%20books.glb
 -->

    <a-assets>
      <a-asset-item id="animated-asset" src="https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/book%20location.glb"></a-asset-item>
    </a-assets>
    <a-assets>
      <a-asset-item id="animated-asset2" src="https://sketchfab.com?utm_medium=embed&utm_campaign=share-popup&utm_content=e08443f4391c400b9f8ba48105f1183a"></a-asset-item>
    </a-assets>
    <a-assets>
      <a-asset-item id="animated-asset3" src="https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/book%20information.glb"></a-asset-item>
    </a-assets>
  
  <?php if (!empty($nft_books)): ?>
    <?php foreach ($nft_books as $id => $marker): ?>
    <a-nft 
         markerhandler
                emitevents="true"
                cursor="rayOrigin: mouse"
                id="animated-marker-<?php echo $id ?>"
                type='nft'
                url='https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/nft-books/<?php echo $marker ?>'
                
                value='<?php echo $id ?>'
                smooth='true' smoothCount='10' smoothTolerance='0.01' smoothThreshold='5'>

            <a-entity
                    id="model1-<?php echo $id ?>" 
                    gltf-model="#animated-asset"
                    scale="20 20 20"
                    rotation="0 -90 0"
                    position="450 -120 -225" 
                    collider="shape: box; size: 1.5 1.5 1" > <!-- Book Location 3D model -->
            </a-entity>
            <a-entity
                    id="model2-<?php echo $id ?>" 
                    gltf-model="#animated-asset2"
                    scale="20 20 20"
                    rotation="0 -90 0"
                    position="275 -120 -225"
                    collider="shape: box; size: 1.5 1.5 1" > <!-- Similar Books 3D model -->
            </a-entity>
            <a-entity
                    id="model3-<?php echo $id ?>" 
                    gltf-model="#animated-asset3"
                    scale="20 20 20"
                    rotation="0 -90 0"
                    position="363 -120 -150"
                    collider="shape: box; size: 1.5 1.5 1"> <!-- Book Information 3D model -->
            </a-entity>

             <!-- Clickable area for Book Location 3D model -->
            
        </a-nft>

    <?php endforeach; ?>

    <a-entity camera></a-entity>
    <?php endif; ?>

  </a-scene>
<script>
AFRAME.registerComponent('markerhandler', {
    init: function() {
        this.el.addEventListener('markerFound', function() {
        var nfts = document.querySelectorAll("a-nft");
    nfts.forEach(function(nft) {
        var nftValue = nft.getAttribute("value");
        var models = nft.querySelectorAll("[id^='model']");

        nft.addEventListener('click', function(ev) {
            const intersectedElement = ev && ev.detail && ev.detail.intersectedEl;
            models.forEach(function(model) {
                if (model && intersectedElement === model) {
                    if (model.id === "model1-" + nftValue) {
                        window.location.href = 'map-all.php?id=' + nftValue;
                    } else if (model.id === "model2-" + nftValue) {
                        window.location.href = "similar_books.php?id=" + nftValue;
                    } else if (model.id === "model3-" + nftValue) {
                        window.location.href = "book_details.php?id=" + nftValue;
                    }
                }
            });
        });
        
    }); 
        });
    }

});

      

</script>


  <!-- Bootstrap -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
<script src="https://kit.fontawesome.com/7dd0b53595.js" crossorigin="anonymous"></script>
</html>