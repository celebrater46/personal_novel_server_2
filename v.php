<?php

//Copyright (C) Enin Fujimi All Rights Reserved.

require_once "modules/main.php";
require_once "pns_get_html.php";
require_once "classes/State.php";
require_once "classes/Novel.php";
require_once "header.php";

$state = new State();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="Author" content="<?php echo AUTHOR; ?>">
    <?php echo get_web_fonts_links(); ?>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/y.css" type="text/css">
    <title><?php echo SITE_NAME; ?></title>
    <?php echo get_style($state); ?>
</head>
<body>
<?php echo get_header($state); ?>
<div id="container" class="containter">
    <?php echo pns_get_html(); ?>
    <div class="backHome">
        <a href="<?php echo INDEX_FILE; ?>">トップへ戻る</a>
    </div>
</div>
<?php echo get_nav($state); ?>
<div id="leftButton" class="stealthButton lr" onclick="clickedButton(true)">
    ＜＜
</div>
<div id="rightButton" class="stealthButton lr" onclick="clickedButton(false)">
    ＞＞
</div>
<?php echo get_js_links(); ?>
<script>
    window.scrollTo({
        left: 1000000,
    });
</script>
</body>
</html>