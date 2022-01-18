<?php

function get_num_of_each_episodes($list){
    $array = file($list); // ["1|第一話「訪問者」", "1|第二話「蹂躙」"... ]
    $epids = [];
    foreach ($array as $item){
        $epid_chap = explode("|", $item);
        array_push($epids, $epid_chap[0]); // [1, 1, 1, 2, 2, 2...]
    }
    $nums = array_count_values($epids);
    return $nums; // [[1] => 2, [2] => 1, [3] => 4... ]
}

function get_chapters($list){
    // Before: ["1|第一話", "1|第二話", "2|第三話"...] == $list
    // After: ["第一話", "第二話", "第三話"...]
    $array = [];
    foreach ($list as $item){
        $epid_chap = explode("|", $item); // [1, "第一話"]
        array_push($array, $epid_chap[1]);
    }
    return $array;
}

function split_list_of_chapters($nums, $list){
    // Before: ["第一話", "第二話", "第三話", "第四話"...] == $list
    // After: [["第一話", "第二話"], ["第三話", "第四話"]...]
    // $nums == [[1] => 2, [2] => 1, [3] => 4... ]
    $array = [];
    $chap_num = 0;
    foreach($nums as $num){
        $temp_array = [];
//        var_dump($num);
        for($i = 0; $i < $num; $i++) {
            array_push($temp_array, $list[$chap_num]);
            $chap_num++;
        }
        array_push($array, $temp_array);
    }
//    var_dump($array);
    return $array;
}

function get_array_chap_in_ep($episodes, $chapters){
    // $episodes == ["第一章「日本編」", "第二章「北朝鮮編」"...]
    // $chapters == [["第一話", "第二話"], ["第三話", "第四話"]...] // splitted
    // return ["episode" => "第一章「日本編", "chapters" => ["第一話", 第二話...]], [
    $array = [];
    $ep_num = 0;
    foreach ($episodes as $episode){
        $temp_chapters = [];
        foreach ($chapters[$ep_num] as $chapter){
            array_push($temp_chapters, $chapter);
        }
        $temp = ["episode" => $episode, "chapters" => $temp_chapters];
        array_push($array, $temp);
        $ep_num++;
    }
//    var_dump($array);
    return $array;
}

function get_episodes_and_chapters($path){
    // return // ["episode" => "第一章「日本編", "chapters" => ["第一話", 第二話...]], [
    $episodes = file($path . "/episodes.txt"); // ["第一章「日本編」", "第二章「北朝鮮編」"...]
    $temp_chapters = file($path . "/list.txt"); // ["1|第一話", "1|第二話", "1|第三話", "2|第四話"...]
    $chapters = get_chapters($temp_chapters); // ["第一話", "第二話", "第三話"...]
    $nums = get_num_of_each_episodes($path . "/list.txt"); // [[1] => 2, [2] => 1, [3] => 4... ]
    $splitted_chap = split_list_of_chapters($nums, $chapters); // [["第一話", "第二話"], ["第三話", "第四話"]...]
    $array_chap_in_ep = get_array_chap_in_ep($episodes, $splitted_chap); // ["episode" => "第一章「日本編", "chapters" => ["第一話", 第二話...]], [
    return $array_chap_in_ep;
}

function has_episodes($path){
    // $path == "shiroganeki"
    if(file_exists($path . "/episodes.txt")){
        return true;
    } else {
        return false;
    }
}