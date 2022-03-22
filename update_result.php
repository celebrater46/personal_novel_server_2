<?php

namespace personal_novel_server;

use personal_novel_server\classes\Separator;

require_once "init.php";
require_once "classes/Separator.php";

$path = isset($_POST["path"]) ? $_POST["path"] : null;
//$msg = "";
$list = get_list();
check_unified_text($list, $path);

function delete_text_once($file){
    if(file_exists($file)){
        $bool = unlink($file);
        echo $bool ? "Deleted: " . $file : "Not deleted: " . $file;
        echo "<br>";
    } else {
        echo "Not found: " . $file . "<br>";
    }
}

function delete_texts($path){
    $chapters = "novels/" . $path . "/chapters.txt";
    $list = "novels/" . $path . "/list.txt";
    delete_text_once($chapters);
    if(file_exists($list)){
        delete_text_once($list);
        foreach (glob("novels/" . $path . "/txts/*.txt") as $file) {
            delete_text_once($file);
        }
    }
}

function separate_once($path){
    $unified = "novels/" . $path . "/unified.txt";
    delete_texts($path);
    if(file_exists($unified)){
        $lines = file($unified);
        $novel = new Separator($path);
        $novel->separate_unified_text(1, $lines);
        echo "Separated: " . $unified . ".<br>";
    } else {
        echo "404 NOT FOUND: " . $unified . ".<br>";
    }
}

function check_unified_text($list, $path){
    if($path === null || $path === "all"){
        foreach ($list as $item){
            separate_once($item["path"]);
        }
    } else {
        separate_once($path);
    }
    echo "<br><a href='update.php'>戻る</a>";
}

function get_list (){
    $list = "novels/novels_list.txt";
    $separated = [];
    if(file_exists($list)){
        $temp_array = file($list);
        foreach ($temp_array as $line){
            $temp = explode("|", $line);
            $temp[1] = str_replace(["\r", "\n", "\r\n", " "], "", $temp[1]);
            array_push($separated, [
                "title" => $temp[0],
                "path" => $temp[1]
            ]);
        }
        echo "Got: " . $list;
        echo "<br>";
    } else {
        echo "Not found: " . $list;
    }
    return $separated;
}

