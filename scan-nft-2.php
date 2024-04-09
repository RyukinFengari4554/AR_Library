<script src="https://aframe.io/releases/0.9.2/aframe.min.js"></script>
<script src="https://raw.githack.com/AR-js-org/AR.js/3.3.1/aframe/build/aframe-ar-nft.js"></script>
<script>
AFRAME.registerComponent('cursor-listener', {
  init: function() {
    var data = this.data;
    var el = this.el;
    el.addEventListener('click', function(evt) {
      window.location.href = data.href;
    });
  }
});
</script>
<a-scene
    vr-mode-ui='enabled: false;'
    renderer="logarithmicDepthBuffer: true; precision: medium;"
    embedded
    arjs='sourceType: webcam; debugUIEnabled: false;'>

  <!-- Define your NFT marker -->
  <a-nft
    type="nft"
    url="https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/nft-books/3cocs"
    smooth="true"
    smoothCount="10"
    smoothTolerance=".01"
    smoothThreshold="5">

    <!-- Define the 3D model that will be displayed when the NFT marker is detected -->
    <a-entity
      gltf-model="url(https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/similar%20books.glb)"
      scale="20 20 20"
      position="275 -120 -225"
      rotation="0 -90 0"
      cursor-listener="href: similar_books.php?id=24">
    </a-entity>

    <!-- Second 3D object -->
    <a-entity
      gltf-model="url(https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/book%20information.glb)"
      scale="20 20 20"
      position="363 -120 -150"
      rotation="0 -90 0"
      cursor-listener="href: book_details.php?id=24">
    </a-entity>

    <!-- Third 3D object -->
    <a-entity
      gltf-model="url(https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/book%20location.glb)"
      scale="20 20 20"
      position="450 -120 -225"
      rotation="0 -90 0"
      cursor-listener="href: map-all.php?id=24">
    </a-entity>

  </a-nft>

  <!-- Camera setup -->
  <a-camera gps-camera="gpsMinDistance:1;" rotation-reader>
    <a-entity cursor="fuse: false;rayOrigin:mouse;" raycaster="objects:a-entity" position="0 0 -1" geometry="primitive: ring; radiusInner: 0.02; radiusOuter: 0.03" material="color: transparent; opacity: 0;shader: flat">
    </a-entity>
  </a-camera>
</a-scene>
