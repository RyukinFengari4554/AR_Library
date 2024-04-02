<?php
// Start the session
session_start();

// Check if the session variables are set
if (isset($_SESSION['nft_id']) && isset($_SESSION['nft_marker'])) {
    // Retrieve the values of session variables
    $id = $_SESSION['nft_id'];
    $marker = $_SESSION['nft_marker'];
} else {
    // Handle the case when session variables are not set
    echo "Session variables not set.";
}

?>

<a-nft
markerhandler 
emitevents="true" 
cursor="rayOrigin: mouse"  
id="animated-marker-<?php echo $id ?>"
type="nft" 
url="https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/nft-books/<?php echo $marker ?>"
width="50"
value="<?php echo $id ?>" 
smooth="true" smoothCount="10" smoothTolerance="0.01" smoothThreshold="5">

<a-entity
    id="model1-<?php echo $id ?>"
    gltf-model="https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/book%20location.glb"
    scale="20 20 20"
    rotation="0 -90 0"
    position="450 -120 -225"> <!-- Book Location 3D model -->
</a-entity>
<a-entity
    id="model2-<?php echo $id ?>"
    gltf-model="https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/similar%20books.glb"
    scale="20 20 20"
    rotation="0 -90 0"
    position="275 -120 -225"> <!-- Similar Books 3D model -->
</a-entity>
<a-entity
    id="model3-<?php echo $id ?>"
    gltf-model="https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/book%20information.glb"
    scale="20 20 20"
    rotation="0 -90 0"
    position="363 -120 -150"> <!-- Book Information 3D model -->
</a-entity>
</a-nft>