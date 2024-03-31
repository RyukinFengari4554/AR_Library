AFRAME.registerComponent('markerhandler', {
    init: function() {

        this.el.addEventListener('markerFound', function() {
        var nfts = document.querySelectorAll("a-nft");
    
 
    nfts.forEach(function(nft) {
        var nftValue = nft.getAttribute("value");
        var models = nft.querySelectorAll("[id^='model']");

        nft.addEventListener('click', function(ev) {
            const intersectedElement = ev && ev.detail && ev.detail.intersectedEl;
            models.forEach(function(model) {
                if (model && intersectedElement === model) {
                    if (model.id === "model1") {
                        window.location.href = 'map-all.php?id=' + nftValue;
                        var state = 1;
                        console.log(state);
                        //navigateToPage(state, nftValue);
                    } else if (model.id === "model2") {
                        window.location.href = "similar_books.php?id=" + nftValue;
                        var state = 2;
                        console.log(state);
                        //navigateToPage(state, nftValue);
                    } else if (model.id === "model3") {
                        window.location.href = "book_details.php?id=" + nftValue;
                        var state = 3;
                        console.log(state);
                        //navigateToPage(state, nftValue);
                    }
                }
            });
        });
        
    }); 
        });
    }

});

      