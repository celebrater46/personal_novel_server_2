<?php

//Copyright (C) Enin Fujimi All Rights Reserved.

require_once "main.php";
require_once "State.php";
require_once "Novel.php";
require_once "header.php";

$novels_list = file("novels/novels_list.txt"); // 第三世界収容所|prison, 白金記|shiroganeki, 極楽戦争|gokuraku
$novels = [];

$state = new State();

foreach ($novels_list as $novel){
    array_push($novels, new Novel($novel));
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="Author" content="Enin Fujimi">
    <link href="https://fonts.googleapis.com/css?family=Sawarabi+Mincho" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title>Personal Novel Server</title>
    <?php echo get_style($state); ?>
</head>
<body>
    <?php echo get_header($state); ?>
    <div class="containter">
        <h1>
            <a href="/">
                Personal Novel Server
            </a>
        </h1>

        <?php for ($i = 0; $i < count($novels_list); $i++) : ?>
            <hr>
            <h2>
                <a href="ep_list.php?novel=<?php echo h($i); ?>">
                    <?php echo h($novels[$i]->title); ?>
                </a>
            </h2>
            <div class="caption">
                <?php foreach ($novels[$i]->caption as $line) : ?>
                    <p><?php echo h($line) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endfor; ?>
    </div>
    <?php echo get_nav($state); ?>
    <script type="text/javascript" src="js/burger.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>