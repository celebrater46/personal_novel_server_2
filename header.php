<?php

require_once "modules/main.php";
require_once "classes/State.php";

function get_header($state){
    $div = space_br("<div id='navPc' class='novel controller'>", 0);
    $div .= space_br("<div>", 2);
    $div .= get_controller($state, false);
    $div .= space_br("</div>", 2);
    $div .= space_br("</div>", 1);
    $burger = $state->x === 1 ? space_br('<div id="burger"><img class="burger" src="img/burger.png"></div>', 1) : "";
    return $div . $burger;
}

function get_nav($state){
    $controller = get_controller($state, true);
    return '<div id="navMobile">' . "\n" . $controller . '<div id="navi_close">　</div></div>' . "\n";
}

function get_html_font_family($state, $is_nav){
    $html = space_br('<div class="font family label">', 3);
    $html .= space_br('<label for="font_family' . ($is_nav ? "_nav" : "") . '">文字の種類</label>', 4);
    $html .= space_br('</div>', 3);
    $html .= space_br('<div class="font family select">', 3);
    $html .= space_br('<select name="font_family' . ($is_nav ? "_nav" : "") . '">', 4);
    $html .= space_br('<option value="mincho"' . ($state->font_family === 0 ? " selected" : "") . '>明朝</option>', 5);
    $html .= space_br('<option value="gothic"' . ($state->font_family === 1 ? " selected" : "") . '>ゴシック</option>', 5);
    $html .= space_br('</select>', 4);
    $html .= space_br('</div>', 3);
    return $html;
}

function get_html_font_size($state, $is_nav){
    $html = space_br('<div class="font size label">', 3);
    $html .= space_br('<label for="font_size' . ($is_nav ? "_nav" : "") . '">文字の大きさ</label>', 3);
    $html .= space_br('</div>', 3);
    $html .= space_br('<div class="font size select">', 3);
    $html .= space_br('<select name="font_size' . ($is_nav ? "_nav" : "") . '">', 4);
    $html .= space_br('<option' . ($state->font_size === 0 ? " selected" : "") . '>小</option>', 5);
    $html .= space_br('<option' . ($state->font_size === 1 ? " selected" : "") . '>中</option>', 5);
    $html .= space_br('<option' . ($state->font_size === 2 ? " selected" : "") . '>大</option>', 5);
    $html .= space_br('<option' . ($state->font_size === 3 ? " selected" : "") . '>特大</option>', 5);
    $html .= space_br('</select>', 4);
    $html .= space_br('</div>', 3);
    return $html;
}

function get_html_color($state, $is_nav){
    $html = space_br('<div class="color label">', 3);
    $html .= space_br('<label for="color' . ($is_nav ? "_nav" : "") . '">背景色</label>', 4);
    $html .= space_br('</div>', 3);
    $html .= space_br('<div class="color select">', 3);
    $html .= space_br('<select name="color' . ($is_nav ? "_nav" : "") . '">', 4);
    $html .= space_br('<option' . ($state->color === 0 ? " selected" : "") . '>黒</option>', 5);
    $html .= space_br('<option' . ($state->color === 1 ? " selected" : "") . '>白</option>', 5);
    $html .= space_br('<option' . ($state->color === 2 ? " selected" : "") . '>ベージュ</option>', 5);
    $html .= space_br('</select>', 4);
    $html .= space_br('</div>', 3);
    return $html;
}

function get_html_xy($state, $is_nav){
    $html = space_br('<div class="xy label">', 3);
    $html .= space_br('<label for="xy' . ($is_nav ? "_nav" : "") . '">組み方向</label>', 3);
    $html .= space_br('</div>', 4);
    $html .= space_br('<div class="xy select">', 3);
    $html .= space_br('<select name="xy' . ($is_nav ? "_nav" : "") . '">', 4);
    $html .= space_br('<option' . ($state->x === 1 ? " selected" : "") . '>横書き</option>', 5);
    $html .= space_br('<option' . ($state->x === 0 ? " selected" : "") . '>縦書き</option>', 5);
    $html .= space_br('</select>', 4);
    $html .= space_br('</div>', 3);
    return $html;
}

function get_controller($state, $is_nav){
    $family = get_html_font_family($state, $is_nav);
    $size = get_html_font_size($state, $is_nav);
    $color = get_html_color($state, $is_nav);
    $xy = get_html_xy($state, $is_nav);
    return $family . $size . $color . $xy;
}