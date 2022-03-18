<?php

require_once "classes/Novel.php";

function get_html_ep_list($id){
    $novel = get_novel_obj($id);
    $html = create_html_ep_list($novel);
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

function create_li_ep($novel_id, $episodes, $file){
    $html = "";
    foreach ($episodes as $episode){
        $html .= '                <li><a href="' . $file;
        $html .= "?novel=" . $novel_id;
        $html .= "&chap=0&ep=" . $episode->id . '">';
        $html .= $episode->title;
        $html .= "</a></li>";
        $html .= "\n";
    }
    return $html;
}

function create_html_ep($novel, $file){
    $html = "            <ul>";
    $html .= "\n";
    $html .= create_li_ep($novel->id, $novel->episodes, $file);
    $html .= "            </ul>";
    return $html;
}

function create_html_chap_ep($novel, $file){
    $html = "";
    foreach ($novel->chapters as $item){
        $html .= "            <hr>";
        $html .= "\n";
        $html .= "            <h2>" . $item->title ."</h2>";
        $html .= "\n";
        $html .= "            <div><ul>";
        $html .= "\n";
        $html .= create_li_ep($novel->id, $item->episodes, $file);
        $html .= "            </ul></div>";
        $html .= "\n";
    }
    return $html;
}

function create_html_ep_list($novel){
    $file = "reader.php";
    $html = "        <h1>" . $novel->title . "</h1>";
    $html .= "\n";
    $html .= '        <div class="caption">';
    $html .= "\n";
    foreach ($novel->caption as $line){
        $html .= "            <p>" . $line . "</p>";
        $html .= "\n";
    }
    $html .= "        </div>";
    $html .= "\n";
    $html .= '        <div class="episodes">';
    $html .= "\n";
    if($novel->has_chapters){
        $html .= create_html_chap_ep($novel, $file);
    } else {
        $html .= create_html_ep($novel, $file);
    }
    $html .= "        </div>";
    $html .= "\n";
    $html .= '        <div class="back">';
    $html .= "\n";
    $html .= '            <a href="' . INDEX_FILE . '">小説一覧へ戻る</a>';
    $html .= "\n";
    $html .= "        </div>";
    $html .= "\n";
    return $html;
}