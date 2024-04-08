<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AR Webpage</title>
    <style>
        /* Styles for the video and canvas */
        #video, #canvas {
            position: absolute;
            top: 0;
            left: 0;
        }
    </style>
</head>
<body>
    <video id="video" width="640" height="480" autoplay></video>
    <canvas id="canvas" width="640" height="480"></canvas>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/opencv/4.5.3/opencv.js" integrity="sha512-pbgErL1+qd6twcGWzo54CfLLje1s9ffBnxR7N0Y8yfPnNfz8xBHzKIXFVZ1X2a3mZzXQ7A53BCfTvJNjN+X81A==" crossorigin="anonymous"></script>
    <script>
        // Function to start the camera and track the image
        function startCamera() {
            navigator.mediaDevices.getUserMedia({ video: true })
            .then(function (stream) {
                var video = document.getElementById('video');
                video.srcObject = stream;
                video.play();

                // Use setInterval to periodically check for the image
                setInterval(function () {
                    var canvas = document.getElementById('canvas');
                    var ctx = canvas.getContext('2d');
                    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

                    // Check if the image is found
                    isImageFound(canvas);
                }, 1000); // Check every 1 second
            })
            .catch(function (err) {
                console.log('Error accessing the camera: ' + err);
            });
        }

        // Function to display a 3D object
        function display3DObject() {
            // Create a Three.js scene, camera, and renderer
            var scene = new THREE.Scene();
            var camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
            var renderer = new THREE.WebGLRenderer();
            renderer.setSize(window.innerWidth, window.innerHeight);
            document.body.appendChild(renderer.domElement);

            // Create a simple cube as an example
            var geometry = new THREE.BoxGeometry();
            var material = new THREE.MeshBasicMaterial({ color: 0x00ff00 });
            var cube = new THREE.Mesh(geometry, material);
            scene.add(cube);

            // Position the camera
            camera.position.z = 5;

            // Render the scene
            function animate() {
                requestAnimationFrame(animate);
                cube.rotation.x += 0.01;
                cube.rotation.y += 0.01;
                renderer.render(scene, camera);
            }
            animate();
        }

        // Function to check if the image is found using OpenCV.js
        function isImageFound(canvas) {
            // Convert canvas to OpenCV Mat
            var src = cv.imread(canvas);
            var dst = new cv.Mat();

            // Convert to grayscale
            cv.cvtColor(src, src, cv.COLOR_RGBA2GRAY, 0);

            // Load the template image (replace 'template.jpg' with your image path)
            var template = cv.imread('https://raw.githack.com/RyukinFengari4554/AR_Library/main/includes/nft-books/tsotw.jpg');

            // Match template
            var match = new cv.Mat();
            cv.matchTemplate(src, template, match, cv.TM_CCOEFF_NORMED);

            // Find the location of the best match
            var minMaxLoc = cv.minMaxLoc(match);
            var maxLoc = minMaxLoc.maxLoc;

            // Set a threshold value for match score
            if (minMaxLoc.maxVal > 0.8) { // You may need to adjust this threshold
                console.log('Image found!');
                display3DObject(); // Display 3D object if image found
            } else {
                console.log('Image not found');
            }

            // Free memory
            src.delete();
            dst.delete();
            match.delete();
            template.delete();
        }

        // Start the camera when the page loads
        window.onload = function () {
            startCamera();
        };
    </script>
</body>
</html>
