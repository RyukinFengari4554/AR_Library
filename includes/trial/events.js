
AFRAME.registerComponent('markerhandler', {
    init: function() {
        // Add event listener for markerFound event for all markers
        const animatedMarkers = document.querySelectorAll(".animated-marker");
        animatedMarkers.forEach(function(animatedMarker) {
            console.log("Marker ID:", animatedMarker.id); // Log the marker ID
            animatedMarker.addEventListener('click', function(ev) {
                const intersectedElement = ev && ev.detail && ev.detail.intersectedEl;
                if (intersectedElement) {
                console.log("Intersected Element:", intersectedElement.id); // Log the intersected element ID
                // Get references to the animated models within this marker
                const aEntity = animatedMarker.querySelector("#animated-model"); //book loc
                const aEntityb = animatedMarker.querySelector("#animated-model2"); //similar books
                const aEntityc = animatedMarker.querySelector("#animated-model3"); //book info
                if (aEntity && intersectedElement === aEntity) {
                    const markerValue = animatedMarker.getAttribute('value');
                    // Redirect to similar_books.php with marker value appended as a query parameter
                    //window.location.href = 'red.html?id='+ markerValue;
                    console.log("markerValue:", markerValue);
                } else if (aEntityb && intersectedElement === aEntityb) {
                    // Get the value attribute of the found marker
                    const markerValue = animatedMarker.getAttribute('value');
                    // Redirect to similar_books.php with marker value appended as a query parameter
                    window.location.href = '../../similar_books.php?id=' + markerValue;
                } else if (aEntityc && intersectedElement === aEntityc) {
                    // Get the value attribute of the found marker
                    const markerValue = animatedMarker.getAttribute('value');
                    // Redirect to book_details.php with marker value appended as a query parameter
                    window.location.href = '../../book_details.php?id=' + markerValue;
                }
                }else{
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