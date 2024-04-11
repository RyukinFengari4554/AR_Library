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
             <?php
          $position1 = '';
          $position2 = '';
          $position3 = '';
          $scale = '20 20 20';
          if($id == 2 ){ //tb dioriented if 50, if -50 dind appear?
            $position1 = '275 -200 -275';
            $position2 = '363 -200 -200';
            $position3 = '450 -200 -275';
          } elseif ($id == 3 || $id == 49) {
            $position1 = '275 100 -275';
            $position2 = '363 100 -200';
            $position3 = '450 100 -275';
          } elseif ($id == 5 || $id == 7){
            $position1 = '275 -120 -275';
            $position2 = '363 -120 -200';
            $position3 = '450 -120 -275';
          } elseif ($id == 6) {
            $position1 = '275 200 -275';
            $position2 = '363 200 -200';
            $position3 = '450 200 -275';
          } elseif ($id == 9 || ($id >= 21 && $id <= 30)) {
            $position1 = '105 -120 -225';
            $position2 = '193 -120 -150';
            $position3 = '280 -120 -225';
          } elseif ($id == 10) {
            $position1 = '275 -140 -275';
            $position2 = '363 -140 -200';
            $position3 = '450 -140 -275';
          } elseif($id == 11 || ($id >= 13 && $id <= 20)){ //tbc
            $position1 = '275 400 -275';
            $position2 = '363 400 -200';
            $position3 = '450 400 -275';
          }elseif($id == 33){
            $position1 = '105 -50 -225';
            $position2 = '193 -50 -150';
            $position3 = '280 -50 -225';
          }elseif($id == 35){//tbc up
            $position1 = '275 100 -245';
            $position2 = '363 100 -170';
            $position3 = '450 100 -245';
          }elseif($id == 36){
            $position1 = '275 -50 -225';
            $position2 = '363 -50 -150';
            $position3 = '450 -50 -225';
          }elseif($id == 38){//tbc up and right
            $position1 = '320 400 -300';
            $position2 = '408 400 -225';
            $position3 = '495 400 -300';
          }elseif($id == 40){
            $position1 = '275 50 -225';
            $position2 = '363 50 -150';
            $position3 = '450 50 -225';
          }elseif ($id == 44 ||$id == 45||$id == 50) {
            $position1 = '255 150 -275';
            $position2 = '343 150 -200';
            $position3 = '430 150 -275';
          }
           else {
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