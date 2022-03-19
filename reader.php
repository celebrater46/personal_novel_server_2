<?php

require_once "modules/main.php";
require_once "pns_get_html.php";
require_once "classes/State.php";
//require_once "classes/Novel.php";
require_once "classes/Episode.php";
require_once "header.php";

$state = new State();
//$novel_id = (int)$_GET["novel"];
//$chap_id = (int)$_GET["chap"];
//$ep_id = (int)$_GET["ep"];
//$prev = -1;
//$next = 1;
$is_error = false;
$error_msg = "";

//$novels_list = file("novels/novels_list.txt");
//$novel = new Novel($novel_id, $novels_list[$novel_id]);
$novel = get_novel_obj($state->novel_id);
$text = $novel->get_text($state->chap_id, $state->ep_id);
$start_ep_num = $novel->chapters[$state->chap_id]->start_ep_num;

//$list = file($novel->path . "list.txt"); // ["1|001|第一話", "1|2|第二話", "1|03|第三話", "2|4|第四話"...]
//$temp = explode("|", $list[$ep_id]); // 1, 001, "第一話"

//$p = get_parameters(); // font_family, font_size, color, x
//$state = new State();

// list.txt の書式が正しいかのチェック
//if(count($temp) === 3){
//    $episode = new Episode($ep_id, $temp[2], $novel->path, $temp[0], $temp[1]);
//    $text = $episode->get_text();
//    if($ep_id < count($list) - 1){
//        $next = $ep_id + 1;
//    } else {
//        $next = 0;
//    }
//    if($ep_id > 0) {
//        $prev = $ep_id - 1;
//    }
//} else {
//    $is_error = true;
//    $error_msg = "list.txt の書き方が間違っています。";
//}

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
            <?php echo get_html_reader(); ?>
        <?php else: ?>
            <?php if ($is_error === true) : ?>
                <h1>ERROR</h1>
                <p><?php echo h($error_msg); ?></p>
            <?php else : ?>
                <h1>
                    <?php echo h($novel->title); ?>
                </h1>
                <?php if($novel->has_chapters) : ?>
                    <h2><?php echo h($novel->chapters[$state->chap_id]->title); ?></h2>
                    <h3><?php echo h($novel->chapters[$state->chap_id]->episodes[$state->ep_id - $start_ep_num]->title); ?></h3>
                <?php else : ?>
                    <h2><?php echo h($novel->episodes[$state->ep_id]->title); ?></h2>
                <?php endif; ?>
                <div class="text">
                    <?php foreach ($text as $line) : ?>
                        <p class="text line"><?php echo $line; ?></p>
                    <?php endforeach; ?>
                </div>
                <div class="text links">
                    <div>
                        <?php if ($state->ep_id - 1 >= 0) : ?>
                            <a href="reader.php?novel=<?php echo h($state->novel_id); ?>&chap=<?php echo h($state->chap_id); ?>&ep=<?php echo h($state->ep_id - 1); ?>">
                                ＜＜
                            </a>
                        <?php endif; ?>
                    </div>
                    <div>
                        <a href="ep_list.php?novel=<?php echo h($state->novel_id); ?>">
                            一覧へ戻る
                        </a>
                    </div>
                    <div>
                        <?php if ($state->ep_id + 1 > $novel->get_max_ep()) : ?>
                            <a href="reader.php?novel=<?php echo h($state->novel_id); ?>&chap=<?php echo h($state->chap_id); ?>&ep=<?php echo h($state->ep_id + 1); ?>">
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
        <?php endif; ?>
    </div>
    <script type="text/javascript" src="js/burger.js"></script>
</body>
</html>