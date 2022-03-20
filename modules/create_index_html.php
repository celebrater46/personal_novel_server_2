<?php

require_once "main.php";

function create_links_to_posting_sites($novel, $state){
    if($novel->links !== null){
        $html = space_br("<ul class='read'>", 2);
        $html .= space_br("<li><a href='" . get_page_file_name($state->x) . "?pns=1&novel=" . $novel->id . get_parameter($state) . "'>当サイトで読む</a></li>", 3);
        foreach ($novel->links as $link){
            $html .= space_br("<li><a target='_blank' href='" . $link["url"] . "'>" . $link["site_name"] . "で読む</a></li>", 3);
        }
        $html .= space_br("</ul>", 2);
        return $html;
    } else {
        return "";
    }
}

function create_caption_html($caption){
    $html = space_br("<div class='caption'>", 2);
    foreach ($caption as $line){
        $html .= space_br("<p>" . $line . "</p>", 3);
    }
    $html .= space_br("</div>", 2);
    return $html;
}

function create_index_html($novels, $state){
    $html = $state->x === 0 ? create_burger_img_into_div() : "";
    foreach ($novels as $novel){
        $html .= $novel->id === 0 ? "" : space_br("<hr>", 2);
        if($state->x === 1){
            $html .= create_cover_img($novel->cover);
        }
        $html .= space_br("<h2>", 2);
        $html .= space_br("<a href='" . get_page_file_name($state->x) . "?pns=1&novel=" . $novel->id . get_parameter($state) . "'>" . $novel->title . "</a>", 3);
        $html .= space_br("</h2>", 2);
        if($state->x === 0){
            $html .= create_cover_img($novel->cover);
        }
        $html .= create_caption_html($novel->caption);
        $html .= create_links_to_posting_sites($novel, $state);
    }
    return $html;
}