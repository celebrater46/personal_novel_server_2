<?php

require_once "get_chapters_and_episodes.php";
require_once "get_title_and_captions.php";

$title_and_path = get_title_and_path(); // [["第三世界収容所", "prison"], ["白金記", "shiroganeki"]... ]
$captions = get_captions($title_and_path);

$title = $title_and_path[$_GET['novel_id']][0];
$path = $title_and_path[$_GET['novel_id']][1];
$caption = $captions[$_GET['novel_id']];

$chapters_and_episodes = [];
$only_episodes = [];
$temp = [];

//$txt_files = glob("novels/" . $path . "/*.txt");
$txt_files = "hello World";

//$test_get_episodes_and_chapters= get_episodes_and_chapters("shiroganeki");
$has_chapters = has_chapters($path);
if($has_chapters){
    $chapters_and_episodes = get_chapters_and_episodes($path); // ["chapter" => "第一章「日本編", "episodes" => ["第一話", 第二話...]], [
} else {
    if(file_exists("novels/" . $path . "/list.txt")){
        $temp = file("novels/" . $path . "/list.txt"); // ["1|第一話", "1|第二話", "1|第三話", "2|第四話"...]
        $only_episodes = get_episodes($temp); // ["第一話", "第二話", "第三話"...]
    } else {
        $only_episodes = ["チャプターリスト（list.txt）が存在しないか、読み込めません。list.txt does not exist or unavailable."];
    }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="Author" content="Enin Fujimi">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title><?php echo $title; ?></title>
</head>
<body>
    <div class="containter">
        <h1>
            <?php echo $title; ?>
        </h1>

        <div class="caption">
            <?php foreach ($caption as $line) : ?>
                <p><?php echo $line; ?></p>
            <?php endforeach; ?>
            <p><?php var_dump($txt_files); ?></p>
        </div>

        <div class="episodes">
            <?php if ($has_chapters) : ?>

                <?php foreach ($chapters_and_episodes as $item) : ?>
                    <hr>
                    <h2><?php echo $item["chapter"]; ?></h2>
                    <div>
                        <?php foreach ($item["episodes"] as $episode) : ?>
                            <?php echo $episode . "<br>"; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>

            <?php else : ?>

                <?php foreach ($only_episodes as $episode) : ?>
                    <?php echo $episode . "<br>" ?>
                <?php endforeach; ?>

            <?php endif; ?>
        </div>

        <p class="back"><a href="index.php">- 戻る -</a></p>
    </div>
</body>
</html>
