<?php

require_once "get_chapters_and_episodes.php";
require_once "get_title_and_captions.php";

$title_and_path = get_title_and_path(); // [["第三世界収容所", "prison"], ["白金記", "shiroganeki"]... ]
$captions = get_captions($title_and_path);

$title = $title_and_path[$_GET['novel_id']][0];
$path = "novels/" . $title_and_path[$_GET['novel_id']][1];
$caption = $captions[$_GET['novel_id']];
$list = file($path . "/list.txt"); // ["1|001|第一話", "1|2|第二話", "1|03|第三話"...]

$chapters_and_episodes = [];
$only_path_eps = [];
$temp = [];

$file_names = get_file_names($path, $list); // ["novels/shiroganeki/001.txt", "novels/shiroganeki/0002.txt"...]

//$temp_txt_files = glob($path . "/txts/*.txt");
//
//foreach ($temp_txt_files as $file){
//    // "novels/shiroganeki/txts/1.txt" => "1"
//    $temp = str_replace($path . "/txts/", "", $file);
//    array_push($txt_files, $temp);
//}
//$txt_files = "hello World";

//$test_get_episodes_and_chapters= get_episodes_and_chapters("shiroganeki");
$has_chapters = has_chapters($path);
if($has_chapters){
    // ["chapter" => "第一章「日本編", "path_eps" => [[[path, ep], [path, ep]], [[path, ep], [path, ep]]...] ]
    $chapters_and_episodes = get_chapters_and_episodes($path);
} else {
    if(file_exists($path . "/list.txt")){
//        $temp = file($path . "/list.txt"); // ["1|第一話", "1|第二話", "1|第三話", "2|第四話"...]
        $only_path_eps = get_path_eps($path, $list); // [["~/001.txt", "第一話"], ["~/0002.txt", "第二話"], ["~/03.txt", "第三話"]...]
    } else {
        $only_path_eps = ["チャプターリスト（list.txt）が存在しないか、読み込めません。list.txt does not exist or unavailable."];
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
        </div>

        <div class="episodes">
            <?php if ($has_chapters) : ?>
                <?php foreach ($chapters_and_episodes as $item) : ?>
                    <hr>
                    <h2><?php echo $item["chapter"]; ?></h2>
                    <div>
                        <ul>
                            <?php foreach ($item["path_eps"] as $path_ep) : ?>
                                <li>
                                    <a href="<?php echo $path_ep[0]; ?>">
                                        <?php echo $path_ep[1]; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                    </div>
                <?php endforeach; ?>

            <?php else : ?>

                <ul>
                    <?php foreach ($only_path_eps as $path_ep) : ?>
                        <li>
                            <a href="<?php echo $path_ep[0]; ?>">
                                <?php echo $path_ep[1]; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

            <?php endif; ?>
        </div>

        <p class="back"><a href="index.php">- 戻る -</a></p>
    </div>
</body>
</html>
