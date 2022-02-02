<?php

require_once "main.php";
require_once "Novel.php";
require_once "Episode.php";
require_once "header.php";

$novel_id = (int)$_GET["novel"];
$chap_id = (int)$_GET["chap"];
$ep_id = (int)$_GET["ep"];
$prev = -1;
$next = 1;
$is_error = false;
$error_msg = "";

$novels_list = file("novels/novels_list.txt");
$novel = new Novel($novels_list[$novel_id]);

$list = file($novel->path . "list.txt"); // ["1|001|第一話", "1|2|第二話", "1|03|第三話", "2|4|第四話"...]
$temp = explode("|", $list[$ep_id]); // 1, 001, "第一話"

// list.txt の書式が正しいかのチェック
if(count($temp) === 3){
    $episode = new Episode($ep_id, $temp[2], $novel->path, $temp[0], $temp[1]);
    $text = $episode->get_text();
    if($ep_id < count($list) - 1){
        $next = $ep_id + 1;
    } else {
        $next = 0;
    }
    if($ep_id > 0) {
        $prev = $ep_id - 1;
    }
} else {
    $is_error = true;
    $error_msg = "list.txt の書き方が間違っています。";
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
    <?php echo h(get_header()); ?>
    <div class="containter">
        <?php if ($is_error === true) : ?>
            <h1>ERROR</h1>
            <p><?php echo h($error_msg); ?></p>
        <?php else : ?>
            <h1>
                <?php echo h($novel->title); ?>
            </h1>
            <h2><?php echo h($episode->title); ?></h2>
            <div class="text">
                <?php foreach ($text as $line) : ?>
                    <p class="text line"><?php echo $line; ?></p>
                <?php endforeach; ?>
            </div>
            <div class="text links">
                <div>
                    <?php if ($prev >= 0) : ?>
                        <a href="reader.php?novel=<?php echo h($novel_id); ?>&chap=<?php echo h($chap_id); ?>&ep=<?php echo h($prev); ?>">
                            ＜＜
                        </a>
                    <?php endif; ?>
                </div>
                <div>
                    <a href="ep_list.php?novel=<?php echo h($novel_id); ?>">
                        一覧へ戻る
                    </a>
                </div>
                <div>
                    <?php if ($next > 0) : ?>
                        <a href="reader.php?novel=<?php echo h($novel_id); ?>&chap=<?php echo h($chap_id); ?>&ep=<?php echo h($next); ?>">
                            ＞＞
                        </a>
                    <?php endif; ?>
                </div>
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