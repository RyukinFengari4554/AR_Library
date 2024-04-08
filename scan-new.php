<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AR.js NFT Marker</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/A-Frame/3.11.2/aframe.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@ar-js-org/ar.js@3.2.0/build/aframe-ar.js"></script>

</head>
<body>
<script>
  AFRAME.registerComponent('gotoModel1Page', {
    click() {
      window.location.href = "map-all.php?id=1";
    }
  });

  AFRAME.registerComponent('gotoModel2Page', {
    click() {
      window.location.href = "similar_books.php?id=1";
    }
  });

  AFRAME.registerComponent('gotoModel3Page', {
    click() {
      window.location.href = "book_details.php?id=1";
    }
  });
</script>
<a-scene arjs>
  <a-entity marker-handler="nftMarkerUrl: https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/nft-books/tsotw.fset;">
    <a-gltf-model 
      src="https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/similar%20books.glb" 
      scale="20 20 20" 
      rotation="0 -90 0"
      position="-0.5 0.5 0"
      cursor="rayOrigin: mouse">
      <a-event click="gotoModel1Page">
      </a-event>
    </a-gltf-model>
    
    <a-gltf-model 
      src="https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/book%20location.glb" 
      scale="20 20 20" 
      rotation="0 -90 0"
      position="0.5 0.5 0"
      cursor="rayOrigin: mouse">
      <a-event click="gotoModel2Page">
      </a-event>
    </a-gltf-model>
    
    <a-gltf-model 
      src="https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/book%20information.glb" 
      scale="20 20 20" 
      rotation="0 -90 0"
      position="0 0 0"
      cursor="rayOrigin: mouse">
      <a-event click="gotoModel3Page">
      </a-event>
    </a-gltf-model>
  </a-entity>
</a-scene>


</body>
</html>
