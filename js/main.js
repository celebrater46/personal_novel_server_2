"use strict";

// const storage = localStorage;
const current_url = location.pathname;
// const current_parameter = location.search === "" ? "?family=0&size=5&color=0&x=1" : location.search;

// get data from local storage
// ?family=0&size=5&color=0&x=1
// const ls_font_family = typeof storage.font_family != "undefined" ? parseInt(storage.font_family) : null;
// const ls_font_size = typeof storage.font_size != "undefined" ? parseInt(storage.font_size) : null;
// const ls_bg_color = typeof storage.bg_color != "undefined" ? parseInt(storage.bg_color) : null;
// const ls_xy = typeof storage.xy != "undefined" ? parseInt(storage.xy) : null;

const body = document.querySelector("body");
const font_family = document.querySelector('[name="font_family"]');
// const font_family_options = document.querySelectorAll("#font_family option");
// const font_size = document.querySelector("#font_size");
const font_size = document.querySelector('[name="font_size"]');
// const font_size_options = document.querySelectorAll("#font_size option");
// const color = document.querySelector("#color");
const color = document.querySelector('[name="color"]');
// const color_options = document.querySelectorAll("#color option");
// const xy = document.querySelector("#xy");
const xy = document.querySelector('[name="xy"]');
// const xy_options = document.querySelectorAll("#xy option");

const get_new_url = (num, selectedIndex) => {
    return current_url + get_new_parameter().substring(0, num) + selectedIndex + get_new_parameter().substring(num + 1);
}

const get_new_parameter = () => {
    return location.search === "" ? "?family=0&size=5&color=0&x=1" : location.search;
}

font_family.onchange = event => {
    // const new_url = current_url + current_parameter.substring(0, 8) + font_family.selectedIndex + current_parameter.substring(9);
    const new_url = get_new_url(8, font_family.selectedIndex);
    window.location.href = new_url;
}

font_size.onchange = event => {
    // console.log(font_size.selectedIndex +1);
    const new_url = get_new_url(15, font_size.selectedIndex + 1);
    window.location.href = new_url;
}

color.onchange = event => {
    const new_url = get_new_url(23, color.selectedIndex + 1);
    window.location.href = new_url;
}

xy.onchange = event => {
    const new_url = get_new_url(27, xy.selectedIndex);
    window.location.href = new_url;
}
