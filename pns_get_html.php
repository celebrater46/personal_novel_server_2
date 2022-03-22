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

function add_pns_container($html, $state){
    $div = modules\space_br("<div id='pns_container' class='pns_container'>", 2);
    $div .= $html;
    $div .= $state->is_v ? add_back_hone() : "";
    $div .= modules\space_br("</div>", 2);
    return $div;
}

function add_back_hone(){
    return modules\space_br('<div class="backHome"><a href="' . PNS_INDEX_FILE . '">トップへ戻る</a></div>', 2);
}

function get_html_index($state){
    $list = get_novel_list($state);
    $novels = get_novel_obj_all($list, $state);
    $html = modules\create_index_html($novels, $state);
    return add_pns_container($html, $state);
}

function get_html_ep_list($state){
    $novel = get_novel_obj_once($state);
    $html = modules\create_ep_list_html($novel, $state);
    return add_pns_container($html, $state);
}

function get_html_reader($state){
    $novel = get_novel_obj_once($state);
    $html = modules\create_html_reader($novel, $state);
    return add_pns_container($html, $state);
}

function get_novel_obj($id, $line, $state){
    $novel = new Novel($id, $line, $state);
    $has_chapters = $novel->has_chapters();
    if($has_chapters){
        $novel->get_chapters();
    } else {
        $novel->get_episodes();
    }
    return $novel;
}

function get_novel_obj_once($state){
    $list = get_novel_list($state);
    return get_novel_obj($state->novel_id, $list[$state->novel_id], $state);
}

function get_novel_obj_all($list, $state){
    $objs = [];
    $i = 0;
    foreach ($list as $line){
        array_push($objs, get_novel_obj($i, $line, $state));
        $i++;
    }
    return $objs;
}

function get_novel_list($state){
    $list = ($state->is_v ? "" : PNS_PATH) . "novels/novels_list.txt";
    if(file_exists($list)){
        return file($list);
    } else {
        return ["Not found: " . $list];
    }
}

