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
    $html = "";
    foreach ($novels as $novel){
        $html .= space_br("<hr>", 2);
        $html .= space_br("<h2>", 2);
        $html .= space_br("<a href='" . INDEX_FILE . "?pns=1&novel=" . $novel->id . get_parameter($state) . "'>" . $novel->title . "</a>", 3);
        $html .= space_br("</h2>", 2);
        $html .= create_caption_html($novel->caption);
    }
    return $html;
}