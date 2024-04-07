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
            // Get the bounding box of the model, considering position and scale
            var boundingBox = new THREE.Box3().setFromObject(model.object3D);
            var modelPosition = model.getAttribute('position');
            var modelScale = model.getAttribute('scale');

            // Adjust the bounding box position based on the model's position and scale
            boundingBox.min.add(new THREE.Vector3(modelPosition.x - modelScale.x / 2, modelPosition.y - modelScale.y / 2, modelPosition.z - modelScale.z / 2));
            boundingBox.max.add(new THREE.Vector3(modelPosition.x + modelScale.x / 2, modelPosition.y + modelScale.y / 2, modelPosition.z + modelScale.z / 2));

            // Check if the intersected element is within the clickable area boundaries
            if (
              intersectedElement === model &&
              self.isWithinBounds(intersectedElement.object3D.position.x, boundingBox.min.x, boundingBox.max.x) &&
              self.isWithinBounds(intersectedElement.object3D.position.y, boundingBox.min.y, boundingBox.max.y) &&
              self.isWithinBounds(intersectedElement.object3D.position.z, boundingBox.min.z, boundingBox.max.z)
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
