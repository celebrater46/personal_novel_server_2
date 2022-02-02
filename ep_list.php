<?php

require_once "main.php";
require_once "Novel.php";
require_once "header.php";

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
    <title><?php echo h($novel->title); ?></title>
</head>
<body>
    <?php echo h(get_header()); ?>
    <div class="containter">
        <h1>
            <?php echo h($novel->title); ?>
        </h1>

        <div class="caption">
            <?php foreach ($novel->caption as $line) : ?>
                <p><?php echo h($line); ?></p>
            <?php endforeach; ?>
        </div>

        <div class="episodes">
            <?php if ($has_chapters) : ?>
                <?php foreach ($novel->chapters as $item) : ?>
                    <hr>
                    <h2><?php echo h($item->title); ?></h2>
                    <div>
                        <ul>
                            <?php foreach ($item->episodes as $episode) : ?>
                                <li>
                                    <a href="reader.php?novel=<?php echo h($id); ?>&chap=0&ep=<?php echo h($episode->id); ?>">
                                        <?php echo h($episode->title); ?>
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
                            <a href="reader.php?novel=<?php echo h($id); ?>&chap=0&ep=<?php echo h($episode->id); ?>">
                                <?php echo h($episode->title); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

            <?php endif; ?>
        </div>
        <div class="back">
            <a href="<?php echo h(INDEX_FILE); ?>">
                小説一覧へ戻る
            </a>
        </div>
    </div>
    <script type="text/javascript" src="js/burger.js"></script>
</body>
</html>
