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
<body style="margin: 0; overflow: hidden;">

  <script src="https://aframe.io/releases/0.9.2/aframe.min.js"></script>
  <script src="https://raw.githack.com/AR-js-org/AR.js/3.3.1/aframe/build/aframe-ar-nft.js"></script>
 


 
  <script>
    AFRAME.registerComponent('cursor-listener', {
      init: function() {
        var data = this.data;
        var el = this.el;
        el.addEventListener('click', function(evt) {
          /*
          var newTab = window.open(data.href, '_blank');
          setTimeout(function() {
            window.close();
          }, 100);
*/
          window.parent.postMessage({href: data.href}, '*');
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
      <a-entity
        gltf-model="url(includes/similar%20books.glb)"
        scale="20 20 20"
        position="
        <?php 
          if ($id == 9 ||($id>=21 && $id <= 30) ||$id==33 ) {                       // adjust model to the left //
              echo '105 -120 -225';
          } else {
           echo '275 -120 -225';
          }
        ?>"
        rotation="0 -90 0"
        cursor-listener="href: similar_books.php?id=<?php echo $id ?>">
      </a-entity>

      <!-- Second 3D object -->
      <a-entity
        gltf-model="url(includes/book%20information.glb)"
        scale="20 20 20"
        position="<?php 
          if ($id == 9 ||($id>=21 && $id <= 30) ||$id==33) {   // adjust model to the left //
              echo '193 -120 -150';
          } else {
            echo '363 -120 -150';
          }
            ?>"
        rotation="0 -90 0"
        cursor-listener="href: book_details.php?id=<?php echo $id ?>">
      </a-entity>

      <!-- Third 3D object -->
      <a-entity
        gltf-model="url(includes/book%20location.glb)"
        scale="20 20 20"
        position="<?php 
          if ($id == 9 ||($id>=21 && $id <= 30) ||$id==33) {   // adjust model to the left //
              echo '280 -120 -225';
          } else {
            echo '450 -120 -225';
          }
            ?>"
        rotation="0 -90 0"
        cursor-listener="href: map-all.php?id=<?php echo $id ?>">
      </a-entity>

    </a-nft>
    <?php endforeach; ?>
    <?php endif;?>
    <!-- Camera setup -->
    <a-camera gps-camera="gpsMinDistance:1;" rotation-reader>
      <a-entity cursor="fuse: false;rayOrigin:mouse;" raycaster="objects:a-entity" position="0 0 -1" geometry="primitive: ring; radiusInner: 0.02; radiusOuter: 0.03" material="color: transparent; opacity: 0;shader: flat">
      </a-entity>
    </a-camera>
  </a-scene>
</div>
</body>