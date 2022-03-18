"use strict";

const burger = document.getElementById('burger');
const div = document.getElementById('navi_close');

const toggle = () => {
    document.getElementById('navMobile').classList.toggle('mobilePanelIn');
    document.getElementById('navPc').classList.toggle('pcPanelIn');
}

burger.addEventListener('click' , () => {
    toggle();
});

div.addEventListener('click' , () => {
    toggle();
});