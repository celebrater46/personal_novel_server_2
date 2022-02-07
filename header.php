<?php

function get_header($state){
    $controller = get_controller($state);
    $burger = '<div id="burger"><img class="burger" src="burger.png"></div>' . "\n";
    return "<div class='novel controller'><div>" . $controller . "</div></div>" . "\n" . $burger;
}

function get_nav($state){
//    $nav = '<div id="nav">' . "\n";
//    $nav .= '<a href="#">MENU 1</a>' . "\n";
//    $nav .= '<a href="#">MENU 2</a>' . "\n";
//    $nav .= '<a href="#">MENU 3</a>' . "\n";
//    $nav .= '<div id="navi_close">　</div></div>';
    $controller = get_controller($state);
    return '<div id="nav">' . "\n" . $controller . '<div id="navi_close">　</div></div>' . "\n";
}

function get_controller($state){
    $font_family = '<div class="font family label"><label for="font_family">文字の種類</label></div>';
    $font_family .= '<div class="font family select"><select name="font_family">\n<option value="gothic"' . ($state->font_family === 1 ? "" : " selected") . '>ゴシック</option>\n<option value="mincho"' . ($state->font_family === 0 ? "" : " selected") . '>明朝</option>\n</select></div>';
    $font_size = '<div class="font size label"><label for="font_size">文字の大きさ</label></div>';
    $font_size .= '<div class="font size select"><select name="font_size">\n';
    $font_size .= '<option' . ($state->font_size === 1 ? " selected" : "") . '>極小</option>' . '\n';
    $font_size .= '<option' . ($state->font_size === 2 ? " selected" : "") . '>特小</option>' . '\n';
    $font_size .= '<option' . ($state->font_size === 3 ? " selected" : "") . '>小</option>' . '\n';
    $font_size .= '<option' . ($state->font_size === 4 ? " selected" : "") . '>やや小</option>' . '\n';
    $font_size .= '<option' . ($state->font_size === 5 ? " selected" : "") . '>中</option>' . '\n';
    $font_size .= '<option' . ($state->font_size === 6 ? " selected" : "") . '>やや大</option>' . '\n';
    $font_size .= '<option' . ($state->font_size === 7 ? " selected" : "") . '>大</option>' . '\n';
    $font_size .= '<option' . ($state->font_size === 8 ? " selected" : "") . '>特大</option>' . '\n';
    $font_size .= '<option' . ($state->font_size === 9 ? " selected" : "") . '>極大</option>' . '\n';
    $font_size .= '</select></div>' . "\n";
    $color = '<div class="color label"><label for="color">背景色</label></div>';
    $color .= '<div class="color select"><select name="color">' . '\n';
    $color .= '<option' . ($state->color === 1 ? " selected" : "") . '>白</option>' . '\n';
    $color .= '<option' . ($state->color === 2 ? " selected" : "") . '>黒</option>' . '\n';
    $color .= '<option' . ($state->color === 3 ? " selected" : "") . '>ベージュ</option>' . '\n';
    $color .= '</select></div>';
    $xy = '<div class="xy label"><label for="xy">組み方向</label></div>';
    $xy .= '<div class="xy select"><select name="xy">\n<option selected>横書き</option>\n<option>縦書き</option>\n</select></div>' . "\n";
//    $button = "<button id='apply'>適用</button>" . "\n";
    return $font_family . $font_size . $color . $xy;
}