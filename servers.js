//Real time update functions are on the main .php

function frameLoadedW10(){ //Iframe loaded
    var iframewin10 = document.getElementById("framew10");
    document.getElementById("w10").style.backgroundImage = "none";
    iframewin10.style.visibility = "visible";
    //updateInfo();
    iframewin10.contentWindow.document.forms[0].onsubmit = function(){ //Load gif when a button is pressed
        document.getElementById("w10").style.background = 'url(./img/loading.gif) left center no-repeat';
        iframewin10.style.visibility = "hidden";
    };
}