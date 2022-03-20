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
    <meta name="Author" content="<?php echo AUTHOR; ?>">
    <?php echo modules\get_web_fonts_links(); ?>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title><?php echo SITE_NAME; ?></title>
    <?php echo modules\get_style($state); ?>
</head>
<body>
    <div id="container" class="container">
        <?php echo pns\pns_get_html(); ?>
    </div>
    <?php echo modules\get_nav($state); ?>
    <?php echo modules\get_js_links(); ?>
</body>
</html>