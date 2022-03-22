"use strict";

// var PNS = PNS || {};

PNS.containerWidth = document.getElementById("pns_container").clientWidth;

PNS.scroll = (x) => {
    window.scrollTo({
        left: x,
        behavior: 'smooth'
    });
}
console.log(PNS.containerWidth);

PNS.clickedButton = (isLeft) => {
    console.log("button clicked.");
    console.log(window.innerWidth);
    console.log(window.scrollX);
    const x = window.scrollX + (isLeft ? - window.innerWidth * 0.8 : window.innerWidth * 0.8);
    PNS.scroll(x);
}