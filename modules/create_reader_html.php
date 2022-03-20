<?php

namespace personal_novel_server\modules;

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

function get_text_line($line){
    return space_br('<p class="text line">' . $line . '</p>', 3);
}

function create_div_text($novel, $chap, $ep){
    $text = $novel->get_text($chap, $ep);
    $html = space_br("<div class='text'>", 2);
    $deleted_first_blank = false;
    foreach ($text as $line){
        $deleted = delete_br($line);
        if($deleted !== "" && $deleted !== "　"
            && preg_match("/<Title>/i", $line) === 0
            && preg_match("/<Chapter>/i", $line) === 0
            && preg_match("/<Sub>/i", $line) === 0)
        {
            $deleted_first_blank = true;
            $html .= get_text_line($deleted);
        } else {
            if($deleted_first_blank){
                $html .= get_text_line($deleted);
            }
        }

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
    $html = '<a href="' . get_page_file_name($state->x);
    $html .= '?pns=2&novel=' . $novel;
    $html .= '&chap=' . $chap . '&ep=' . $ep;
    $html .= get_parameter($state) . '">' . $arrow . '</a>';
    return space_br($html, 4);
}

function get_link_new_ep($novel, $chap, $ep, $ep_sum, $state, $arrow){
    if($arrow === "＜＜" || $arrow === "前の話へ")
    {
        if($ep - 1 > 0){
            $chap_prev = get_new_chap($novel, $chap, $ep - 1);
            return create_link_new_ep($novel->id, $chap_prev, $ep - 1, $arrow, $state);
        } else {
            return "";
        }
    }
    else if($arrow === "＞＞" || $arrow === "次の話へ")
    {
        if($ep + 1 <= $ep_sum){
            $chap_next = get_new_chap($novel, $chap, $ep + 1);
            return create_link_new_ep($novel->id, $chap_next, $ep + 1, $arrow, $state);
        } else {
            return "";
        }
    }
    else
    {
        return "";
    }
}

function create_div_text_links($novel, $state){
    $chap = $state->chap_id;
    $ep = $state->ep_id;
    $ep_sum = $novel->get_max_ep();
    $html = space_br('<div class="text links">', 2);
    if($state->x === 1){
        $html .= space_br('<div>', 3);
        $html .= get_link_new_ep($novel, $chap, $ep, $ep_sum, $state, "＜＜");
        $html .= space_br('</div>', 3);
    } else {
        $html .= space_br('<div>', 3);
        $html .= get_link_new_ep($novel, $chap, $ep, $ep_sum, $state, "前の話へ");
        $html .= space_br('</div>', 3);
        $html .= space_br('<div>', 3);
        $html .= get_link_new_ep($novel, $chap, $ep, $ep_sum, $state, "次の話へ");
        $html .= space_br('</div>', 3);
    }
    $html .= space_br('<div>', 3);
    $html .= space_br('<a href="' . get_page_file_name($state->x) . '?pns=1&novel=' . $novel->id . get_parameter($state) . '">目次へ戻る</a>', 4);
    $html .= space_br('</div>', 3);
    if($state->x === 1){
        $html .= space_br('<div>', 3);
        $html .= get_link_new_ep($novel, $chap, $ep, $ep_sum, $state, "＞＞");
        $html .= space_br('</div>', 3);
    }
    $html .= space_br('</div>', 2);
    $html .= space_br('<div class="back">', 2);
    $html .= space_br('<a href="' . get_page_file_name($state->x) . "?pns=0" . get_parameter($state) . '">小説一覧へ戻る</a>', 3);
    $html .= space_br('</div>', 2);
    return $html;
}

function create_html_reader($novel, $state){
    $html = get_header($state);
    $html .= space_br("<h1>" . $novel->title . "</h1>", 2);
    $html .= create_title_chap_ep($novel, $state->chap_id, $state->ep_id);
    $html .= create_div_text($novel, $state->chap_id, $state->ep_id);
    $html .= create_div_text_links($novel, $state);
    return $html;
}

