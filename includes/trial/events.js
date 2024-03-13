 // Function to create model entities
 function createModel(id, assetSrc, position, rotation) {
    const entity = document.createElement('a-entity');
    entity.setAttribute('id', id);
    entity.setAttribute('gltf-model', assetSrc);
    entity.setAttribute('scale', '50 50 50');
    entity.setAttribute('rotation', rotation);
    entity.setAttribute('position', position);
    return entity;
}

// Function to create model entities for a marker
function createModelsForMarker(markerId, asset1, asset2, asset3) {
    const marker = document.getElementById(markerId);
    marker.appendChild(createModel('animated-model', asset1, '0 0 0', '0 -90 0'));
    marker.appendChild(createModel('animated-model2', asset2, '850 0 0', '0 -90 0'));
    marker.appendChild(createModel('animated-model3', asset3, '400 0 -400', '0 -90 0'));
}

AFRAME.registerComponent('markerhandler', {
    init: function() {
        const animatedMarkers = document.querySelectorAll(".animated-marker");
        animatedMarkers.forEach(function(animatedMarker) {
            animatedMarker.addEventListener('click', function(ev) {
                const intersectedElement = ev && ev.detail && ev.detail.intersectedEl;
                if (intersectedElement) {
                    const aEntity = animatedMarker.querySelector("#animated-model");
                    const aEntityb = animatedMarker.querySelector("#animated-model2");
                    const aEntityc = animatedMarker.querySelector("#animated-model3 ");
                    const markerValue = animatedMarker.getAttribute('value');
                    if (aEntity && intersectedElement === aEntity) {//loc
                        console.log("Redirect to red.html?id=" + markerValue);
                        window.location.href = 'red.html?id=' + markerValue;
                    } else if (aEntityb && intersectedElement === aEntityb) {// similar
                        console.log("Redirect to similar_books.php?id=" + markerValue);
                        window.location.href = '../../similar_books.php?id=' + markerValue;
                    } else if (aEntityc && intersectedElement === aEntityc) {//info
                        console.log("Redirect to book_details.php?id=" + markerValue);
                        window.location.href = '../../book_details.php?id=' + markerValue;
                    }
                } else {
                    console.log("Intersected element is undefined");
                }
            });
        });
    }
});








/*


AFRAME.registerComponent('markerhandler', {
    init: function() {
        // Get references to all animated models with the class "animated-model" inside the marker
        const animatedModels = this.el.querySelectorAll(".animated-model");
        animatedModels.forEach(function(model) {
            model.setAttribute('draggable', 'false');
        });

        // Add click event listener to each animated model
        animatedModels.forEach(function(model) {
            model.addEventListener('click', function() {
                // Get the value attribute of the clicked marker
                const markerValue = model.parentElement.getAttribute('value');

                // Redirect based on the marker and model
                if (model.id === "animated-model") {
                    window.location.href = 'red.html';
                } else if (model.id === "animated-model2") {
                    // Redirect to similar_books.php with marker value appended as a query parameter
                    window.location.href = '../../similar_books.php?id=' + markerValue;
                } else if (model.id === "animated-model3") {
                    // Redirect to book_details.php with marker value appended as a query parameter
                    window.location.href = '../../book_details.php?id=' + markerValue;
                }
            });
        });
    }
});

AFRAME.registerComponent('markerhandler', {
    init: function() {
        // Get references to the animated models
        const aEntity = document.querySelector("#animated-model");
        const aEntityb = document.querySelector("#animated-model2");
        const aEntityc = document.querySelector("#animated-model3");

        // Add event listener for markerFound event
        this.el.addEventListener('markerFound', function() {
            // Get reference to the animated marker
            const animatedMarker = document.querySelector("#animated-marker");

            // Add click event listener to the animated marker
            animatedMarker.addEventListener('click', function(ev) {
                const intersectedElement = ev && ev.detail && ev.detail.intersectedEl;
                if (aEntity && intersectedElement === aEntity) {
                    window.location.href = 'red.html';
                } else if (aEntityb && intersectedElement === aEntityb) {
                    window.location.href = 'green.html';
                } else if (aEntityc && intersectedElement === aEntityc) {
                    window.location.href = 'blue.html';
                }
            });
        });
    }
});
*/