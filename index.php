<?php

require_once "get_episodes_and_chapters.php";
require_once "get_title_and_captions.php";

// Test to create the array from List of TXT

$title_and_path = get_title_and_path();
$captions = get_captions($title_and_path);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="Author" content="Enin Fujimi">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title>Test Novel List</title>
</head>
<body>
    <h1>
        <a href="/">
            Test Novel List
        </a>
    </h1>
    <p>Memo: ["episode" => "第一章「日本編", "chapters" => ["第一話", 第二話...]], [</p>
    <?php for ($i = 0; $i < count($title_and_path); $i++) : ?>
        <hr>
        <h2>
            <a href="chapters.php?novel_id=<?php echo $i; ?>">
                <?php echo $title_and_path[$i][0] ?>
            </a>
        </h2>
        <div class="caption">
            <?php foreach ($captions[$i] as $line) : ?>
                <p><?php echo $line ?></p>
            <?php endforeach; ?>
        </div>
    <?php endfor; ?>

</body>
</html>