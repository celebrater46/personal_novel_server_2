"use strict";

const current_url = location.pathname;

const font_family = document.querySelector('[name="font_family"]');
const font_size = document.querySelector('[name="font_size"]');
const color = document.querySelector('[name="color"]');
const xy = document.querySelector('[name="xy"]');

const font_family_nav = document.querySelector('[name="font_family_nav"]');
const font_size_nav = document.querySelector('[name="font_size_nav"]');
const color_nav = document.querySelector('[name="color_nav"]');
const xy_nav = document.querySelector('[name="xy_nav"]');

const get_new_url = (num, selectedIndex) => {
    return current_url + get_new_parameter().substring(0, num) + selectedIndex + get_new_parameter().substring(num + 1);
}

const get_new_parameter = () => {
    return location.search === "" ? "?family=0&size=5&color=0&x=1" : location.search;
}

const go_new_url = (selectorName, indexNum) => {
    const href = location.href;
    const regex = new RegExp(selectorName + "=[0-9]");
    const symbol = href.indexOf("?") > -1 ? "&" : "?";
    if(href.match(regex) === null){
        window.location.href = href + symbol + selectorName + "=" + indexNum;
    } else {
        window.location.href = href.replace(regex, selectorName + "=" + indexNum);
    }
}

font_family.onchange = event => {
    go_new_url("family", font_family.selectedIndex);
    // const href = location.href;
    // if(href.match(/family=[0-9]/) === null){
    //     window.location.href = href + "&family=" + font_family.selectedIndex;
    // } else {
    //     window.location.href = href.replace(/family=[0-9]/, "family=" + font_family.selectedIndex);
    // }
    // const new_url = href.replace(/family=[0-9]/, "family=" + font_family.selectedIndex);
    // const new_url = get_new_url(8, font_family.selectedIndex);
    // window.location.href = href.replace(/family=[0-9]/, "family=" + font_family.selectedIndex);
}

font_size.onchange = event => {
    go_new_url("size", font_size.selectedIndex);
    // const new_url = get_new_url(15, font_size.selectedIndex + 1);
    // window.location.href = new_url;
}

color.onchange = event => {
    go_new_url("color", color.selectedIndex);
    // const new_url = get_new_url(23, color.selectedIndex + 1);
    // window.location.href = new_url;
}

xy.onchange = event => {
    go_new_url("x", xy.selectedIndex);
    // const new_url = get_new_url(27, xy.selectedIndex);
    // window.location.href = new_url;
}

font_family_nav.onchange = event => {
    go_new_url("family", font_family_nav.selectedIndex);
    // const new_url = get_new_url(8, font_family_nav.selectedIndex);
    // window.location.href = new_url;
}

font_size_nav.onchange = event => {
    go_new_url("sizes", font_size_nav.selectedIndex);
    // const new_url = get_new_url(15, font_size_nav.selectedIndex + 1);
    // window.location.href = new_url;
}

color_nav.onchange = event => {
    go_new_url("color", color_nav.selectedIndex);
    // const new_url = get_new_url(23, color_nav.selectedIndex + 1);
    // window.location.href = new_url;
}

xy_nav.onchange = event => {
    go_new_url("x", xy_nav.selectedIndex);
    // const new_url = get_new_url(27, xy_nav.selectedIndex);
    // window.location.href = new_url;
}
