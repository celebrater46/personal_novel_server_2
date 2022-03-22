<?php

namespace personal_novel_server\modules;

function get_font_family($num){
    if($num === 0){
        return space_br('body{ font-family: "Noto Serif JP"; }', 2);
    } else {
        return space_br('body{ font-family: "Kosugi"; }', 2);
    }
}

function get_font_size($state){
    $base = $state->is_phone ? 4 : 18; // px(PC), vw(Phone)
    $scale = $state->is_phone ? "vw" : "px";
    $font_size = calc_font_size($state->font_size, $base);
    $html = space_br("div.containter, p.text.line{ font-size: " . $font_size . $scale . "; }", 2);
    $html .= space_br("h1{ font-size: " . round($font_size * 2) . $scale . "; }", 2);
    $html .= space_br("h2{ font-size: " . round($font_size * 1.5) . $scale . "; }", 2);
    $html .= space_br("h3{ font-size: " . round($font_size * 1.2) . $scale . "; }", 2);
    return $html;
}

function calc_font_size($size, $base){
    switch($size){
        case 0: return $base * 0.7;
        case 1: return $base * 1.0;
        case 2: return $base * 1.3;
        case 3: return $base * 1.6;
        default: return $base;
    }
}

function get_color($state){
//    var_dump($state);
    $str = "";
    switch ($state->color){
        // 0 == デフォルト値（暫定）
        case 0:
            $str .= space_br("body{ background-color: #000001; color: silver; }", 2);
            $str .= space_br("div.novel.controller{ background-color: #333333; color: silver; }", 2);
            $str .= space_br("div#nav{ background-color: #333333; color: silver; }", 2);
            $str .= space_br("a{ color: goldenrod; }", 2);
            $str .= space_br("a:hover{ color: gold; }", 2);
            break;
        case 1:
            $str .= space_br("body{ background-color: white; color: black; }", 2);
            $str .= space_br("div.novel.controller{ background-color: silver; color: black; }", 2);
            $str .= space_br("div#nav{ background-color: silver; color: black; }", 2);
            $str .= space_br("a{ color: blueviolet; }", 2);
            $str .= space_br("a:hover{ color: blue; }", 2);
            break;
        case 2:
            $str .= space_br("body{ background-color: #fedcbb; color: #443322; }", 2);
            $str .= space_br("div.novel.controller{ background-color: #333333; color: silver; }", 2);
            $str .= space_br("div#nav{ background-color: #333333; color: silver; }", 2);
            $str .= space_br("a{ color: brown; }", 2);
            $str .= space_br("a:hover{ color: orangered; }", 2);
            break;
        case 3:
            $str .= space_br("body{ background-color: #cccccc; color: black; background-image : url(" . ($state->is_v ? "" : PNS_PATH) . "img/back_daytime.jpg); background-repeat: no-repeat; background-position: right center; background-attachment : fixed; background-size: 100% auto; }", 2);
//            $str .= space_br("div.container{ background-image : url(img/back_daytime.jpg); background-repeat: no-repeat; background-position: right center; background-attachment : fixed; background-size: 100% auto; }", 2);
            $str .= space_br("div.novel.controller{ background-color: silver; color: black; }", 2);
            $str .= space_br("div#nav{ background-color: silver; color: black; }", 2);
            $str .= space_br("a{ color: blueviolet; }", 2);
            $str .= space_br("a:hover{ color: blue; }", 2);
            break;
        case 4:
            $str .= space_br("body{ background-color: black; color: silver; background-image : url(" . ($state->is_v ? "" : PNS_PATH) . "img/back_night.jpg); background-repeat: no-repeat; background-position: right center; background-attachment : fixed; background-size: 100% auto; }", 2);
//            $str .= space_br("div.container{  }", 2);
            $str .= space_br("div.novel.controller{ background-color: #333333; color: silver; }", 2);
            $str .= space_br("div#nav{ background-color: #333333; color: silver; }", 2);
            $str .= space_br("a{ color: #cccc99; }", 2);
            $str .= space_br("a:hover{ color: gold; }", 2);
            break;
    }
    return $str;
}

function get_xy($x){
    if($x === 0){
        return space_br("img.cover{ width: auto; height: 100%; }", 2);
    }
}

function get_style($state) {
    $top = space_br("<style>", 0);
    $mincho = get_font_family($state->font_family);
    $size = get_font_size($state);
    $color = get_color($state);
    $xy = get_xy($state->x);
    $bottom = space_br("</style>", 1);
    return $top . $mincho . $size . $color . $xy . $bottom;
}

function get_parameter($state){
    $family = "&family=" . $state->font_family;
    $size = "&size=" . $state->font_size;
    $color = "&color=" . $state->color;
    $xy = "&x=" . $state->x;
    return $family . $size . $color . $xy;
}

function space_br($html, $num){
    $space = str_repeat("    ", $num);
    return $space . $html . "\n";
}

function delete_br($line){
    return str_replace(["\n", "\r", "\r\n"], "", $line);
}

function create_burger_img_into_div(){
    return space_br('<div id="burger"><img class="burger" src="img/burger.png"></div>', 2);
}

function create_cover_img($cover){
    if($cover !== null){
        return space_br("<img class='cover' src='" . $cover . "' />", 2);
    }
}

function get_page_file_name($x){
    return $x === 1 ? PNS_INDEX_FILE : "v.php";
}

function get_web_fonts_links(){
    return <<<EOT
<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kosugi&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@200&display=swap" rel="stylesheet">
EOT;
}

function get_js_links($state){
    $html = '<script type="text/javascript" src="' . ($state->is_v ? "" : PNS_PATH) . 'js/pns_js_init.js"></script>';
    $html .= '<script type="text/javascript" src="' . ($state->is_v ? "" : PNS_PATH) . 'js/burger.js"></script>';
    $html .= '<script type="text/javascript" src="' . ($state->is_v ? "" : PNS_PATH) . 'js/main.js"></script>';
    $html .= '<script type="text/javascript" src="' . ($state->is_v ? "" : PNS_PATH) . 'js/movePage.js"></script>';
    return $html;
}

// エスケープ
function h($s) {
    return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

