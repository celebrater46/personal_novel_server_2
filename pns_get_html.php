<?php

// 外部サイト組込出力用
namespace personal_novel_server;

use personal_novel_server\classes\State;
use personal_novel_server\classes\Novel;
use personal_novel_server\modules as modules;

require_once "classes/Novel.php";
require_once "classes/State.php";
require_once "modules/main.php";
require_once "modules/create_index_html.php";
require_once "modules/create_ep_list_html.php";
require_once "modules/create_reader_html.php";

function pns_get_html(){
    $state = new State();
    switch ($state->pns){
        case 0: return get_html_index($state);
        case 1: return get_html_ep_list($state);
        case 2: return get_html_reader($state);
        default: return get_html_index($state);
    }
}

function add_iframe($x, $html){
    if($x === 0){
        $div = modules\space_br("<div class='iframe'>", 1);
        $div .= $html;
        $div .= modules\space_br("</div>", 1);
        return $div;
    } else {
        return $html;
    }
}

function get_html_index($state){
    $list = get_novel_list();
    $novels = get_novel_obj_all($list);
    return modules\create_index_html($novels, $state);
}

function get_html_ep_list($state){
    $novel = get_novel_obj_once($state->novel_id);
    return modules\create_ep_list_html($novel, $state);
}

function get_html_reader($state){
    $novel = get_novel_obj_once($state->novel_id);
    return modules\create_html_reader($novel, $state);
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

