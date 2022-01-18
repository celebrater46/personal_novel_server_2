<?php

function get_title_and_path(){
    $novels_array = file("novels/novels_list.txt"); // ["第三世界収容所|prison", "白金記|shiroganeki, "極楽戦争|gokuraku"...]
    $temp_list = [];
    foreach ($novels_array as $item) {
        $temp = explode("|", $item);
        $temp[1] = str_replace([" ", "　", "\n", "\r", "\r\n"], "", $temp[1]); // 悪魔のバグ要因、全角＆半角スペース、改行コードの排除
        array_push($temp_list, $temp);
    }
    return $temp_list; // [["第三世界収容所", "prison"], ["白金記", "shiroganeki"]... ]
}

function get_captions($list){
    // $list == [["第三世界収容所", "prison"], ["白金記", "shiroganeki"]... ]
    $captions = [];
    foreach ($list as $item){
//        $path = str_replace([" ", "　", "\n", "\r", "\r\n"], "", $item[1]); // 悪魔のバグ要因、全角＆半角スペース、改行コードの排除
        if(file_exists("novels/" . $item[1] . "/caption.txt")){
            $caption = file("novels/" . $item[1] . "/caption.txt");
            array_push($captions, $caption);
        } else {
            $error = ["キャプションファイル（caption.txt）が見つからないか、読み込めません。caption.txt does not exist or unavailable."];
            array_push($captions, $error);
        }
    }
    return $captions;
}