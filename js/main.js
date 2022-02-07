"use strict";

const current_url = location.pathname;

const font_family = document.querySelector('[name="font_family"]');
const font_size = document.querySelector('[name="font_size"]');
const color = document.querySelector('[name="color"]');
const xy = document.querySelector('[name="xy"]');

const get_new_url = (num, selectedIndex) => {
    return current_url + get_new_parameter().substring(0, num) + selectedIndex + get_new_parameter().substring(num + 1);
}

const get_new_parameter = () => {
    return location.search === "" ? "?family=0&size=5&color=0&x=1" : location.search;
}

font_family.onchange = event => {
    const new_url = get_new_url(8, font_family.selectedIndex);
    window.location.href = new_url;
}

font_size.onchange = event => {
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
