AFRAME.registerComponent('markerhandler', {
  init: function() {
    var self = this;

    // Wait for the marker to be found
    this.el.addEventListener('markerFound', function() {
      var nfts = document.querySelectorAll("a-nft");

      // Iterate over each a-nft element
      nfts.forEach(function(nft) {
        var nftValue = nft.getAttribute("value");
        var models = nft.querySelectorAll("[id^='model']");

        // Add click event listener to each a-nft element
        nft.addEventListener('click', function(ev) {
          const intersectedElement = ev && ev.detail && ev.detail.intersectedEl;
          models.forEach(function(model) {
            // Get the bounding box of the model
            var boundingBox = new THREE.Box3().setFromObject(model.object3D);

            // Define the boundaries of the clickable area
            var minX = boundingBox.min.x;
            var maxX = boundingBox.max.x;
            var minY = boundingBox.min.y;
            var maxY = boundingBox.max.y;
            var minZ = boundingBox.min.z;
            var maxZ = boundingBox.max.z;

            // Check if the intersected element is within the clickable area boundaries
            if (
              intersectedElement === model &&
              self.isWithinBounds(intersectedElement.object3D.position.x, minX, maxX) &&
              self.isWithinBounds(intersectedElement.object3D.position.y, minY, maxY) &&
              self.isWithinBounds(intersectedElement.object3D.position.z, minZ, maxZ)
            ) {
              // Perform actions based on the clicked model
              // You can replace the window.location.href with your desired action
              if (model.id === "model1-" + nftValue) {
                window.location.href = 'map-all.php?id=' + nftValue;
              } else if (model.id === "model2-" + nftValue) {
                window.location.href = "similar_books.php?id=" + nftValue;
              } else if (model.id === "model3-" + nftValue) {
                window.location.href = "book_details.php?id=" + nftValue;
              }
            }
          });
        });
      });
    });
  },

  isWithinBounds: function(value, min, max) {
    return value >= min && value <= max;
  }
});
