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
    <title><?php echo SITE_NAME; ?></title>
    <?php echo get_style($state); ?>
</head>
<body>
<!--    --><?php //echo get_header($state); ?>
    <div class="containter">
        <h1>
            <a href="/">
                <?php echo SITE_NAME; ?>
            </a>
        </h1>
        <p class="description"><?php echo DESCRIPTION; ?></p>
        <?php echo pns_get_html(); ?>
    </div>
    <?php echo get_nav($state); ?>
    <?php echo get_js_links(); ?>
</body>
</html>