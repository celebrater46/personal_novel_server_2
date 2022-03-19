<?php

// 外部サイト組込出力用

require_once "classes/Novel.php";
require_once "classes/State.php";
require_once "modules/main.php";
require_once "modules/create_ep_list.php";
require_once "modules/create_reader_html.php";

function get_html_ep_list(){
    $state = new State();
    $novel = get_novel_obj($state->novel_id);
    $html = create_html_ep_list($novel);
    return $html;
}

function get_html_reader(){
    $state = new State();
    $novel = get_novel_obj($state->novel_id);
    $html = space_br("<h1>" . $novel->title . "</h1>", 2);
    $html .= get_title_chap_ep($novel, $state->chap_id, $state->ep_id);
    $html .= get_div_text($novel, $state->chap_id, $state->ep_id);
    $html .= get_div_text_links($novel, $state->chap_id, $state->ep_id);
    return $html;
}

function get_novel_obj($id){
    $list = get_novel_list();
    $novel = new Novel($id, $list[$id]);
    $has_chapters = $novel->has_chapters();
    if($has_chapters){
        $novel->get_chapters();
    } else {
        $novel->get_episodes();
    }
    return $novel;
}

function get_novel_list(){
    $list = "novels/novels_list.txt";
    if(file_exists($list)){
        return file($list);
    } else {
        return ["Not found: " . $list];
    }
}
