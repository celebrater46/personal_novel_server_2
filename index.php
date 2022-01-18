<?php

require_once "get_novelist.php";

// Test to create the array from List of TXT

//$count = count($novels_array);
$nove_list = [];

//for ($i = 0; $i < $count; $i++){
//    $nove_list[$i] = explode("|", $novels_array[$i]);
//}

function get_title_and_path(){
    $novels_array = file("list.txt"); // ["第三世界収容所|prison", "白金記|shiroganeki, "極楽戦争|gokuraku"...]
    $temp_list = [];
    foreach ($novels_array as $item) {
        $temp = explode("|", $item);
        array_push($temp_list, $temp);
    }
    return $temp_list; // [["第三世界収容所", "prison"], ["白金記", "shiroganeki"]... ]
}

function get_captions($list){
    // $list == [["第三世界収容所", "prison"], ["白金記", "shiroganeki"]... ]
//    var_dump($list);
    $captions = [];
    foreach ($list as $item){
        $path = str_replace([" ", "　", "\n", "\r", "\r\n"], "", $item[1]); // 悪魔のバグ要因、全角＆半角スペース、改行コードの排除
//        echo $path . "/caption.txt" . PHP_EOL;
        if(file_exists($path . "/caption.txt")){
            $caption = file($path . "/caption.txt");
            array_push($captions, $caption);
        } else {
            $error = ["キャプションファイルが見つからないか、読み込めません。"];
            array_push($captions, $error);
        }
    }
//    var_dump($captions);
    return $captions;
}

$title_and_path = get_title_and_path();
$captions = get_captions($title_and_path);

$test_get_novelist= get_novelist("shiroganeki");

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
    <p>Memo: ["episode" => "第一章「日本編", "chapters" => ["第一話", 第二話...]], [</p>
    <?php foreach ($test_get_novelist as $item) : ?>
        <p>--------------------------------</p>
        <h2><?php echo $item["episode"] ?></h2>
        <?php foreach ($item["chapters"] as $chapter) : ?>
            <?php echo $chapter . "<br>" ?>
        <?php endforeach; ?>
    <?php endforeach; ?>

    <?php for ($i = 0; $i < count($title_and_path); $i++) : ?>
        <p>--------------------------------</p>
        <h2><?php echo $title_and_path[$i][0] ?></h2>
        <?php foreach ($captions[$i] as $caption) : ?>
            <p><?php echo $caption ?></p>
        <?php endforeach; ?>
    <?php endfor; ?>

</body>
</html>