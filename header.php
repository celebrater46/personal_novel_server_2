<?php

function get_header(){
    $controller = get_controller();
    $burger = '<div id="burger"><img class="burger" src="burger.png"></div>' . "\n";
    return "<div class='novel controller'><div>" . $controller . "</div></div>" . "\n" . $burger;
}

function get_nav(){
//    $nav = '<div id="nav">' . "\n";
//    $nav .= '<a href="#">MENU 1</a>' . "\n";
//    $nav .= '<a href="#">MENU 2</a>' . "\n";
//    $nav .= '<a href="#">MENU 3</a>' . "\n";
//    $nav .= '<div id="navi_close">　</div></div>';
    $controller = get_controller();
    return '<div id="nav">' . "\n" . $controller . '<div id="navi_close">　</div></div>' . "\n";
}

function get_controller(){
    $font_family = '<div class="font family label"><label for="font_family">文字の種類</label></div>';
    $font_family .= '<div class="font family select"><select id="font_family">\n<option value="gothic" selected>ゴシック</option>\n<option value="mincho">明朝</option>\n</select></div>';
    $font_size = '<div class="font size label"><label for="font_size">文字の大きさ</label></div>';
    $font_size .= '<div class="font size select"><select id="font_size">\n';
    $font_size .= '<option>極小</option>' . "\n";
    $font_size .= '<option>特小</option>' . "\n";
    $font_size .= '<option>小</option>' . "\n";
    $font_size .= '<option>やや小</option>' . "\n";
    $font_size .= "<option selected>中</option>" . "\n";
    $font_size .= "<option>やや大</option>" . "\n";
    $font_size .= "<option>大</option>" . "\n";
    $font_size .= "<option>特大</option>" . "\n";
    $font_size .= "<option>極大</option>" . "\n";
    $font_size .= "</select></div>" . "\n";
    $color = '<div class="color label"><label for="color">背景色</label></div>';
    $color .= '<div class="color select"><select id="color">\n<option>白</option>\n<option selected>黒</option>\n<option>ベージュ</option>\n</select></div>';
    $xy = '<div class="xy label"><label for="xy">組み方向</label></div>';
    $xy .= '<div class="xy select"><select id="xy">\n<option selected>横書き</option>\n<option>縦書き</option>\n</select></div>' . "\n";
//    $button = "<button id='apply'>適用</button>" . "\n";
    return $font_family . $font_size . $color . $xy;
}