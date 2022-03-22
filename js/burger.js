"use strict";

let PNS = {};

PNS.burger = document.getElementById('pns_burger');
PNS.div = document.getElementById('navi_close');

PNS.toggle = () => {
    document.getElementById('navMobile').classList.toggle('mobilePanelIn');
    document.getElementById('navPc').classList.toggle('pcPanelIn');
}

PNS.burger.addEventListener('click' , () => {
    PNS.toggle();
});

PNS.div.addEventListener('click' , () => {
    PNS.toggle();
});