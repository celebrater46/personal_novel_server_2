"use strict";

const burger = document.getElementById('burger');
const div = document.getElementById('navi_close');

const toggle = () => {
    document.getElementById('nav').classList.toggle('in');
}

burger.addEventListener('click' , () => {
    toggle();
});

div.addEventListener('click' , () => {
    toggle();
});