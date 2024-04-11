// ==UserScript==
// @name         Open index.html and close current tab
// @namespace    http://your.namespace.here
// @version      0.1
// @description  Opens index.html in a new tab and closes the current tab when a button is clicked
// @author       Your Name
// @match        http://*/*
// @match        https://*/*
// @grant        GM_openInTab
// ==/UserScript==

(function() {
    'use strict';

    // Create a button
    var button = document.createElement('button');
    button.innerHTML = 'Open index.html';
    button.style.position = 'fixed';
    button.style.top = '10px';
    button.style.left = '10px';
    document.body.appendChild(button);

    // Add click event listener to the button
    button.addEventListener('click', function() {
        // Open index.html in a new tab
        GM_openInTab('index.html');
        
        // Close the current tab (optional)
        window.close();
    });
})();
