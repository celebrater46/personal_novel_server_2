<?php

// Test to create the array from List of TXT
$file_name = "list.txt";
$ret_array = file( $file_name );
$count = count($ret_array);
$nove_list = [];

/*
$nove_list の内部構造
    [
        ["第三世界収容所", "prison"],
        ["白金記", "shiroganeki"],
        ["極楽戦争", "gokuraku"]
    ]

$list_object = [
    ["ep_id" => 1, "chapter" => "第一話「訪問者」"],
    ["ep_id" => 1, "chapter" => "第二話「蹂躙」"],
    ["ep_id" => 1, "chapter" => "第三話「尋問」"],
    ["ep_id" => 2, "chapter" => "第四話「写真」"],
    ["ep_id" => 2, "chapter" => "第五話「宣告」"],
    ["ep_id" => 2, "chapter" => "第六話「勧誘」"],
    ["ep_id" => 3, "chapter" => "第七話「逃避」"],
    ["ep_id" => 3, "chapter" => "第八話「飛翔」"],
    ["ep_id" => 3, "chapter" => "第九話「太陽」"],
];

$data = [
    [
        ["ep_id" => 1, "chapter" => "第一話「訪問者」"],
        ["ep_id" => 1, "chapter" => "第二話「蹂躙」"],
        ["ep_id" => 2, "chapter" => "第三話「尋問」"],
    ],
    [
        ["ep_id" => 1, "chapter" => "第一話"],
        ["ep_id" => 1, "chapter" => "第二話"],
        ["ep_id" => 2, "chapter" => "第三話"],
    ],
];

$big_data =
    [
        "novel" => "白金記", "episodes" =>
            [
                "ep_title" => "第一章「日本編」, "chapters" =>
                    [
                        "第一話「訪問者」",
                        "第二話「蹂躙」",
                        "第三話「尋問"
                    ]
            ],
            [
                "ep_title" => "第二章「北朝鮮編」, "chapters" =>
                    [
                        "第四話「写真」",
                        "第五話「警告」",
                        "第六話「勧誘」"
                    ]
            ],
    ],
    [
        "novel" => "極楽戦争", "episodes" =>
            [
                "ep_title" => "序章「天上天下」, "chapters" =>
                    [
                        "第一話",
                        "第二話",
                        "第三話"
                    ]
            ]
    ],
];
*/

for ($i = 0; $i < $count; $i++){
    $nove_list[$i] = explode("|", $ret_array[$i]);
}

// $list == $nove_list
//function get_list_and_episodes($list){
//    foreach ($list as $item){
//        $array = [];
////        if (file_exists($list[1] . "episodes.txt")) {
////            $episodes = file($list[1] . "episodes.txt");
////            for ($i = 0; $i < count($episodes); $i++){
////                $array[$i] = ["ep_id" => $episodes[i], ]
////            }
////        } else {
////            echo "$filename は存在しません";
////        }
////        $data =
//        if(file_exists($item[1] . "/list.txt")){
//            $list_array = file($item[1] . "/list.txt");
//            $list_object = [];
//            foreach ($list_array as $item2) {
//                $epid_sub = explode("|", $item2); // [1, "第一話「訪問者」"]
//                array_push($list_object, ["ep_id" => $epid_sub[0], "chapter" => $epid_sub[1]]); // ["ep_id" => 1, "chapter" => "第一話「訪問者」"]
//            }
//            array_push($array, $list_object);
//        } else {
//            array_push($array, ["ep_id" => 1, "chapter" => 'list.txt が存在しないか、壊れています。Could not load "list.txt"']);
//        }
//    }
//    return $array;
//}

function get_list($list){
    $epid_sub = [];
    foreach ($list as $item2) {
        $epid_sub = explode("|", $item2); // [1, "第一話「訪問者」"]
        array_push($array, $epid_sub[1]); // ["ep_id" => 1, "chapter" => "第一話「訪問者」"]
    }
    /*
    $epid_sub =
        [
            [1, "第一話"],
            [1, "第二話"],
            [2, "第三話"]
        ]
    */
}

function create_ep_list($episodes){
    $list = file($episodes); // ["1|第一話", "2|第二話"]
    $array = [];
    foreach ($list as $item) {
        $id_ep = explode("|", $item); // [1, "第一話"]
//        $id_ep2 = ["id" => $id_ep[0], "chapter" => $id_ep[1]];
        array_push($array, $id_ep);
    }
    return $array; // [[1, "第一話"], [2, "第二話"]]
}

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

function get_part_of_chapters($ep, $list){
    $array = file($list); // ["1|第一話", "2|第二話"]
    $chapters = [];
    foreach ($array as $item){
        $epid_chap = explode("|", $item); // [1, "第一話"]
        if($ep == $epid_chap[0]){
            array_push($chapters, $epid_chap[1]);
        }
    }
    return $chapters; // ["第一話", "第二話"...]
}

function get_episodes($list, $episodes){
    $ep_list = create_ep_list($episodes); // [[1, "第一話"], [2, "第二話"]]
    $array = [];
    for($i = 1; $i <= count($ep_list); $i++){
        foreach ($list as $item2) {
            $epid_sub = explode("|", $item2); // [1, "第一話「訪問者」"]
            array_push($array, $epid_sub[1]); // ["ep_id" => 1, "chapter" => "第一話「訪問者」"]
        }
    }
}

function test_get_part_of_chapters(){
    $array = get_part_of_chapters(2, "shiroganeki/list.txt");
    return $array;
}
$test_chapters = test_get_part_of_chapters();

function get_list_and_episodes($list){
    foreach ($list as $item){
        $array = [];
        if(file_exists($item[1] . "/list.txt")){
            $list_array = file($item[1] . "/list.txt");
            $list_object = [];
            foreach ($list_array as $item2) {
                $epid_sub = explode("|", $item2); // [1, "第一話「訪問者」"]
                array_push($list_object, ["ep_id" => $epid_sub[0], "chapter" => $epid_sub[1]]); // ["ep_id" => 1, "chapter" => "第一話「訪問者」"]
            }
            array_push($array, $list_object);
        } else {
            array_push($array, ["ep_id" => 1, "chapter" => 'list.txt が存在しないか、壊れています。Could not load "list.txt"']);
        }
    }
    return $array;
}

$data = get_list_and_episodes($nove_list);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="Author" content="Enin Fujimi">
    <title>Test TXT To Array</title>
</head>
<body>
<h1>
    <a href="/">
        Test TXT To Array
    </a>
</h1>
<?php foreach ($test_chapters as $item) : ?>
    <?php echo $item . "<br>" ?>
<?php endforeach; ?>


</body>
</html>