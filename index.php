<?php

//require_once "get_chapters_and_episodes.php";
//require_once "get_title_and_captions.php";
require_once "Novel.php";

$novels_list = file("novels/novels_list.txt"); // 第三世界収容所|prison, 白金記|shiroganeki, 極楽戦争|gokuraku
$novels = [];
//$shiroganeki = new Novel("白金記", "shiroganeki");

foreach ($novels_list as $novel){
    array_push($novels, new Novel($novel));
}

// Test to create the array from List of TXT

//$title_and_path = get_title_and_path();
//$captions = get_captions($title_and_path);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="Author" content="Enin Fujimi">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title>Test Novel List</title>
</head>
<body>
    <div class="containter">
        <h1>
            <a href="/">
                Test Novel List
            </a>
        </h1>
        <p>Memo: ["episode" => "第一章「日本編", "chapters" => ["第一話", 第二話...]], [</p>
        <?php for ($i = 0; $i < count($novels_list); $i++) : ?>
            <hr>
            <h2>
                <a href="show_episodes.php?novel_id=<?php echo 1; ?>">
                    <?php echo $novels[$i]->title; ?>
                </a>
            </h2>
            <div class="caption">
                <?php foreach ($novels[$i]->caption as $line) : ?>
                    <p><?php echo $line ?></p>
                <?php endforeach; ?>
            </div>
        <?php endfor; ?>
    </div>
</body>
</html>