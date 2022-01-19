<?php

//function get_num_of_each_chapters($list){
//    $array = file($list); // ["1|001|第一話「訪問者」", "1|2|第二話「蹂躙」"... ]
//    $chapids = [];
//    foreach ($array as $item){
//        $chapid_ep = explode("|", $item);
//        array_push($chapids, $chapid_ep[0]); // [1, 1, 1, 2, 2, 2...]
//    }
//    $nums = array_count_values($chapids);
//    return $nums; // [[1] => 2, [2] => 1, [3] => 4... ]
//}

function get_file_names($path, $list) {
    // Before: ["1|001|第一話", "1|2|第二話", "2|03|第三話"...] == $list
    // After: ["novels/shiroganeki/001.txt", "novels/shiroganeki/2.txt"...]
    $array = [];
    foreach ($list as $item){
        $chapid_ep = explode("|", $item); // [1, "001", "第一話"]
        $file_name = $path . "/" . $chapid_ep[1];
        array_push($array, $file_name);
    }
    return $array;
}

//function get_episodes($list){
//    // Before: ["1|001|第一話", "1|2|第二話", "2|03|第三話"...] == $list
//    // After: ["第一話", "第二話", "第三話"...]
//    $array = [];
//    foreach ($list as $item){
//        $chapid_ep = explode("|", $item); // [1, "001", "第一話"]
//        array_push($array, $chapid_ep[2]);
//    }
//    return $array;
//}

function get_path_eps($path, $list){
    // Before: ["1|001|第一話", "1|2|第二話", "2|03|第三話"...] == $list
    // After: [["~/001.txt", "第一話"], ["~/2.txt", "第二話"], ["~/03.txt", "第三話"]...]
    $array = [];
    foreach ($list as $item){
        $chapid_ep = explode("|", $item); // [1, "001", "第一話"]
        $temp = [$path . "/" . $chapid_ep[1], $chapid_ep[2]];
        array_push($array, $temp);
    }
    return $array;
}

//function split_list_of_episodes($nums, $list){
//    // Before: ["第一話", "第二話", "第三話", "第四話"...] == $list
//    // After: [["第一話", "第二話"], ["第三話", "第四話"]...]
//    // $nums == [[1] => 2, [2] => 1, [3] => 4... ]
//    $array = [];
//    $ep_num = 0;
//    foreach($nums as $num){
//        $temp_array = [];
////        var_dump($num);
//        for($i = 0; $i < $num; $i++) {
//            array_push($temp_array, $list[$ep_num]);
//            $ep_num++;
//        }
//        array_push($array, $temp_array);
//    }
////    var_dump($array);
//    return $array;
//}

function split_eplist_each_chaps($nums, $list){
    // $nums == [[1] => 2, [2] => 1, [3] => 4... ]
    // Before: [[path1, ep1], [path2, ep2], [path3, ep3], [path4, ep4]...] == $list
    // After: [[[path1, ep1], [path2, ep2]], [[path3, ep3], [path4, ep4]]...]
    $array = [];
    $ep_num = 0;
    foreach($nums as $num){
        $temp_array = [];
        for($i = 0; $i < $num; $i++) {
            array_push($temp_array, $list[$ep_num]);
            $ep_num++;
        }
        array_push($array, $temp_array);
    }
    return $array;
}

//function get_array_ep_in_chap($chapters, $episodes){
//    // $chapters == ["第一章「日本編」", "第二章「北朝鮮編」"...]
//    // $episodes == [["第一話", "第二話"], ["第三話", "第四話"]...] // splitted
//    // return ["chapter" => "第一章「日本編", "episodes" => ["第一話", 第二話...]], [
//    $array = [];
//    $ep_num = 0;
//    foreach ($chapters as $chapter){
//        $temp_episodes = [];
//        foreach ($episodes[$ep_num] as $episode){
//            array_push($temp_episodes, $episode);
//        }
//        $temp = ["chapter" => $chapter, "episodes" => $temp_episodes];
//        array_push($array, $temp);
//        $ep_num++;
//    }
////    var_dump($array);
//    return $array;
//}

function get_array_pathep_in_chap($chapters, $path_eps){
    // $chapters == ["第一章「日本編」", "第二章「北朝鮮編」"...]
    // $path_eps == [[[path, ep], [path, ep]], [[path, ep], [path, ep]]...] // splitted
    // return ["chapter" => "第一章「日本編", "path_eps" => [[[path, ep], [path, ep]], [[path, ep], [path, ep]]...] ]
    $array = [];
    $ep_num = 0;
    foreach ($chapters as $chapter){
        $temp_path_eps = [];
        foreach ($path_eps[$ep_num] as $path_ep){
            array_push($temp_path_eps, $path_ep); // [path, ep]
        }
        $temp = ["chapter" => $chapter, "path_eps" => $temp_path_eps];
        array_push($array, $temp);
        $ep_num++;
    }
//    var_dump($array);
    return $array;
}

// $path == "novels/shoroganeki"
function get_chapters_and_episodes($path){
    // return // ["chapter" => "第一章「日本編", "episodes" => ["第一話", 第二話...]], [
    $chapters = file($path . "/chapters.txt"); // ["第一章「日本編」", "第二章「北朝鮮編」"...]
    $temp_episodes = file($path . "/list.txt"); // ["1|001|第一話", "1|2|第二話", "1|03|第三話", "2|4|第四話"...]
//    $episodes = get_episodes($temp_episodes); // ["第一話", "第二話", "第三話"...]
    $filenames_eps = get_path_eps($path, $temp_episodes); // [["~/001.txt","第一話"], ["~/2.txt", "第二話"]...]
    $nums = get_num_of_each_chapters($path . "/list.txt"); // [[1] => 2, [2] => 1, [3] => 4... ]
//    $splitted_ep = split_list_of_episodes($nums, $episodes); // [["第一話", "第二話"], ["第三話", "第四話"]...]
    $splitted_eplist = split_eplist_each_chaps($nums, $filenames_eps); // [[[path, ep], [path, ep]], [[path, ep], [path, ep]]...]
//    $array_pathep_in_chap = get_array_ep_in_chap($chapters, $splitted_eplist); // ["episode" => "第一章「日本編", "chapters" => ["第一話", 第二話...]], [
    $array_pathep_in_chap = get_array_pathep_in_chap($chapters, $splitted_eplist); // ["chapter" => "第一章「日本編", "path_eps" => [[[path, ep], [path, ep]], [[path, ep], [path, ep]]...] ]
    return $array_pathep_in_chap;
}

//function has_chapters($path){
//    // $path == "novels/shiroganeki"
//    if(file_exists($path . "/chapters.txt")){
//        return true;
//    } else {
//        return false;
//    }
//}