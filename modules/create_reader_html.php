<?php

require_once "main.php";

function create_title_chap_ep($novel, $chap, $ep){
    if($novel->has_chapters){
        $start_ep_num = $novel->chapters[$chap]->start_ep_num;
        $html = space_br("<h2>" . $novel->chapters[$chap]->title . "</h2>", 2);
        $html .= space_br("<h3>" . $novel->chapters[$chap]->episodes[$ep - $start_ep_num]->title . "</h3>", 2);
        return $html;
    } else {
        return space_br("<h2>" . $novel->episodes[$ep - 1]->title . "</h2>", 2);
    }
}

function create_div_text($novel, $chap, $ep){
    $text = $novel->get_text($chap, $ep);
    $html = space_br("<div class='text'>", 2);
    foreach ($text as $line){
        $deleted = delete_br($line);
        $html .= space_br('<p class="text line">' . $deleted . '</p>', 3);
    }
    $html .= space_br("</div>", 2);
    return $html;
}

function get_new_chap($novel, $chap, $ep){
    if($novel->has_chapters){
        $start_ep_num = $novel->chapters[$chap]->start_ep_num;
        $next_start_ep_num = count($novel->chapters[$chap]->episodes) + $novel->chapters[$chap]->start_ep_num;
        if($ep < $start_ep_num){
            return $chap > 0 ? $chap - 1 : 0;
        } else if($ep >= $next_start_ep_num){
            return $chap + 1;
        } else {
            return $chap;
        }
    } else {
        return null;
    }
}

function create_link_new_ep($novel, $chap, $ep, $arrow, $state){
    $html = '<a href="' . INDEX_FILE;
    $html .= '?pns=2&novel=' . $novel;
    $html .= '&chap=' . $chap . '&ep=' . $ep;
    $html .= get_parameter($state) . '">' . $arrow . '</a>';
    return space_br($html, 4);
}

function get_link_new_ep($novel, $chap, $ep, $ep_sum, $state, $arrow){
    if(($state->x === 1 && $arrow === "＜＜")
    || ($state->x === 0 && $arrow === "＞＞"))
    {
        if($ep - 1 > 0){
            $chap_prev = get_new_chap($novel, $chap, $ep - 1);
            return create_link_new_ep($novel->id, $chap_prev, $ep - 1, $arrow, $state);
        } else {
            return "";
        }
    }
    else if(($state->x === 0 && $arrow === "＜＜")
    || ($state->x === 1 && $arrow === "＞＞"))
    {
        if($ep + 1 <= $ep_sum){
            $chap_next = get_new_chap($novel, $chap, $ep + 1);
            return create_link_new_ep($novel->id, $chap_next, $ep + 1, $arrow, $state);
        } else {
            return "";
        }
    }
}

function create_div_text_links($novel, $state){
    $chap = $state->chap_id;
    $ep = $state->ep_id;
    $ep_sum = $novel->get_max_ep();
    $html = space_br('<div class="text links">', 2);
    $html .= space_br('<div>', 3);
    $html .= get_link_new_ep($novel, $chap, $ep, $ep_sum, $state, "＜＜");
    $html .= space_br('</div>', 3);
    $html .= space_br('<div>', 3);
    $html .= space_br('<a href="' . INDEX_FILE . '?pns=1&novel=' . $novel->id . get_parameter($state) . '">一覧へ戻る</a>', 4);
    $html .= space_br('</div>', 3);
    $html .= space_br('<div>', 3);
    $html .= get_link_new_ep($novel, $chap, $ep, $ep_sum, $state, "＞＞");
    $html .= space_br('</div>', 3);
    $html .= space_br('</div>', 2);
    $html .= space_br('<div class="back">', 2);
    $html .= space_br('<a href="' . INDEX_FILE . "?pns=0" . get_parameter($state) . '">小説一覧へ戻る</a>', 3);
    $html .= space_br('</div>', 2);
    return $html;
}