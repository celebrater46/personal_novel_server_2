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
    <title><?php echo PNS_SITE_NAME; ?></title>
    <?php echo modules\get_style($state); ?>
</head>
<body>
    <div id="pns_container" class="pns_container">
        <h1>
            <a href="/">
                <?php echo $state->pns === 0 ? PNS_SITE_NAME : ""; ?>
            </a>
        </h1>
        <p class="description"><?php echo $state->pns === 0 ? PNS_DESCRIPTION : ""; ?></p>
        <?php echo pns\pns_get_html(); ?>
    </div>
    <?php echo modules\get_nav($state); ?>
    <?php echo modules\get_js_links($state); ?>
</body>
</html>