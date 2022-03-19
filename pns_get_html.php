<?php

// 外部サイト組込出力用

require_once "classes/Novel.php";
require_once "classes/State.php";
require_once "modules/main.php";
require_once "modules/create_index_html.php";
require_once "modules/create_ep_list_html.php";
require_once "modules/create_reader_html.php";

function get_html_index(){
    $state = new State();
    $list = get_novel_list();
    $novels = get_novel_obj_all($list);
    return create_index_html($novels, $state);
}

function get_html_ep_list(){
    $state = new State();
    $list = get_novel_list();
    $novel = get_novel_obj_once($state->novel_id);
    return create_ep_list_html($novel);
}

function get_html_reader(){
    $state = new State();
    $list = get_novel_list();
    $novel = get_novel_obj_once($state->novel_id);
    $html = space_br("<h1>" . $novel->title . "</h1>", 2);
    $html .= create_title_chap_ep($novel, $state->chap_id, $state->ep_id);
    $html .= create_div_text($novel, $state->chap_id, $state->ep_id);
    $html .= create_div_text_links($novel, $state->chap_id, $state->ep_id);
    return $html;
}

function get_novel_obj($id, $line){
    $novel = new Novel($id, $line);
    $has_chapters = $novel->has_chapters();
    if($has_chapters){
        $novel->get_chapters();
    } else {
        $novel->get_episodes();
    }
    return $novel;
}

function get_novel_obj_once($id){
    $list = get_novel_list();
    return get_novel_obj($id, $list[$id]);
}

function get_novel_obj_all($list){
    $objs = [];
    $i = 0;
    foreach ($list as $line){
        array_push($objs, get_novel_obj($i, $line));
        $i++;
    }
    return $objs;
}

function get_novel_list(){
    $list = "novels/novels_list.txt";
    if(file_exists($list)){
        return file($list);
    } else {
        return ["Not found: " . $list];
    }
}
