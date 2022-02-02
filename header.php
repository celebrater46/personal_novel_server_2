<?php

function get_header(){
    $font_family = '<div class="font family label"><label for="font_family">文字の種類：</label></div>';
    $font_family .= '<div class="font family select"><select id="font_family">\n<option selected>ゴシック</option>\n<option>明朝</option>\n</select></div>';
    $font_size = '<div class="font size label"><label for="font_size">文字の大きさ：</label></div>';
    $font_size .= '<div class="font size select"><select id="font_size">\n<option>小</option>\n<option selected>中</option>\n<option>大</option>\n</select></div>';
    $color = '<div class="color label"><label for="color">背景色：</label></div>';
    $color .= '<div class="color select"><select id="color">\n<option>白</option>\n<option selected>黒</option>\n<option>ベージュ</option>\n</select></div>';
    $xy = '<div class="xy label"><label for="xy">組み方向：</label></div>';
    $xy .= '<div class="xy select"><select id="xy">\n<option selected>横書き</option>\n<option>縦書き</option>\n</select></div>';
    return "<header class='novel controller'><div>" . $font_family . $font_size . $color . $xy . "</div></header>";
}