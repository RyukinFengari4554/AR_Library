

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<title>Scan Page</title>
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!-- Custom styles for this template -->
<link href="styles/home.css" rel="stylesheet">
<section id="title">
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #dfbcbc; background-image: linear-gradient(white , #FFE3E5);">
        
        <a class="navbar-brand mb-0 h1" href="index.html"><img src="https://upload.wikimedia.org/wikipedia/en/4/42/Emilio_Aguinaldo_College_seal.svg" style="width:2rem;height:2rem;"> EAC AR Library</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link links" href="catalogue.php"><i class="fa-solid fa-search"></i> Catalogue</a>
            </li>
            <li class="nav-item">
              <a class="nav-link links" href="map-whole.php"><i class="fa-solid fa-map"></i> Map</a>
            </li>
            <li class="nav-item">
              <a class="nav-link links" href="login-wsa.php"><i class="fa-solid fa-user"></i> Log-in</a>
            </li>
          </ul>
        </div>
      </nav>
    
  <hr style="margin-top: 0; border: 2px solid red;">
  <h1 style="text-align: center;"><i class="fa-solid fa-book-open"></i><br><br>SCAN A BOOK</h1>
  <hr style="border: 2px solid red;">
  </section>
<!-- Custom styles for this template -->
<link href="styles/home.css" rel="stylesheet">

    
<style>
    .icon {
      font-size: 2.5rem;
      color: #333;
      cursor: pointer;
      transition: color 0.3s;
    }
    .search-input {
        width: 25rem;
        
        border: 2px solid #ccc;
        border-radius: 5px;
        outline: none;
    }
    .search-button {
        position: absolute;
        top: 0;
        right: 0;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 0 5px 5px 0;
        padding: 10px 15px;
        cursor: pointer;
    }
    .search-button:hover {
        background-color: #0056b3;
    }
    input[type="text"]
    {
        font-size:24px;
    }
</style>

</head>
<body style="background-image: linear-gradient(white , #fa868e); background-attachment: fixed;">
    <div class="demo-wrap">
        <img
          class="demo-bg"
          src="https://upload.wikimedia.org/wikipedia/en/4/42/Emilio_Aguinaldo_College_seal.svg"
        >
        <div class="demo-content">
        <iframe id="childFrame" class="centeral" style="width:100%; height: 50rem;" src="scan-nft-2.php"></iframe>

                <div class="centeral">
                    <br>
                    
                <a href="index.html"><button class="back-button"><i class="fa-solid fa-house"></i></button></a>
                <a href='javascript:history.back()'><button class='back-button'><i class='fa-solid fa-arrow-left'></i></button></a>  
                <script>
                        var count = 0;
                        while (count < 5) {
                            document.write('<br>');
                            count++;
                        }
                </script>    
            </div>
        </div>
    </div>

    <script>
    // Add event listener for receiving messages from child
    window.addEventListener('message', function(event) {
        // Check if message is from the child iframe
        if (event.source === document.getElementById('childFrame').contentWindow) {
            // Redirect to the URL received from child
            window.location.href = event.data.href;
        }
    });
</script>

<!-- Bootstrap -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>
<script src="https://kit.fontawesome.com/7dd0b53595.js" crossorigin="anonymous"></script>
</html>
