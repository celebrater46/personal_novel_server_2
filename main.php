<?php

ini_set('display_errors', 1); // エラーメッセージを常時表示する
define("INDEX_FILE", __DIR__ . '/index.php'); // 小説一覧ページを別途用意する場合は、ここを書き換え
define('NOVELS_DIR', __DIR__ . '/novels'); // 小説のディレクトリ（__DIR__ は現在のディレクトリ取得）
define('IMAGES_DIR_HTTP', 'img'); // HTTPでアクセスした際にディレクトリが変わるので用意

function get_font_family($num){
    if($num !== 0){
        return 'body{ font-family: "Sawarabi Mincho"; }' . "\n";
    } else {
        return 'body{ font-family: "Sawarabi Gothic"; }' . "\n";
    }
}

function get_font_size($num, $is_pc){
    // 1 = 0.2x, 2 = 0.4x, 3 = 0.6x, 4 = 0.8x, 5 = 1x, 6 = 1.5x, 7 = 2x , 8 = 4x, 9 = 10x
    $base = $is_pc ? 18 : 4; // px(PC), vw(Phone)
    $scale = $is_pc ? "px" : "vw";
    $font_size = calc_font_size($num, $base);
    $html = "div.containter, p.text.line{" . "\n" . "font-size: " . $font_size . $scale . "; }" . "\n";
    $html .= "h1{" . "\n" . "font-size: " . round($font_size * 1.5) . $scale . "; }" . "\n";
    $html .= "h2{" . "\n" . "font-size: " . round($font_size * 1.2) . $scale . "; }" . "\n";
    return $html;
}

function calc_font_size($size, $base){
    switch($size){
        case 1: return round($base * 0.2);
        case 2: return round($base * 0.4);
        case 3: return round($base * 0.6);
        case 4: return round($base * 0.8);
        case 5: return round($base * 1.0);
        case 6: return round($base * 1.5);
        case 7: return round($base * 2.0);
        case 8: return round($base * 3.0);
        case 9: return round($base * 5.0);
        default: return $base;
    }
}

function get_color($num){
    $str = "";
    switch ($num){
        // 0 == デフォルト値（暫定）
        case 1:
            $str .= "body{ background-color: white; color: black; }" . "\n";
            $str .= "div.novel.controller{ background-color: silver; color: black; }" . "\n";
            $str .= "div#nav{ background-color: silver; color: black; }" . "\n";
            $str .= "a{ color: blueviolet; }" . "\n";
            $str .= "a:hover{ color: blue; }" . "\n";
            break;
        case 2:
            $str .= "body{ background-color: #000001; color: silver; }" . "\n";
            $str .= "div.novel.controller{ background-color: #333333; color: silver; }" . "\n";
            $str .= "div#nav{ background-color: #333333; color: silver; }" . "\n";
            $str .= "a{ color: goldenrod; }" . "\n";
            $str .= "a:hover{ color: gold; }" . "\n";
            break;
        case 3:
            $str .= "body{ background-color: #fedcbb; color: #443322; }" . "\n";
            $str .= "div.novel.controller{ background-color: #333333; color: silver; }" . "\n";
            $str .= "div#nav{ background-color: #333333; color: silver; }" . "\n";
            $str .= "a{ color: brown; }" . "\n";
            $str .= "a:hover{ color: orangered; }" . "\n";
            break;
    }
    return $str;
}

function get_style($state) {
    $top = "<style>" . "\n";
    $mincho = get_font_family($state->font_family);
    $size = get_font_size($state->font_size, true);
    $color = get_color($state->color);
    $bottom = "</style>" . "\n";
    return $top . $mincho . $size . $color . $bottom;
}

function get_parameter($state){
    $family = "&family=" . $state->font_family;
    $size = "&size=" . $state->font_size;
    $color = "&color=" . $state->color;
    $xy = "&x=" . $state->x;
    return $family . $size . $color . $xy;
}

// エスケープ
function h($s) {
    return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}