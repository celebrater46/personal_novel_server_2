"use strict";

// var PNS = PNS || {};

PNS.pnsPath = "app/php/personal_novel_server/"
PNS.indexFileName = "novel.php"; // 別途ページを用意する場合、ここを書き換える
PNS.vFileName = PNS.pnsPath + "v.php";

PNS.font_family = document.querySelector('[name="font_family"]');
PNS.font_size = document.querySelector('[name="font_size"]');
PNS.color = document.querySelector('[name="color"]');
PNS.xy = document.querySelector('[name="xy"]');

PNS.font_family_nav = document.querySelector('[name="font_family_nav"]');
PNS.font_size_nav = document.querySelector('[name="font_size_nav"]');
PNS.color_nav = document.querySelector('[name="color_nav"]');
PNS.xy_nav = document.querySelector('[name="xy_nav"]');

PNS.get_href = (selectorName) => {
    const href = location.href;
    if(selectorName === "x"){
        if(href.indexOf("v.php") > -1){
            return href.replace(PNS.vFileName, PNS.indexFileName);
        } else if(href.indexOf(PNS.indexFileName) > -1){
            return href.replace(PNS.indexFileName, PNS.vFileName);
        } else if(href.indexOf("?") > -1){
            return href.replace("?", PNS.vFileName + "?");
        } else if(href.substr(-1) === "/"){
            return href + PNS.vFileName;
        } else {
            return href + "/" + PNS.vFileName;
        }
    } else {
        return href;
    }
}

PNS.go_new_url = (selectorName, indexNum) => {
    const href = PNS.get_href(selectorName);
    const regex = new RegExp(selectorName + "=[0-9]");
    const symbol = href.indexOf("?") > -1 ? "&" : "?";
    if(href.match(regex) === null){
        window.location.href = href + symbol + selectorName + "=" + indexNum;
    } else {
        window.location.href = href.replace(regex, selectorName + "=" + indexNum);
    }
}

PNS.font_family.onchange = event => {
    PNS.go_new_url("family", PNS.font_family.selectedIndex);
}

PNS.font_size.onchange = event => {
    PNS.go_new_url("size", PNS.font_size.selectedIndex);
}

if(PNS.color !== null){
    PNS.color.onchange = event => {
        PNS.go_new_url("color", PNS.color.selectedIndex);
    }
}

PNS.xy.onchange = event => {
    const index = PNS.xy.selectedIndex === 1 ? 0 : 1;
    PNS.go_new_url("x", index);
}

PNS.font_family_nav.onchange = event => {
    PNS.go_new_url("family", PNS.font_family_nav.selectedIndex);
}

PNS.font_size_nav.onchange = event => {
    PNS.go_new_url("size", PNS.font_size_nav.selectedIndex);
}

if(PNS.color_nav !== null){
    PNS.color_nav.onchange = event => {
        PNS.go_new_url("color", PNS.color_nav.selectedIndex);
    }
}

PNS.xy_nav.onchange = event => {
    const index = PNS.xy_nav.selectedIndex === 1 ? 0 : 1;
    PNS.go_new_url("x", index);
}
