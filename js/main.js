"use strict";

const indexFileName = "index.php"; // 別途ページを用意する場合、ここを書き換える

const font_family = document.querySelector('[name="font_family"]');
const font_size = document.querySelector('[name="font_size"]');
const color = document.querySelector('[name="color"]');
const xy = document.querySelector('[name="xy"]');

const font_family_nav = document.querySelector('[name="font_family_nav"]');
const font_size_nav = document.querySelector('[name="font_size_nav"]');
const color_nav = document.querySelector('[name="color_nav"]');
const xy_nav = document.querySelector('[name="xy_nav"]');

const get_href = (selectorName) => {
    const href = location.href;
    if(selectorName === "x"){
        if(href.indexOf("v.php") > -1){
            return href.replace("v.php", indexFileName);
        } else if(href.indexOf(indexFileName) > -1){
            return href.replace(indexFileName, "v.php");
        } else if(href.indexOf("?") > -1){
            return href.replace("?", "v.php?");
        } else if(href.substr(-1) === "/"){
            return href + "v.php";
        } else {
            return href + "/v.php";
        }
    } else {
        return href;
    }
}

const go_new_url = (selectorName, indexNum) => {
    const href = get_href(selectorName);
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
}

font_size.onchange = event => {
    go_new_url("size", font_size.selectedIndex);
}

color.onchange = event => {
    go_new_url("color", color.selectedIndex);
}

xy.onchange = event => {
    const index = xy.selectedIndex === 1 ? 0 : 1;
    go_new_url("x", index);
}

font_family_nav.onchange = event => {
    go_new_url("family", font_family_nav.selectedIndex);
}

font_size_nav.onchange = event => {
    go_new_url("sizes", font_size_nav.selectedIndex);
}

color_nav.onchange = event => {
    go_new_url("color", color_nav.selectedIndex);
}

xy_nav.onchange = event => {
    const index = xy_nav.selectedIndex === 1 ? 0 : 1;
    go_new_url("x", index);
}
