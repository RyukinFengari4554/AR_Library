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
                    // Get the value attribute of the found marker
                    const markerValue = animatedMarker.getAttribute('value');
                    // Redirect to book_details.php with marker value appended as a query parameter
                    window.location.href = '../../book_details.php?id=' + markerValue;
                }
            });
        });
    }
});


/*
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