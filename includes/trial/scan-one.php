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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    </head>
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!-- 
<script src="https://cdn.jsdelivr.net/gh/aframevr/aframe@1.3.0/dist/aframe-master.min.js"></script>
-->

<script src="https://aframe.io/releases/1.0.4/aframe.min.js"></script>

<script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar-nft.js"></script>

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

<body style='margin : 0px; overflow: hidden;'>

<div class="fixed-buttons">
<a href="index.html"><button style="font-size: medium;"><i class="fa-solid fa-house"></i></button></a>
<button onclick="goBack()" style="font-size: medium;"><i class="fa-solid fa-arrow-left"></i></button>
<script>
        function goBack() {
          localStorage.setItem('messageFromSecond', 'Hello from second.html');
            history.back();
        }
    </script>
</div> 

  <a-scene
    id="myS"
    vr-mode-ui='enabled: false;'
    renderer="logarithmicDepthBuffer: true; precision: medium;"
    embedded>

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
                    id="model3-<?php echo $id ?>" 
                    gltf-model="#animated-asset3"
                    scale="<?php 
                    if ($id == 21 || $id ==25 || $id ==28|| $id ==34 || $id ==39) { 
                      echo '15 15 15';
                  } else {
                      echo '20 20 20';
                  }?>"
                    rotation="0 -90 0"
                    position="
                    <?php 
                       if ($id == 9 ||($id>=22 && $id <= 24) ||$id==26 || $id == 27 ||$id==29) {                // adjust model to the left //
                      echo '163 -120 -150';
                  } elseif ($id == 30|| $id == 33) {                        // adjust model to slight right from left
                    echo '193 -120 -150';
                } elseif ($id == 11) {                         // adjust model height and z axis nearer //
                      echo '313 -150 -200';
                  } elseif ($id == 13) {                              // adjust model height //
                      echo '363 -120 -200';
                  } elseif ($id == 19 || $id == 37) {                // adjust model z axis i think NEARER TO CAMERA
                      echo '363 -140 -150';
                  }  elseif ($id == 20) {
                    echo '363 -170 -55';
                }elseif ($id == 21|| $id ==25 || $id ==28) { // adjust model to the left & z axis i think FARTHER TO CAMERA
                      echo '163 -120 -165';
                  }
                  elseif ($id ==34 || $id ==39) { // adjust height for 15 scale
                    echo '363 -120 -165';
                }  else {
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

<script>
AFRAME.registerComponent('markerhandler', {
    init: function() {
      var self = this;
  
      // Wait for the marker to be found
      this.el.addEventListener('markerFound', function() {
        var nfts = document.querySelectorAll("a-nft");
  
        // Iterate over each a-nft element
        nfts.forEach(function(nft) {
          var nftValue = nft.getAttribute("value");
          var model = nft.querySelector("[id^='model']");
  
          // Add click event listener to each a-nft element
          nft.addEventListener('click', function(ev) {
            const intersectedElement = ev && ev.detail && ev.detail.intersectedEl;
          
              // Define the clickable area using position and scale
              var clickableAreaPosition = model.getAttribute('position');
              var clickableAreaScale = model.getAttribute('scale');
  
              // Define the boundaries of the clickable area
              var minX = clickableAreaPosition.x - clickableAreaScale.x / 2;
              var maxX = clickableAreaPosition.x + clickableAreaScale.x / 2;
              var minY = clickableAreaPosition.y - clickableAreaScale.y / 2;
              var maxY = clickableAreaPosition.y + clickableAreaScale.y / 2;
  
              // Check if the intersected element is within the clickable area boundaries
              if (
                intersectedElement === model &&
                self.isWithinBounds(intersectedElement.object3D.position.x, minX, maxX) &&
                self.isWithinBounds(intersectedElement.object3D.position.y, minY, maxY)
              ) {
                if (model.id === "model3-" + nftValue) {
                  window.location.href = "book_details.php?id=" + nftValue;
                }
              }
            
          });
        });
      });
    },
  
    isWithinBounds: function(value, min, max) {
      return value >= min && value <= max;
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