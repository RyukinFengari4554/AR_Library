<?php
// Define the array of book URLs

$nft_books = array(
    "tsotw1",
    "agir",
    "atotc",
    "tbt",
    "ts",
    "jc",
    "tgsohi",
    "aac",
    "fsd",
    "tmmm",
    "dr",
    "pot2",
    "mtpas",
    "sftw",
    "ev",
    "fm",
    "sasriph",
    "crit",
    "cah",
    "cacmom",
    "caohati",
    "taed",
    "a",
    "3cocs",
    "ict",
    "casiep",
    "mbom",
    "fosa",
    "msaad",
    "cs2e",
    "eitac",
    "dome",
    "raam",
    "ddc",
    "ahftsomh",
    "twbhcc",
    "isic",
    "acgifbsp",
    "saphoit",
    "lmibb"
);
?>

<script src="https://cdn.jsdelivr.net/gh/aframevr/aframe@1.3.0/dist/aframe-master.min.js"></script>
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


<!-- Load AR.js NFT extension -->
<script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar-nft.js"></script>
<body style='margin : 0px; overflow: hidden;'>
  <!-- Show loader until image descriptors are loaded -->
  <div class="arjs-loader">
    <div>Loading, please wait...</div>
  </div>
  <!-- AR scene -->
  <a-scene vr-mode-ui='enabled: false;' renderer="logarithmicDepthBuffer: true; precision: medium;" embedded arjs='trackingMethod: best; sourceType: webcam; debugUIEnabled: true;'>
    <!-- Camera -->
    <a-entity id="camera" camera position="0 1.6 0"></a-entity>

    <!-- NFT marker definition -->
    <?php foreach ($nft_books as $key => $book): ?>
    <a-nft type='nft' value='<?php echo $key + 1 ?>' 
    url='https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/nft/<?php echo $book ?>' smooth='true' smoothCount='10' smoothTolerance='0.01' smoothThreshold='5'>
        <!-- Entity displaying the 3D model -->
        <a-entity id="model1" gltf-model='https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/similar%20books.glb' scale="200 200 200" position="700 300 0" event-set__mouseenter="scale: 25 25 25" event-set__mouseleave="scale: 20 20 20" cursor="rayOrigin: mouse">
            <a-link href="../../similar_books.php?id=" title="Similar_Books" target="_blank"></a-link>
        </a-entity>
        <a-entity id="model2" gltf-model='https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/book%20location.glb' scale="200 200 200" position="300 300 0" event-set__mouseenter="scale: 25 25 25" event-set__mouseleave="scale: 20 20 20" cursor="rayOrigin: mouse">
            <a-link href="red.html?id=" title="Book_Location" target="_blank"></a-link>
        </a-entity>
        <a-entity id="model3" gltf-model='https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/book%20information.glb' scale="200 200 200" position="550 300 -200" event-set__mouseenter="scale: 25 25 25" event-set__mouseleave="scale: 20 20 20" cursor="rayOrigin: mouse">
            <a-link href="../../book_details.php?id=" title="Book_Details" target="_blank"></a-link>
        </a-entity>
    </a-nft>
    <?php endforeach; ?>
  </a-scene>
</body>

  <!-- COMMENTS FOR 3D MODELS
    onmousedown="window.open('../../similar_books.php?id=', '_blank')" 
    onmousedown="window.open('red.html', '_blank')"
    onmousedown="window.open('../../book_details.php?id=', '_blank')"
    pixels<1k scale="20 20 20" rotation="0 -90 0" , SB:  position="700 300 0" , BL: position="300 300 0", BD: position="550 300 -200" 
    pixels=default rotation="0 -90 0" , SB:  position="700 300 0" , BL: position="300 300 0", BD: position="550 300 -200"  // not yet done
  -->

<script>

document.addEventListener("DOMContentLoaded", function() {
    var nfts = document.querySelectorAll("a-nft");
    
 
    nfts.forEach(function(nft, index) {
        var nftValue = nft.getAttribute("value");
        var models = nft.querySelectorAll("[id^='model']");
        models.forEach(function(model) {
            var link = model.querySelector("a-link");
            if (link && nftValue) {
                if (model.id === "model1") {
                    link.setAttribute("href", "../../similar_books.php?id=" + nftValue);
                } else if (model.id === "model2") {
                    link.setAttribute("href", "red.html?id=" + nftValue);
                } else if (model.id === "model3") {
                    link.setAttribute("href", "../../book_details.php?id=" + nftValue);
                }
            }
        });
    });
});





    /*
    document.addEventListener("DOMContentLoaded", function() {
      var model1 = document.getElementById("model1");
      var link1 = model1.querySelector("a-link");
      var nftValue1 = document.querySelector("a-nft").getAttribute("value");
      link1.setAttribute("href", "../../similar_books.php?id=" + nftValue1);
      var model3 = document.getElementById("model3");
      var link3 = model3.querySelector("a-link");
      var nftValue3 = document.querySelector("a-nft").getAttribute("value");
      link3.setAttribute("href", "../../book_details.php?id=" + nftValue3);
    });
   */
  </script>