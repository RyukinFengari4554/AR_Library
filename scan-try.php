<?php
require_once "includes/db.inc.php";
session_start();
$_SESSION['my_array'] = array(24 => '3cocs');

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
  <script src="https://aframe.io/releases/0.9.2/aframe.min.js"></script>
  <script src="https://raw.githack.com/AR-js-org/AR.js/3.3.1/aframe/build/aframe-ar-nft.js"></script>

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
<script>
  AFRAME.registerComponent('zoom-on-wheel', {
    init: function() {
      const el = this.el;
      let vrZoom = 80; // Initial zoom value (same as initial FOV)

      el.addEventListener('wheel', function(evt) {
        const delta = evt.deltaY / 120; // Adjust sensitivity as needed
        vrZoom = Math.min(Math.max(vrZoom - delta, 40), 120); // Set zoom limits
        el.setAttribute('camera', 'fov', vrZoom);
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
          url='https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/nft-books/<?php echo $marker ?>'
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
          $rotation = '';
          $cursor_listener = '';
          if ($id == 9 || ($id >= 21 && $id <= 30) || $id == 33) {
            $position1 = '105 -120 -225';
          } elseif ($id == 11 || $id == 13) {
            $position1 = '275 -150 -225';
          } else {
            $position1 = '275 -120 -225';
          }

          if ($id == 9 || ($id >= 21 && $id <= 30) || $id == 33) {
            $position2 = '193 -120 -150';
          } elseif ($id == 11 || $id == 13) {
            $position2 = '363 -150 -150';
          } else {
            $position2 = '363 -120 -150';
          }

          if ($id == 9 || ($id >= 21 && $id <= 30) || $id == 33) {
            $position3 = '280 -120 -225';
          } elseif ($id == 11 || $id == 13) {
            $position3 = '450 -150 -225';
          } else {
            $position3 = '450 -120 -225';
          }
          ?>

          <a-entity
            gltf-model="url(https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/similar%20books.glb)"
            scale="20 20 20"
            position="<?php echo $position1 ?>"
            rotation="0 -90 0"
            cursor-listener="href: similar_books.php?id=<?php echo $id ?>">
          </a-entity>

          <a-entity
            gltf-model="url(https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/book%20information.glb)"
            scale="20 20 20"
            position="<?php echo $position2 ?>"
            rotation="0 -90 0"
            cursor-listener="href: book_details.php?id=<?php echo $id ?>">
          </a-entity>

          <a-entity
            gltf-model="url(https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/book%20location.glb)"
            scale="20 20 20"
            position="<?php echo $position3 ?>"
            rotation="0 -90 0"
            cursor-listener="href: map-all.php?id=<?php echo $id ?>">
          </a-entity>

        </a-nft>
      <?php endforeach; ?>
    <?php endif; ?>

    <a-camera rotation-reader zoom-on-wheel look-controls="enabled: false; invertZoom: true">
      <a-entity cursor="fuse: false;rayOrigin:mouse;" raycaster="objects:a-entity" position="0 0 -1" geometry="primitive: ring; radiusInner: 0.02; radiusOuter: 0.03" material="color: transparent; opacity: 0;shader: flat">
      </a-entity>
    </a-camera>
  </a-scene>
</body>
