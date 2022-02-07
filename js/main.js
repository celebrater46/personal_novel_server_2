"use strict";

const storage = localStorage;
const current_url = location.pathname;
const current_parameter = location.search;

// get data from local storage
// ?family=0&size=5&color=0&x=1
const ls_font_family = typeof storage.font_family != "undefined" ? parseInt(storage.font_family) : null;
const ls_font_size = typeof storage.font_size != "undefined" ? parseInt(storage.font_size) : null;
const ls_bg_color = typeof storage.bg_color != "undefined" ? parseInt(storage.bg_color) : null;
const ls_xy = typeof storage.xy != "undefined" ? parseInt(storage.xy) : null;

const body = document.querySelector("body");
const font_family = document.querySelector('[name="font_family"]');
const font_family_options = document.querySelectorAll("#font_family option");
const font_size = document.querySelector("#font_size");
const font_size_options = document.querySelectorAll("#font_size option");
const color = document.querySelector("#color");
const color_options = document.querySelectorAll("#color option");
const xy = document.querySelector("#xy");
const xy_options = document.querySelectorAll("#xy option");

const changeFontFamily = (num) => {
    // body.style.fontFamily = "Sawarabi " + (num === 0 ? "Gothic" : "Mincho");
}

const changeFontSize = (num) => {

}

font_family.onchange = event => {
    console.log(font_family.selectedIndex);
    // body.style.fontFamily = "Sawarabi " + (font_family.selectedIndex === 0 ? "Gothic" : "Mincho");
    // changeFontFamily(font_family.selectedIndex);
    const new_parameter = current_parameter === "" ? "?family=0&size=5&color=0&x=1" : current_parameter;
    const new_url = current_url + new_parameter.substring(0, 8) + font_family.selectedIndex + new_parameter.substring(9);
    // console.log(new_url);
    // window.location.href("https://enin-world.sakura.ne.jp/");
    // window.location.href = "https://enin-world.sakura.ne.jp/";
    window.location.href = new_url;
}

if(ls_font_family !== null || ls_font_size !== null || ls_bg_color !== null || ls_xy !== null){
    changeFontFamily(ls_font_family);
}