"use strict";

const containerWidth = document.getElementById("container").clientWidth;

const scroll = (x) => {
    window.scrollTo({
        left: x,
        behavior: 'smooth'
    });
}
console.log(containerWidth);

const clickedButton = (isLeft) => {
    console.log("button clicked.");
    console.log(window.innerWidth);
    console.log(window.scrollX);
    const x = window.scrollX + (isLeft ? - window.innerWidth * 0.8 : window.innerWidth * 0.8);
    scroll(x);
}