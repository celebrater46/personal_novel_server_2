<?php

//require_once "Novel.php";
//$novel = new Novel("白金記|shiroganeki");
////$novel = new Novel("第三世界収容所|prison");
//
//$has_chapters = $novel->has_chapters();
//
//if($has_chapters){
//    $novel->get_chapters();
//} else {
//    $novel->get_episodes();
//}

$line = "だが――こんな姿形して、《《実は女性初の元陸上自衛隊第一空挺団隊員》》という経歴を持つ剛の者であり、三年前に《《父の浮気が発覚した時は半殺しどころか九割九分九厘殺しくらいにして病院送りにした》》前科がある。";

//$num = mb_substr_count($line, "《《"); // 処理回数算出
$str = str_replace("《《","《》《》",$line, $num); // $num == 2
$str2 = str_replace("》》","《》《》",$str);
$array = explode("《》《》", $str2);
for($i = 0; $i < $num; $i++){
    $array[$i * 2 + 1] = add_dot_ruby($array[$i * 2 + 1]);
}
$str3 = implode($array);
//var_dump($array);
var_dump($str3);

// このやり方だと一行につき1《《》》しか処理できない。
//$line = "だが――こんな姿形して、《《実は女性初の元陸上自衛隊第一空挺団隊員》》という経歴を持つ剛の者であり、三年前に父の浮気が発覚した時は半殺しどころか九割九分九厘殺しくらいにして病院送りにした前科がある。";
//$start = mb_strpos($line, "《《");
//$end = mb_strpos($line, "》》");
//$str = mb_substr($line, $start + 2, ($end - $start - 2));
////$arr = str_split($str);
////$array = split_stirng($str);
//$array2 = add_dot_ruby($str);
////$array2 = add_dot_ruby($line);
////var_dump($start);
////var_dump($end);
////var_dump($str);
////var_dump($array);
//var_dump($array2);


//function split_stirng($str) {
//    $length = mb_strlen($str);
//    $array = [];
//    for($i = 0; $i < $length; $i++){
//        $char = mb_substr($str, $i, 1);
//        array_push($array, $char);
//    }
//    return $array;
//}

//function add_dot_ruby($line) {
//    $start = mb_strpos($line, "《《");
//    $end = mb_strpos($line, "》》");
//    $str = mb_substr($line, $start + 2, ($end - $start - 2));
//    $length = mb_strlen($str);
//    $array = [];
//    for($i = 0; $i < $length; $i++){
//        $char = mb_substr($str, $i, 1);
//        array_push($array, $char);
//    }
//    $temp_str = "";
//    foreach ($array as $char){
//        $temp = "<ruby>" . $char . "<rp>（</rp><rt>・</rt><rp>）</rp></ruby>";
//        $temp_str .= $temp;
//    }
//    return $temp_str;
//}

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

//function add_dot_ruby($array){
//    $temp_array = [];
//    foreach ($array as $char){
//        $temp = "<ruby>" . $char . "<rp>（</rp><rt>・</rt><rp>）</rp></ruby>";
//        array_push($temp_array, $temp);
//    }
//    return $temp_array;
//}

//var_dump($has_chapters);
//var_dump($novel->chapters[2]->test_array);
//var_dump($novel->chapters);
//foreach ($novel->chapters[0]->episodes as $episode){
//    var_dump($episode);
//    echo "_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/\r\n \r \n" . PHP_EOL;
//}
//echo "_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/";
//var_dump($novel->chapters[2]->episodes);
//var_dump($novel->nums_eps_in_chap);
//var_dump($novel->nums_chap_start);
//var_dump($novel->test);
//var_dump($novel->episodes);