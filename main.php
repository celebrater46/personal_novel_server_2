<?php

ini_set('display_errors', 1); // エラーメッセージを常時表示する
define("INDEX_FILE", __DIR__ . '/index.php'); // 小説一覧ページを別途用意する場合は、ここを書き換え
define('NOVELS_DIR', __DIR__ . '/novels'); // 小説のディレクトリ（__DIR__ は現在のディレクトリ取得）
define('IMAGES_DIR_HTTP', 'img'); // HTTPでアクセスした際にディレクトリが変わるので用意

// エスケープ
function h($s) {
    return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}