<?php

function get_num_of_each_chapters($list){
    $array = file($list); // ["1|第一話「訪問者」", "1|第二話「蹂躙」"... ]
    $chapids = [];
    foreach ($array as $item){
        $chapid_ep = explode("|", $item);
        array_push($chapids, $chapid_ep[0]); // [1, 1, 1, 2, 2, 2...]
    }
    $nums = array_count_values($chapids);
    return $nums; // [[1] => 2, [2] => 1, [3] => 4... ]
}

function get_episodes($list){
    // Before: ["1|第一話", "1|第二話", "2|第三話"...] == $list
    // After: ["第一話", "第二話", "第三話"...]
    $array = [];
    foreach ($list as $item){
        $chapid_ep = explode("|", $item); // [1, "第一話"]
        array_push($array, $chapid_ep[1]);
    }
    return $array;
}

function split_list_of_episodes($nums, $list){
    // Before: ["第一話", "第二話", "第三話", "第四話"...] == $list
    // After: [["第一話", "第二話"], ["第三話", "第四話"]...]
    // $nums == [[1] => 2, [2] => 1, [3] => 4... ]
    $array = [];
    $ep_num = 0;
    foreach($nums as $num){
        $temp_array = [];
//        var_dump($num);
        for($i = 0; $i < $num; $i++) {
            array_push($temp_array, $list[$ep_num]);
            $ep_num++;
        }
        array_push($array, $temp_array);
    }
//    var_dump($array);
    return $array;
}

function get_array_ep_in_chap($chapters, $episodes){
    // $chapters == ["第一章「日本編」", "第二章「北朝鮮編」"...]
    // $episodes == [["第一話", "第二話"], ["第三話", "第四話"]...] // splitted
    // return ["chapter" => "第一章「日本編", "episodes" => ["第一話", 第二話...]], [
    $array = [];
    $ep_num = 0;
    foreach ($chapters as $chapter){
        $temp_episodes = [];
        foreach ($episodes[$ep_num] as $episode){
            array_push($temp_episodes, $episode);
        }
        $temp = ["chapter" => $chapter, "episodes" => $temp_episodes];
        array_push($array, $temp);
        $ep_num++;
    }
//    var_dump($array);
    return $array;
}

function get_chapters_and_episodes($path){
    // return // ["chapter" => "第一章「日本編", "episodes" => ["第一話", 第二話...]], [
    $chapters = file($path . "/chapters.txt"); // ["第一章「日本編」", "第二章「北朝鮮編」"...]
    $temp_episodes = file($path . "/list.txt"); // ["1|第一話", "1|第二話", "1|第三話", "2|第四話"...]
    $episodes = get_episodes($temp_episodes); // ["第一話", "第二話", "第三話"...]
    $nums = get_num_of_each_chapters($path . "/list.txt"); // [[1] => 2, [2] => 1, [3] => 4... ]
    $splitted_ep = split_list_of_episodes($nums, $episodes); // [["第一話", "第二話"], ["第三話", "第四話"]...]
    $array_ep_in_chap = get_array_ep_in_chap($chapters, $splitted_ep); // ["episode" => "第一章「日本編", "chapters" => ["第一話", 第二話...]], [
    return $array_ep_in_chap;
}

function has_chapters($path){
    // $path == "shiroganeki"
    if(file_exists($path . "/chapters.txt")){
        return true;
    } else {
        return false;
    }
}