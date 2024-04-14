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
          }elseif ($id == 3 || $id == 6) { 
            $position1 = '300 100 -300';
            $position2 = '388 100 -225';
            $position3 = '475 100 -300';
          }elseif ($id == 4) { //tbc
            $position1 = '245 200 -300';
            $position2 = '333 200 -225';
            $position3 = '420 200 -300';
          }elseif ($id == 5) { //tbc
            $position1 = '300 200 -320';
            $position2 = '388 200 -245';
            $position3 = '475 200 -320';
          }elseif ( $id == 7) { //tbc
            $position1 = '275 80 -320';
            $position2 = '363 80 -245';
            $position3 = '450 80 -320';
          }elseif ( $id == 8) { //tbc
            $position1 = '300 -120 -270';
            $position2 = '388 -120 -195';
            $position3 = '475 -120 -270';
          }elseif ($id == 9 || ($id >= 21 && $id <= 23) || ($id >= 25 && $id <= 30)) {
            $position1 = '105 -120 -225';
            $position2 = '193 -120 -150';
            $position3 = '280 -120 -225';
          }elseif ($id == 10) { //tbc
            $position1 = '275 -100 -320';
            $position2 = '363 -100 -245';
            $position3 = '450 -100 -320';
          }elseif(($id >= 11 && $id <= 14) || ($id >= 16 && $id <= 20)){ 
            $position1 = '295 400 -300';
            $position2 = '383 400 -225';
            $position3 = '470 400 -300';
          }elseif($id == 15){ //tbc
            $position1 = '315 325 -325';
            $position2 = '403 325 -250';
            $position3 = '490 325 -325';
          }elseif($id == 33 || $id == 24){ 
            $position1 = '105 -50 -225';
            $position2 = '193 -50 -150';
            $position3 = '280 -50 -225';
          }elseif($id == 32) { 
            $position1 = '275 -120 -275';
            $position2 = '363 -120 -200';
            $position3 = '450 -120 -275';
          }elseif($id == 34) { 
            $position1 = '275 -50 -225';
            $position2 = '363 -50 -150';
            $position3 = '450 -50 -225';
          }elseif($id == 35 || $id == 37){
            $position1 = '275 200 -245';
            $position2 = '363 200 -170';
            $position3 = '450 200 -245';
          }elseif($id == 36) { 
            $position1 = '300 -50 -250';
            $position2 = '388 -50 -175';
            $position3 = '475 -50 -250';
          }elseif($id == 38){//tbc
            $position1 = '365 400 -370';
            $position2 = '453 400 -295';
            $position3 = '540 400 -370';
          }elseif($id == 39) {//tbc up
            $position1 = '295 -120 -295';
            $position2 = '383 -120 -220';
            $position3 = '470 -120 -295';
          }elseif($id == 40){
            $position1 = '275 50 -225';
            $position2 = '363 50 -150';
            $position3 = '450 50 -225';
          }elseif($id == 42){//tbc
            $position1 = '230 -120 -225';
            $position2 = '318 -120 -150';
            $position3 = '405 -120 -225';
          }elseif($id == 44) {//tbc
            $position1 = '230 200 -275';
            $position2 = '318 200 -200';
            $position3 = '405 200 -275';
          }elseif($id == 45) {//tbc
            $position1 = '215 100 -275';
            $position2 = '303 100 -200';
            $position3 = '390 100 -275';
          }elseif($id == 46) { //tbc
            $position1 = '250 -50 -225';
            $position2 = '338 -50 -150';
            $position3 = '425 -50 -225';
          }elseif($id == 47) { //tbc
            $position1 = '230 -70 -225';
            $position2 = '318 -70 -150';
            $position3 = '405 -70 -225';
          }elseif($id == 48){
            $position1 = '250 -120 -225';
            $position2 = '338 -120 -150';
            $position3 = '425 -120 -225';
          }elseif ($id == 49){//tbc
            $position1 = '205 100 -275';
            $position2 = '293 100 -200';
            $position3 = '380 100 -275';
          }elseif($id == 50) {
            $position1 = '235 100 -275';
            $position2 = '323 100 -200';
            $position3 = '410 100 -275';
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