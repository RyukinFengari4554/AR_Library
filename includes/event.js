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
          // Perform raycasting
          var raycaster = new THREE.Raycaster();
          var camera = document.querySelector("[camera]").getObject3D('camera');
          var mouse = new THREE.Vector2();
          mouse.x = (ev.detail.cursorPosition.x / window.innerWidth) * 2 - 1;
          mouse.y = -(ev.detail.cursorPosition.y / window.innerHeight) * 2 + 1;
          raycaster.setFromCamera(mouse, camera);

          // Get intersected objects
          var intersects = raycaster.intersectObjects(models.map(model => model.object3D), true);

          // Check if any models were intersected
          if (intersects.length > 0) {
            var intersectedModel = intersects[0].object.el;
            var intersectedElement = intersectedModel.closest('a-entity');

            models.forEach(function(model) {
              // Define the clickable area using position and scale
              var clickableAreaPosition = model.getAttribute('position');
              var clickableAreaScale = model.getAttribute('scale');

              // Define the boundaries of the clickable area
              var minX = clickableAreaPosition.x - clickableAreaScale.x / 2;
              var maxX = clickableAreaPosition.x + clickableAreaScale.x / 2;
              var minY = clickableAreaPosition.y - clickableAreaScale.y / 2;
              var maxY = clickableAreaPosition.y + clickableAreaScale.y / 2;

              // Check if the intersected element is within the clickable area boundaries
              if (
                intersectedElement === model &&
                self.isWithinBounds(intersectedElement.object3D.position.x, minX, maxX) &&
                self.isWithinBounds(intersectedElement.object3D.position.y, minY, maxY)
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
          }
        });
      });
    });
  },

  isWithinBounds: function(value, min, max) {
    return value >= min && value <= max;
  }
});
