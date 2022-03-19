<?php

require_once "modules/main.php";
require_once "pns_get_html.php";
require_once "classes/State.php";
require_once "classes/Novel.php";
require_once "header.php";

//$id = (int)$_GET["novel"];
$state = new State();
$novel = get_novel_obj_once($state->novel_id);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="Author" content="Enin Fujimi">
    <link href="https://fonts.googleapis.com/css?family=Sawarabi+Mincho" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title><?php echo h($novel->title); ?></title>
    <?php echo get_style($state); ?>
</head>
<body>
    <?php echo get_header($state); ?>
    <div class="containter">
        <?php if(USE_GET_FUNCTION) : ?>
            <?php echo get_html_ep_list(); ?>
        <?php else: ?>
            <h1>
                <?php echo h($novel->title); ?>
            </h1>

            <div class="caption">
                <?php foreach ($novel->caption as $line) : ?>
                    <p><?php echo h($line); ?></p>
                <?php endforeach; ?>
            </div>

            <div class="episodes">
                <?php if ($novel->has_chapters) : ?>
                    <?php foreach ($novel->chapters as $item) : ?>
                        <hr>
                        <h2><?php echo h($item->title); ?></h2>
                        <div>
                            <ul>
                                <?php foreach ($item->episodes as $episode) : ?>
                                    <li>
                                        <a href="reader.php?novel=<?php echo h($id); ?>&chap=<?php echo h($item->id); ?>&ep=<?php echo h($episode->id + 1); ?>">
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
                                <a href="reader.php?novel=<?php echo h($id); ?>&chap=0&ep=<?php echo h($episode->id + 1); ?>">
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
        <?php endif; ?>
    </div>
    <script type="text/javascript" src="js/burger.js"></script>
</body>
</html>
