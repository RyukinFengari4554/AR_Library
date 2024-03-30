<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Fiction Map Page</title>
<section id="title">
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
  <hr style="margin-top: 0; border: 2px solid red;">
  <h1 style="text-align: center;"><i class="fa-solid fa-map"></i><br><br>FICTION MAP</h1>
  <hr style="border: 2px solid red;">
  </section>
<!-- Custom styles for this template -->
<link href="styles/home.css" rel="stylesheet">

    
<style>
    .icon {
      font-size: 2.5rem;
      color: #333;
      cursor: pointer;
      transition: color 0.3s;
    }
</style>

</head>
<body>
    <div class="demo-wrap">
        <img
          class="demo-bg"
          src="https://upload.wikimedia.org/wikipedia/en/4/42/Emilio_Aguinaldo_College_seal.svg"
        >
        <div class="demo-content">
            <script>
                function navigateToPage(page, nft) {
                    if (page === 1) {
                        window.location.href = 'map-all.php?id=' + nft;
                    } else if (page === 2) {
                        window.location.href = "similar_books.php?id=" + nft;
                    } else if (page === 3) {
                        window.location.href = "book_details.php?id=" + nft;
                    } else {
                        console.error("Invalid page number");
                    }
                }
            </script>
            <div>
                <?php

require_once "includes/db.inc.php";

$nft_books = array();

$sql = "SELECT id, marker FROM books";

$result = $mysqli->query($sql);

if ($result) {

    while ($row = $result->fetch_assoc()) {
        $nft_books[$row['id']] = $row['marker'];
    }

    $result->free();
} else {
   
    echo "Error: " . $mysqli->error;
}


$mysqli->close();

?>
<!doctype HTML>
<html>
    <head>
        <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    
    </head>

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
  .fixedbutton {
    position: fixed;
    bottom: 5rem;
    left: 0;
    right: 0;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
    width: 7rem;
}

</style>


<script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar-nft.js"></script>
<script src="https://raw.githack.com/donmccurdy/aframe-extras/master/dist/aframe-extras.loaders.min.js"></script>


<script src="includes/event.js"></script>

<body style='margin : 0px; overflow: hidden;'>
<a href="index.html"><button class="fixedbutton" style="font-size: medium;"><i class="fa-solid fa-house"></i></button></a>
  <div class="arjs-loader">
    <div>Loading, please wait...</div>
  </div>

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
    
  <?php foreach ($nft_books as $id => $marker): ?>
    <a-nft
      markerhandler 
      emitevents="true" 
      cursor="rayOrigin: mouse"  
      id="animated-marker"
      type='nft' 
      url='includes/nft-books/<?php echo $marker ?>'
      width='50'
      value='<?php echo $id ?>' 
      smooth='true' smoothCount='10' smoothTolerance='0.01' smoothThreshold='5'>

      <a-entity
        id="model1"
        gltf-model="#animated-asset"
        scale="20 20 20"
        rotation="0 -90 0"
        position="450 -120 -225"> <!-- Book Location 3D model -->
      </a-entity>
      <a-entity
        id="model2"
        gltf-model="#animated-asset2"
        scale="20 20 20"
        rotation="0 -90 0"
        position="275 -120 -225"> <!-- Similar Books 3D model -->
      </a-entity>
      <a-entity
        id="model3"
        gltf-model="#animated-asset3"
        scale="20 20 20"
        rotation="0 -90 0"
        position="363 -120 -150"> <!-- Book Information 3D model -->
      </a-entity>
    </a-nft>
    <?php endforeach; ?>

    <a-entity camera></a-entity>


  </a-scene>
</body>
<script src="https://kit.fontawesome.com/7dd0b53595.js" crossorigin="anonymous"></script>
</html>
           
            </div>

                <div class="centeral">
                    <br>
                    
                <a href="index.html"><button class="back-button"><i class="fa-solid fa-house"></i></button></a>
                <a href='javascript:history.back()'><button class='back-button'><i class='fa-solid fa-arrow-left'></i></button></a>  
              </div>
        </div>
    </div>


    
</body>
<script src="https://kit.fontawesome.com/7dd0b53595.js" crossorigin="anonymous"></script>

</html>
