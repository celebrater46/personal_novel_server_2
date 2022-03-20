<?php

namespace personal_novel_server;

ini_set('display_errors', 1); // エラーメッセージを常時表示する
//define("INDEX_FILE", __DIR__ . '/index.php'); // 小説一覧ページを別途用意する場合は、ここを書き換え
define("SITE_NAME", 'Personal Novel Server');
define("DESCRIPTION", 'ここに説明書きがあれば書いてください（init.php）。');
define("AUTHOR", 'Enin Fujimi');
define("INDEX_FILE", 'index.php'); // 小説一覧ページを別途用意する場合は、ここを書き換え
define("INDEX_FILE_NAME", 'index.php'); // 小説一覧ページを別途用意する場合は、ここを書き換え（こちらはディレクトリなし）
define('NOVELS_DIR', __DIR__ . '/novels'); // 小説のディレクトリ（__DIR__ は現在のディレクトリ取得）
define('IMAGES_DIR_HTTP', 'img'); // HTTPでアクセスした際にディレクトリが変わるので用意
//define('USE_GET_FUNCTION', true); // 外部サイト組込用の関数を使用するか（true で使用）
define('LIGHT_AND_DARK', true); // 個人サイト用

