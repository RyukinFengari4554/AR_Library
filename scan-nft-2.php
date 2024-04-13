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
          if($id == 1){
            $position1 = '200 -120 -225';
            $position2 = '288 -120 -150';
            $position3 = '375 -120 -225';
          }elseif($id == 2){ 
            $position1 = '250 -200 -275';
            $position2 = '338 -200 -200';
            $position3 = '425 -200 -275';
          }elseif ($id == 3 || $id == 6) {  ///tbc 6
            $position1 = '300 100 -300';
            $position2 = '388 100 -225';
            $position3 = '475 100 -300';
          }elseif ($id == 4) {///tbc
            $position1 = '225 200 -275';
            $position2 = '313 200 -200';
            $position3 = '400 200 -275';
          }elseif ($id == 5) {///tbc
            $position1 = '300 200 -300';
            $position2 = '388 200 -225';
            $position3 = '475 200 -300';
          }elseif ( $id == 7) {  ///tbc
            $position1 = '275 100 -300';
            $position2 = '363 100 -225';
            $position3 = '450 100 -300';
          }elseif ( $id == 8) {  ///tbc
            $position1 = '300 -120 -250';
            $position2 = '388 -120 -175';
            $position3 = '475 -120 -250';
          }elseif ($id == 9 || ($id >= 21 && $id <= 23) || ($id >= 25 && $id <= 30)) {
            $position1 = '105 -120 -225';
            $position2 = '193 -120 -150';
            $position3 = '280 -120 -225';
          }elseif ($id == 10) { ///tbc
            $position1 = '275 -100 -300';
            $position2 = '363 -100 -225';
            $position3 = '450 -100 -300';
          }elseif(($id >= 11 && $id <= 14) || ($id >= 16 && $id <= 20)){ 
            $position1 = '295 400 -300';
            $position2 = '383 400 -225';
            $position3 = '470 400 -300';
          }elseif($id == 15){ 
            $position1 = '295 350 -300';
            $position2 = '383 350 -225';
            $position3 = '470 350 -300';
          }elseif($id == 33 || $id == 24){ 
            $position1 = '105 -50 -225';
            $position2 = '193 -50 -150';
            $position3 = '280 -50 -225';
          }elseif($id == 32) { //tbc 
            $position1 = '275 -120 -275';
            $position2 = '363 -120 -200';
            $position3 = '450 -120 -275';
          }elseif($id == 34) { //tbc 34
            $position1 = '275 -50 -225';
            $position2 = '363 -50 -150';
            $position3 = '450 -50 -225';
          }elseif($id == 35 || $id == 37){//tbc both
            $position1 = '275 200 -245';
            $position2 = '363 200 -170';
            $position3 = '450 200 -245';
          }elseif($id == 36) { //tbc up and right
            $position1 = '300 -50 -250';
            $position2 = '388 -50 -175';
            $position3 = '475 -50 -250';
          }elseif($id == 38){//tbc up and right
            $position1 = '345 400 -325';
            $position2 = '433 400 -250';
            $position3 = '520 400 -325';
          }elseif($id == 39) {//tbc up
            $position1 = '275 -120 -250';
            $position2 = '363 -120 -175';
            $position3 = '450 -120 -250';
          }elseif($id == 40){
            $position1 = '275 50 -225';
            $position2 = '363 50 -150';
            $position3 = '450 50 -225';
          }elseif($id == 44) {//tbc all
            $position1 = '255 50 -275';
            $position2 = '343 50 -200';
            $position3 = '430 50 -275';
          }elseif($id == 45 || $id == 50) {//tbc all
            $position1 = '255 100 -275';
            $position2 = '343 100 -200';
            $position3 = '430 100 -275';
          }elseif($id == 46 || $id == 47) { //tbc
            $position1 = '275 -70 -225';
            $position2 = '363 -70 -150';
            $position3 = '450 -70 -225';
          }elseif ($id == 49){//tbc
            $position1 = '250 100 -275';
            $position2 = '338 100 -200';
            $position3 = '425 100 -275';
          }else {
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