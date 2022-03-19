<?php

function create_li_ep($novel_id, $chapter, $state){
    $array = [];
    foreach ($chapter->episodes as $episode){
        $html = '<li><a href="' . INDEX_FILE;
        $html .= "?pns=2&novel=" . $novel_id;
        $html .= "&chap=" . $chapter->id . "&ep=" . ($episode->id + 1);
        $html .= get_parameter($state) . '">';
        $html .= $episode->title;
        $html .= '</a></li>';
        array_push($array, space_br($html, 4));
    }
    return implode("", $array);
}

function create_li_ep_no_chapter($novel_id, $episodes, $state){
    $array = [];
    foreach ($episodes as $episode){
        $html = '<li><a href="' . INDEX_FILE;
        $html .= "?pns=2&novel=" . $novel_id;
        $html .= "&chap=0&ep=" . ($episode->id + 1);
        $html .= get_parameter($state) . '">';
        $html .= $episode->title;
        $html .= '</a></li>';
        array_push($array, space_br($html, 4));
    }
    return implode("", $array);
}

function create_html_ep($novel, $state){
    $html = space_br("<ul>", 3);
    $html .= create_li_ep_no_chapter($novel->id, $novel->episodes, $state);
    $html .= space_br("</ul>", 3);
    return $html;
}

function create_html_chap_ep($novel, $state){
    $html = space_br("<hr>", 3);
    foreach ($novel->chapters as $chapter){
        $html .= space_br("<h2>" . $chapter->title . "</h2>", 3);
        $html .= space_br("<div><ul>", 3);
        $html .= create_li_ep($novel->id, $chapter, $state);
        $html .= space_br("</ul></div>", 3);
    }
    return $html;
}

function create_ep_list_html($novel, $state){
    $html = "";
    if($state->x === 1){
        $html .= create_cover_img($novel->cover);
    }
    $html .= space_br("<h1>" . $novel->title . "</h1>", 0);
    if($state->x === 0){
        $html .= create_cover_img($novel->cover);
    }
    $html .= space_br('<div class="caption">', 2);
    foreach ($novel->caption as $line){
        $html .= space_br("<p>" . $line . "</p>", 3);
    }
    $html .= space_br("</div>", 2);
    $html .= space_br('<div class="episodes">', 2);
    if($novel->has_chapters){
        $html .= create_html_chap_ep($novel, $state);
    } else {
        $html .= create_html_ep($novel, $state);
    }
    $html .= space_br("</div>", 2);
    $html = add_iframe($state->x, $html);
    $html .= space_br('<div class="back">', 2);
    $html .= space_br('<a href="' . INDEX_FILE . "?pns=0" . get_parameter($state) . '">小説一覧へ戻る</a>', 3);
    $html .= space_br("</div>", 2);
    return $html;
}