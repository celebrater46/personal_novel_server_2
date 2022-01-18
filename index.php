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
        "novel" => "白金記", "list" => [
            ["ep_id" => 1, "chapter" => "第一話「訪問者」"],
            ["ep_id" => 1, "chapter" => "第二話「蹂躙」"],
            ["ep_id" => 2, "chapter" => "第三話「尋問」"],
        ]
    ],
    [
        "novel" => "極楽戦争", "list" => [
                    ["ep_id" => 1, "chapter" => "第一話"],
                    ["ep_id" => 1, "chapter" => "第二話"],
                    ["ep_id" => 2, "chapter" => "第三話"],
                ]
    ],
*/

for ($i = 0; $i < $count; $i++){
    $nove_list[$i] = explode("|", $ret_array[$i]);
}

// $list == $nove_list
function get_list_and_episodes($list){
    foreach ($list as $item){
        $array = [];
//        if (file_exists($list[1] . "episodes.txt")) {
//            $episodes = file($list[1] . "episodes.txt");
//            for ($i = 0; $i < count($episodes); $i++){
//                $array[$i] = ["ep_id" => $episodes[i], ]
//            }
//        } else {
//            echo "$filename は存在しません";
//        }
//        $data =
        if(file_exists($item[1] . "list.txt")){
            $list_array = file($item[1] . "list.txt");
            $list_object = [];
            foreach ($list_array as $item2) {
                array_push($list_object, ["ep_id" => $list_array[0], "chapter" => $list_array[1]]);
            }
            $temp = [
                "novel" => $list[0],
                "list" => $list_object
            ];
            array_push($array, $temp);
        } else {
            $temp = [
                "novel" => $list[0],
                "list" =>
                    ["ep_id" => 1, "chapter" => 'list.txt が存在しないか、壊れています。Could not load "list.txt"']
            ];
            array_push($array, $temp);
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
<?php for ($i = 0; $i < $count; $i++) : ?>
    <?php echo "ID: " . $i . ", Title: " . $nove_list[$i][0] . ", Path: " . $nove_list[$i][1] . "<br>"; ?>
<?php endfor; ?>

<?php for ($j = 0; $j < count($data); $j++) : ?>
    <h2><?php echo "ID: " . $j . ", Title: " . $data[$j]["novel"]; ?></h2>
    <?php for ($k = 0; $k < count($data[j]); $k++) : ?>
        <p><?php echo "Episode: " . $data[$j][$k]["ep_id"] . ", Sub Title: " . $data[$j][$k]["chapter"]; ?></p>
    <?php endfor; ?>
<?php endfor; ?>

</body>
</html>