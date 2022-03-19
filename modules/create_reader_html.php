<?php

require_once "main.php";

function get_title_chap_ep($novel, $chap, $ep){
    if($novel->has_chapters){
        $start_ep_num = $novel->chapters[$chap]->start_ep_num;
        $html = space_br("<h2>" . $novel->chapters[$chap]->title . "</h2>", 2);
        $html .= space_br("<h3>" . $novel->chapters[$chap]->episodes[$ep - $start_ep_num]->title . "</h3>", 2);
        return $html;
    } else {
        return space_br("<h2>" . $novel->episodes[$ep]->title . "</h2>", 2);
    }
}

function get_div_text($novel, $chap, $ep){
    $text = $novel->get_text($chap, $ep);
    $html = space_br("<div class='text'>", 2);
    foreach ($text as $line){
        $deleted = delete_br($line);
        $html .= space_br('<p class="text line">' . $deleted . '</p>', 3);
    }
    $html .= space_br("</div>", 2);
    return $html;
}

function get_div_text_links($novel, $chap, $ep){
    $file = "reader.php";
    $list_php = "ep_list.php";
    $ep_sum = $novel->get_max_ep();
    $html = space_br('<div class="text links">', 2);
    $html .= space_br('<div>', 3);
    if($ep - 1 > 0) {
        $html .= space_br('<a href="' . $file . '?novel=' . $novel->id . '&chap=' . $chap . '&ep=' . ($ep - 1) . '">＜＜</a>', 4);
    }
    $html .= space_br('</div>', 3);
    $html .= space_br('<div>', 3);
    $html .= space_br('<a href="' . $list_php . '?novel=' . $novel->id . '">一覧へ戻る</a>', 4);
    $html .= space_br('</div>', 3);
    $html .= space_br('<div>', 3);
//    $html .= space_br('<div>', 2);
    if($ep + 1 < $ep_sum){
        $html .= space_br('<a href="' . $file . '?novel=' . $novel->id . '&chap=' . $chap . '&ep=' . ($ep + 1) . '">＞＞</a>', 4);
    }
    $html .= space_br('</div>', 3);
    $html .= space_br('</div>', 2);
    $html .= space_br('<div class="back">', 2);
    $html .= space_br('<a href="' . INDEX_FILE . '">小説一覧へ戻る</a>', 3);
    $html .= space_br('</div>', 2);
    return $html;
}