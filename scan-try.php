<?php
require_once "includes/db.inc.php";
session_start();
$_SESSION['my_array'] = array(10 => 'tmmm');

if (isset($_SESSION['my_array'])) {
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

<body style="margin: 0; overflow: hidden;">
<script>
window.addEventListener('load', function() {
    var message = localStorage.getItem('messageFromSecond');
    if (message) {
        localStorage.removeItem('messageFromSecond');
        location.reload(true);
    }
});
  </script>
  <script src="https://aframe.io/releases/0.9.2/aframe.min.js"></script>
  <script src="https://raw.githack.com/AR-js-org/AR.js/3.3.1/aframe/build/aframe-ar-nft.js"></script>
  <style>
.fixed-buttons {
    position: fixed;
    bottom: 5rem; /* Adjust the distance from the bottom */
    left: 50%; /* Place buttons in the center horizontally */
    transform: translateX(-50%); /* Center buttons horizontally */
    z-index: 9999; /* Ensure buttons appear on top of other content */
  }
  </style>
  <div class="fixed-buttons">
<a href="scan-one.php"><button style="font-size: medium;"><i class="fa-solid fa-arrow-left"></i></button></a>
</div> 
<script>
    AFRAME.registerComponent('cursor-listener', {
      init: function() {
        var data = this.data;
        var el = this.el;
        el.addEventListener('click', function(evt) {
          var newTab = window.open(data.href, '_blank');
          setTimeout(function() {
            window.close();
          }, 100);
        });
      }
    });
  </script>
 <a-scene
      vr-mode-ui='enabled: false;'
      renderer="logarithmicDepthBuffer: true; precision: medium;"
      embedded
      arjs='sourceType: webcam; debugUIEnabled: false;'
      style="width: 100%; height: 100%;">
      
      <?php if (!empty($nft_books)): ?>
    <?php foreach ($nft_books as $id => $marker): ?>
    <!-- Define your NFT marker -->
    <a-nft
      type="nft"
      id='nft-<?php echo $id ?>'
      url='includes/nft-books/<?php echo $marker ?>'
      value='<?php echo $id ?>'
      smooth="true"
      smoothCount="10"
      smoothTolerance=".01"
      smoothThreshold="5">

             <!-- Define the 3D model that will be displayed when the NFT marker is detected -->
             <?php
          $position1 = '';
          $position2 = '';
          $position3 = '';
          $scale = '20 20 20';
          if ($id == 5 || $id == 7){
            $position1 = '275 -120 -275';
            $position2 = '363 -120 -200';
            $position3 = '450 -120 -275';
          } elseif ($id == 9 || ($id >= 21 && $id <= 30) || $id == 33) {
            $position1 = '105 -120 -225';
            $position2 = '193 -120 -150';
            $position3 = '280 -120 -225';
          } elseif ($id == 10) {
            $position1 = '275 -140 -275';
            $position2 = '363 -140 -200';
            $position3 = '450 -140 -275';
          }elseif ($id == 11 || ($id >= 13 && $id <= 20)) {
            /*
            // scaled 20 
            $id == 11 || $id == 13
            $position1 = '275 -150 -225';
            $position2 = '363 -150 -150';
            $position3 = '450 -150 -225';
            */
            $scale = '30 30 30';
            $position1 = "412.5 -180 -337.5";
            $position2 = "544.5 -180 -225";
            $position3 = "675 -180 -337.5";
          } else {
            $position1 = '275 -120 -225';
            $position2 = '363 -120 -150';
            $position3 = '450 -120 -225';
          }
          ?>

          <a-entity
            gltf-model="url(includes/similar%20books.glb)"
            scale="<?php echo $scale ?>"
            position="<?php echo $position1 ?>"
            rotation="0 -90 0"
            cursor-listener="href: similar_books.php?id=<?php echo $id ?>">
          </a-entity>

          <a-entity
            gltf-model="url(includes/book%20information.glb)"
            scale="<?php echo $scale ?>"
            position="<?php echo $position2 ?>"
            rotation="0 -90 0"
            cursor-listener="href: book_details.php?id=<?php echo $id ?>">
          </a-entity>

          <a-entity
            gltf-model="url(includes/book%20location.glb)"
            scale="<?php echo $scale ?>"
            position="<?php echo $position3 ?>"
            rotation="0 -90 0"
            cursor-listener="href: map-all.php?id=<?php echo $id ?>">
          </a-entity>

    </a-nft>
    <?php endforeach; ?>
    <?php endif;?>
    <!-- Camera setup -->
    <a-camera rotation-reader  look-controls="enabled: false">
      <a-entity cursor="fuse: false;rayOrigin:mouse;" raycaster="objects:a-entity" position="0 0 -1" geometry="primitive: ring; radiusInner: 0.02; radiusOuter: 0.03" material="color: transparent; opacity: 0;shader: flat">
      </a-entity>
    </a-camera>
  </a-scene>
</div>
</body>