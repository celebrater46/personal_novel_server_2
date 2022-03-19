<?php

require_once "main.php";

function create_caption_html($caption){
    $html = space_br("<div class='caption'>", 2);
    foreach ($caption as $line){
        $html .= space_br("<p>" . $line . "</p>", 3);
    }
    $html .= space_br("</div>", 2);
    return $html;
}

function create_index_html($novels, $state){
    $ep_list = "ep_list.php";
    $html = space_br('<h1><a href="/">Personal Novel Server</a></h1>', 2);
    foreach ($novels as $novel){
        $html .= space_br("<hr>", 2);
        $html .= space_br("<h2>", 2);
        $html .= space_br("<a href='" . $ep_list . "?novel=" . $novel->id . get_parameter($state) . "'>" . $novel->title . "</a>", 3);
        $html .= space_br("</h2>", 2);
        $html .= create_caption_html($novel->caption);
    }
    return $html;
}