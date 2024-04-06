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
                    compare1 = "model1-" + nftValue;
                    compare2 = "model2-" + nftValue;
                    compare3 = "model3-" + nftValue;
                    if (model.id === compare1) {
                        window.location.href = 'map-all.php?id=' + nftValue;
                        var state = 1;
                        console.log(state);
                        //navigateToPage(state, nftValue);
                    } else if (model.id === compare2) {
                        window.location.href = "similar_books.php?id=" + nftValue;
                        var state = 2;
                        console.log(state);
                        //navigateToPage(state, nftValue);
                    } else if (model.id === compare3) {
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

      