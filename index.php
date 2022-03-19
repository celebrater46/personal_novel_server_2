<?php

//Copyright (C) Enin Fujimi All Rights Reserved.

require_once "modules/main.php";
require_once "pns_get_html.php";
require_once "classes/State.php";
require_once "classes/Novel.php";
require_once "header.php";

$novels_list = file("novels/novels_list.txt"); // 第三世界収容所|prison, 白金記|shiroganeki, 極楽戦争|gokuraku
$novels = [];

$state = new State();

$i = 0;
foreach ($novels_list as $novel){
    array_push($novels, new Novel($i, $novel));
    $i++;
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
        <?php echo pns_get_html(); ?>
    </div>
    <?php echo get_nav($state); ?>
    <script type="text/javascript" src="js/burger.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>