<?php

require_once "Novel.php";

$novels_list = file("novels/novels_list.txt"); // 第三世界収容所|prison, 白金記|shiroganeki, 極楽戦争|gokuraku
$novels = [];

foreach ($novels_list as $novel){
    array_push($novels, new Novel($novel));
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="Author" content="Enin Fujimi">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title>Personal Novel Server</title>
</head>
<body>
    <div class="containter">
        <h1>
            <a href="/">
                Personal Novel Server
            </a>
        </h1>

        <?php for ($i = 0; $i < count($novels_list); $i++) : ?>
            <hr>
            <h2>
                <a href="ep_list.php?novel=<?php echo $i; ?>">
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