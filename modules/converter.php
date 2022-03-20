<?php

namespace personal_novel_server\modules;

function convert_to_ruby($array){
    $temp_array = [];
    foreach ($array as $line){
        // <ruby>堕天男><rp>（</rp><rt>ルシファー</rt><rp>）</rp></ruby>
        $temp = $line;
        if($temp === "" || $temp === "\n" || $temp === "\r" || $temp === "\r\n") {
            $temp = "　";
        }
        $temp = str_replace(["|", "｜"], "<ruby>", $temp);
        $temp = str_replace("《", "<rp>（</rp><rt>", $temp);
        $temp = str_replace("》", "</rt><rp>）</rp></ruby>", $temp);
        array_push($temp_array, $temp);
    }
    return $temp_array;
}

function convert_to_dot($array){
    $temp_array = [];
    foreach($array as $line){
        $start = mb_strpos($line, "《《");
        $end = mb_strpos($line, "》》");
        if($start !== false && $end !== false){
            $str = str_replace("《《","《》《》",$line, $num); // $num == 2
            $str2 = str_replace("》》","《》《》",$str);
            $temp_array2 = explode("《》《》", $str2);
            for($i = 0; $i < $num; $i++){
                $temp_array2[$i * 2 + 1] = add_dot_ruby($temp_array2[$i * 2 + 1]);
            }
            $str3 = implode($temp_array2);
            array_push($temp_array, $str3);
        } else {
            array_push($temp_array, $line);
        }
    }
    return $temp_array;
}

function add_dot_ruby($str) {
    $length = mb_strlen($str);
    $array = [];
    for($i = 0; $i < $length; $i++){
        $char = mb_substr($str, $i, 1);
        array_push($array, $char);
    }
    $temp_str = "";
    foreach ($array as $char){
        $temp = "<ruby>" . $char . "<rp>（</rp><rt>・</rt><rp>）</rp></ruby>";
        $temp_str .= $temp;
    }
    return $temp_str;
}

