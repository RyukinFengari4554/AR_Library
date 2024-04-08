<!DOCTYPE html>
<html>
<head>
<script src="https://aframe.io/releases/1.2.0/aframe.min.js"></script>
    <script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar-nft.js"></script>
</head>
<body style="margin: 0; overflow: hidden;">
    <a-scene
        vr-mode-ui="enabled: false;"
        renderer="logarithmicDepthBuffer: true;"
        embedded
        arjs="sourceType: webcam; debugUIEnabled: false;"
    >
        <a-nft
            type="nft"
      url="https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/nft-books/3cocs"
      smooth="true"
      smoothCount="10"
      smoothTolerance=".01"
      smoothThreshold="5"
    >
      <a-entity
        position="0 0 0"
        scale="0.5 0.5 0.5"
        gltf-model="url(https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/similar%20books.glb)"
        cursor-listener="url: similar_books.php?id=24"
      ></a-entity>
      <a-entity
        position="50 0 0"
        scale="0.5 0.5 0.5"
        gltf-model="url(https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/book%20information.glb)"
        cursor-listener="url: Book_details.php?id=24"
      ></a-entity>
      <a-entity
        position="-50 0 0"
        scale="0.5 0.5 0.5"
        gltf-model="url(https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/book%20location.glb)"
        cursor-listener="url: map-all.php?id=24"
      ></a-entity>
    </a-nft>
    <a-entity camera></a-entity>
  </a-scene>
</body>
</html>
