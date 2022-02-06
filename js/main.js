"use strict";

const body = document.querySelector("body");
const font_family = document.querySelector("#font_family");
const font_family_options = document.querySelectorAll("#font_family option");
const font_size = document.querySelector("#font_size");
const font_size_options = document.querySelectorAll("#font_size option");
const color = document.querySelector("#color");
const color_options = document.querySelectorAll("#color option");
const xy = document.querySelector("#xy");
const xy_options = document.querySelectorAll("#xy option");

font_family.addEventListener('change', () =>{
    // let index =  this.selectedIndex;
    body.style.fontFamily = "Sawarabi " + (this.selectedIndex === 0 ? "Gothic" : "Mincho");
    console.log(this.selectedIndex);
    setTimeout( () => console.log(this.selectedIndex) ,1000 );
});


console.log(font_family);
// body.style.fontFamily = "ＭＳ 明朝";

// setTimeout( () => console.log(3) ,1000 );
// setTimeout( () => console.log(2) ,2000 );
// setTimeout( () => console.log(1) ,3000 );