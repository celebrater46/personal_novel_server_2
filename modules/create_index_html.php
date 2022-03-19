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

function create_cover_img($cover){
    if($cover !== null){
        return space_br("<img class='cover' src='" . $cover . "' />", 2);
    }
}

function create_index_html($novels, $state){
    $html = "";
    foreach ($novels as $novel){
        $html .= $novel->id === 0 ? "" : space_br("<hr>", 2);
        if($state->x === 1){
            $html .= create_cover_img($novel->cover);
        }
        $html .= space_br("<h2>", 2);
        $html .= space_br("<a href='" . INDEX_FILE . "?pns=1&novel=" . $novel->id . get_parameter($state) . "'>" . $novel->title . "</a>", 3);
        $html .= space_br("</h2>", 2);
        if($state->x === 0){
            $html .= create_cover_img($novel->cover);
        }
        $html .= create_caption_html($novel->caption);
    }
    return add_iframe($state->x, $html);
}