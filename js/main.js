"use strict";

const body = document.querySelector("body");
const font_family = document.querySelector('[name="font_family"]');
const font_family_options = document.querySelectorAll("#font_family option");
const font_size = document.querySelector("#font_size");
const font_size_options = document.querySelectorAll("#font_size option");
const color = document.querySelector("#color");
const color_options = document.querySelectorAll("#color option");
const xy = document.querySelector("#xy");
const xy_options = document.querySelectorAll("#xy option");

font_family.onchange = event => {
    console.log(font_family.selectedIndex);
    body.style.fontFamily = "Sawarabi " + (font_family.selectedIndex === 0 ? "Gothic" : "Mincho");
}