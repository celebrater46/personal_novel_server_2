<?php

function create_li_ep($novel_id, $chapter, $file){
    $array = [];
    foreach ($chapter->episodes as $episode){
        $html = '<li><a href="' . $file;
        $html .= "?novel=" . $novel_id;
        $html .= "&chap=" . $chapter->id . "&ep=" . ($episode->id + 1) . '">';
        $html .= $episode->title;
        $html .= '</a></li>';
        array_push($array, space_br($html, 4));
    }
    return implode("", $array);
}

function create_html_ep($novel, $file){
    $html = space_br("<ul>", 3);
    $html .= create_li_ep($novel->id, $novel->episodes, $file);
    $html .= space_br("</ul>", 3);
    return $html;
}

function create_html_chap_ep($novel, $file){
    $html = space_br("<hr>", 3);
    foreach ($novel->chapters as $chapter){
        $html .= space_br("<h2>" . $chapter->title . "</h2>", 3);
        $html .= space_br("<div><ul>", 3);
        $html .= create_li_ep($novel->id, $chapter, $file);
        $html .= space_br("</ul></div>", 3);
    }
    return $html;
}

function create_html_ep_list($novel){
    $file = "reader.php";
    $html = space_br("<h1>" . $novel->title . "</h1>", 0);
    $html .= space_br('<div class="caption">', 2);
    foreach ($novel->caption as $line){
        $html .= space_br("<p>" . $line . "</p>", 3);
    }
    $html .= space_br("</div>", 2);
    $html .= space_br('<div class="episodes">', 2);
    if($novel->has_chapters){
        $html .= create_html_chap_ep($novel, $file);
    } else {
        $html .= create_html_ep($novel, $file);
    }
    $html .= space_br("</div>", 2);
    $html .= space_br('<div class="back">', 2);
    $html .= space_br('<a href="' . INDEX_FILE . '">小説一覧へ戻る</a>', 3);
    $html .= space_br("</div>", 2);
    return $html;
}