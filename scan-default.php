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
<!--
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #dfbcbc; background-image: linear-gradient(white , #FFE3E5);">
        
        <a class="navbar-brand mb-0 h1" href="index.html"><img src="https://upload.wikimedia.org/wikipedia/en/4/42/Emilio_Aguinaldo_College_seal.svg" style="width:2rem;height:2rem;"> EAC AR Library</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
      
            <li class="nav-item">
              <a class="nav-link links" href="scan.php"><i class="fa-solid fa-book-open"></i> Scan a Book</a>
            </li>
            <li class="nav-item">
              <a class="nav-link links" href="catalogue.php"><i class="fa-solid fa-search"></i> Catalogue</a>
            </li>
            <li class="nav-item">
              <a class="nav-link links" href="map-whole.php"><i class="fa-solid fa-map"></i> Map</a>
            </li>
            <li class="nav-item">
              <a class="nav-link links" href="login-wsa.php"><i class="fa-solid fa-user"></i> Log-in</a>
            </li>
          </ul>
        </div>
      </nav>
      
        <table style="width:100%">
          <tr>
              <td style="width:25%"><img src="https://upload.wikimedia.org/wikipedia/en/4/42/Emilio_Aguinaldo_College_seal.svg" style="width:50%;height:50%;"> </td>
              <td style="text-align: center;">
                  <h1 style="color: red;">Emilio Aguinaldo College</h1>
                  Gov. D. Mangubat Ave., Brgy. Burol Main, City of Dasmariñas, Cavite 4114, Philippines<br >
                  Tel. Nos. (046) 416-4339/41<br>
                  <a href="https://www.eac.edu.ph" target="_blank" rel="noopener noreferrer">www.eac.edu.ph</a><br>
                  <br>
                  <h3>School of Engineering and Technology</h3>
              </td>
          </tr>
      </table>
      -->
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
  <!--url='https://raw.githack.com/RyukinFengari4554/AR_Library/main/' -->
  <?php if (!empty($nft_books)): ?>
    <?php foreach ($nft_books as $id => $marker): ?>
    <a-nft 
         markerhandler
                emitevents="true"
                cursor="rayOrigin: mouse"
                id="animated-marker-<?php echo $id ?>"
                type='nft'
                url='includes/nft-books/<?php echo $marker ?>'

                value='<?php echo $id ?>'
                smooth='true' smoothCount='10' smoothTolerance='0.01' smoothThreshold='5'>

                <?php
// Define original positions for each object
$original_positions = array(
    array(450, -120, -225), // Object 1
    array(275, -120, -225), // Object 2
    array(363, -120, -150)  // Object 3
);

// Define original scale and new scale
$original_scale = 20;
$new_scale = 20;

// Calculate new positions for each object
$new_positions = array();
foreach ($original_positions as $position) {
    $new_x = ($position[0] / $original_scale) * $new_scale;
    $new_y = ($position[1] / $original_scale) * $new_scale;
    $new_z = ($position[2] / $original_scale) * $new_scale;
    $new_positions[] = array($new_x, $new_y, $new_z);
}
?>

<!-- Use PHP to output dynamic positions -->
<a-entity id="model1-<?php echo $id ?>">
     <!-- Book Location 3D model -->
     <a-box geometry="primitive: box; width: 10; height: 2.4; depth: 0.5" material="opacity: 100" collider="shape: box"></a-box>
    <gltf-model="#animated-asset"
    rotation="0 -90 0"
    scale="<?php echo $new_scale ?> <?php echo $new_scale ?> <?php echo $new_scale ?>"
    position="<?php echo $new_positions[0][0] ?> <?php echo $new_positions[0][1] ?> <?php echo $new_positions[0][2] ?>">
   
</a-entity>
<a-entity id="model2-<?php echo $id ?>" >
    <!-- Similar Books 3D model -->
    <a-box geometry="primitive: box; width: 10; height: 2.4; depth: 0.5" material="opacity: 1000" collider="shape: box"></a-box>
    <gltf-model="#animated-asset2"
    rotation="0 -90 0"
    scale="<?php echo $new_scale ?> <?php echo $new_scale ?> <?php echo $new_scale ?>"
    position="<?php echo $new_positions[1][0] ?> <?php echo $new_positions[1][1] ?> <?php echo $new_positions[1][2] ?>">
</a-entity>
<a-entity id="model3-<?php echo $id ?>" >
 <!-- Book Information 3D model -->
    <a-box geometry="primitive: box; width: 10; height: 2.4; depth: 0.5" material="opacity: 100" collider="shape: box"></a-box>
    <gltf-model="#animated-asset3"
    rotation="0 -90 0"
    scale="<?php echo $new_scale ?> <?php echo $new_scale ?> <?php echo $new_scale ?>"
    position="<?php echo $new_positions[2][0] ?> <?php echo $new_positions[2][1] ?> <?php echo $new_positions[2][2] ?>">   
</a-entity>

        </a-nft>

    <?php endforeach; ?>

    <a-entity camera></a-entity>
    <?php endif; ?>

  </a-scene>

  <!-- Bootstrap -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
<script src="https://kit.fontawesome.com/7dd0b53595.js" crossorigin="anonymous"></script>
</html>