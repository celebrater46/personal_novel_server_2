<?php

require_once "Novel.php";

$id = (int)$_GET["novel"];
$list = file("novels/novels_list.txt"); // 第三世界収容所|prison, 白金記|shiroganeki, 極楽戦争|gokuraku
$novel = new Novel($list[$id]);
$has_chapters = $novel->has_chapters();

if($has_chapters){
    $novel->get_chapters();
} else {
    $novel->get_episodes();
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="Author" content="Enin Fujimi">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title><?php echo $novel->title; ?></title>
</head>
<body>
    <div class="containter">
        <h1>
            <?php echo $novel->title; ?>
        </h1>

        <div class="caption">
            <?php foreach ($novel->caption as $line) : ?>
                <p><?php echo $line; ?></p>
            <?php endforeach; ?>
        </div>

        <div class="episodes">
            <?php if ($has_chapters) : ?>
                <?php foreach ($novel->chapters as $item) : ?>
                    <hr>
                    <h2><?php echo $item->title; ?></h2>
                    <div>
                        <ul>
                            <?php foreach ($item->episodes as $episode) : ?>
                                <li>
                                    <a href="reader.php?novel=<?php echo $id; ?>&chap=0&ep=<?php echo $episode->id; ?>">
                                        <?php echo $episode->title; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                    </div>
                <?php endforeach; ?>

            <?php else : ?>

                <ul>
                    <?php foreach ($novel->episodes as $episode) : ?>
                        <li>
                            <a href="reader.php?novel=<?php echo $id; ?>&chap=0&ep=<?php echo $episode->id; ?>">
                                <?php echo $episode->title; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

            <?php endif; ?>
        </div>
        <div class="back">
            <a href="index.php">
                小説一覧へ戻る
            </a>
        </div>
    </div>
</body>
</html>
