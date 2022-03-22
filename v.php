<?php

//Copyright (C) Enin Fujimi All Rights Reserved.

use personal_novel_server as pns;
use personal_novel_server\modules as modules;
use personal_novel_server\classes\State;

require_once "init.php";
require_once "modules/main.php";
require_once "modules/converter.php";
require_once "modules/header.php";
require_once "pns_get_html.php";
require_once "classes/State.php";
require_once "classes/Novel.php";

$state = new State();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="Author" content="<?php echo PNS_AUTHOR; ?>">
    <?php echo modules\get_web_fonts_links(); ?>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/y.css" type="text/css">
    <title><?php echo PNS_SITE_NAME; ?></title>
    <?php echo modules\get_style($state); ?>
</head>
<body>
    <?php echo pns\pns_get_html(); ?>
<?php echo modules\get_nav($state); ?>
<div id="leftButton" class="stealthButton lr" onclick="PNS.clickedButton(true)">
    ＜＜
</div>
<div id="rightButton" class="stealthButton lr" onclick="PNS.clickedButton(false)">
    ＞＞
</div>
<?php echo modules\get_js_links($state); ?>
<script>
    window.scrollTo({
        left: 1000000,
    });
</script>
</body>
</html>