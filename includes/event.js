AFRAME.registerComponent('markerhandler', {
    init: function() {
        var nfts = document.querySelectorAll("a-nft");
    
 
    nfts.forEach(function(nft) {
        var nftValue = nft.getAttribute("value");
        var models = nft.querySelectorAll("[id^='model']");

        nft.addEventListener('click', function(ev) {
            const intersectedElement = ev && ev.detail && ev.detail.intersectedEl;
            models.forEach(function(model) {
                if (model && intersectedElement === model) {
                    if (model.id === "model1") {
                        window.location.href = 'map-fic.html?id=' + nftValue;
                    } else if (model.id === "model2") {
                        window.location.href = "similar_books.php?id=" + nftValue;
                    } else if (model.id === "model3") {
                        window.location.href = "book_details.php?id=" + nftValue;
                    }
                }
            });
        });
        
            
        });
    }
});

      