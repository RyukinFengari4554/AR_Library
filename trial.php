<!DOCTYPE html>
<html>
  <script src="https://aframe.io/releases/1.3.0/aframe.min.js"></script>
  <!-- we import arjs version without NFT but with marker + location based support -->
  <script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar.js"></script>
  <body style="margin : 0px; overflow: hidden;">
    <a-scene embedded arjs>
      <a-marker preset="hiro" id="animated-asset">
        <a-entity
        id="animated-model"
          position="0 0 0"
          scale="0.05 0.05 0.05"
          gltf-model="includes/bookmocking.gltf"
        ></a-entity>
      </a-marker>
      <a-entity camera></a-entity>
    </a-scene>
  </body>
  <script>
    AFRAME.registerComponent('markerhandler', {

init: function() {
    const animatedMarker = document.querySelector("#animated-marker");
    const aEntity = document.querySelector("#animated-model");

    // every click, we make our model grow in size :)
    animatedMarker.addEventListener('click', function(ev, target){
        const intersectedElement = ev && ev.detail && ev.detail.intersectedEl;
        if (aEntity && intersectedElement === aEntity) {
            const scale = aEntity.getAttribute('scale');
            Object.keys(scale).forEach((key) => scale[key] = scale[key] + 1);
            aEntity.setAttribute('scale', scale);
        }
    });
}});
  </script>
</html>



<!--
<!DOCTYPE html>
<html>
  
  <script src="https://cdn.jsdelivr.net/gh/aframevr/aframe@1c2407b26c61958baa93967b5412487cd94b290b/dist/aframe-master.min.js"></script>
<script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar-nft.js"></script>


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
</style>

<body style="margin : 0px; overflow: hidden;">
  <div class="arjs-loader">
    <div>Loading, please wait...</div>
  </div>

  
  <a-scene
    vr-mode-ui="enabled: false;"
    renderer="logarithmicDepthBuffer: true;"
    embedded
    arjs="trackingMethod: best; sourceType: webcam;debugUIEnabled: false;"
  >
    <a-nft
      type="nft"
      url="https://raw.githack.com/AR-js-org/AR.js/master/aframe/examples/image-tracking/nft/trex/trex-image/trex"
      smooth="true"
      smoothCount="10"
      smoothTolerance=".01"
      smoothThreshold="5"
    >
     <a-entity
        gltf-model="includes/bookmocking.gltf"
        scale="5 5 5"
        position="50 150 0"
      >
      </a-entity>
    </a-nft>
    <a-entity camera></a-entity>
  </a-scene>
</body>
</html>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Twinmotion Embedded Presentation</title>
<style>
    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
    }
    .twinmotion-embed-wrapper {
        height: 100%;
        width: 100%;
        min-height: 375px;
        min-width: 375px;
    }
    .twinmotion-embed-wrapper iframe {
        height: 100%;
        width: 100%;
        border: none;
    }
</style>
</head>
<body>

<div class="twinmotion-embed-wrapper">
  <iframe title="Embedded presentation 'New project 2024-02-08'" frameborder="0"
    allow="fullscreen; gyroscope; accelerometer; magnetometer; execution-while-out-of-viewport; execution-while-not-rendered; xr-spatial-tracking;"
    allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true"
    src="https://twinmotion.unrealengine.com/presentation/eZqrzn0v50FGqzq_?embed"
  >
  </iframe>
</div>
heLLO

</body>
</html>
