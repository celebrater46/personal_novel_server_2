<?php

namespace personal_novel_server;

ini_set('display_errors', 1); // エラーメッセージを常時表示する
//define("PNS_SITE_NAME", 'Personal Novel Server');
define("PNS_SITE_NAME", '小説');
define("PNS_DESCRIPTION", '富士見永人名義で小説を書いています。<br><a href="https://novelup.plus/user/350590019/profile">ノベルアッププラス</a>、 <a href="https://mypage.syosetu.com/476781/">小説家になろう</a>、 <a href="https://kakuyomu.jp/users/eningrad">カクヨム</a>で活動中です。<br>縦書きモードで読む場合は<a href="https://enin-world.sakura.ne.jp/files/app/php/personal_novel_server/v.php?lang=0&mode=' . (isset($_GET["mode"]) ? $_GET["mode"] : 0) . '&css=0&x=0">こちら</a>をクリックしてください。');
define("PNS_AUTHOR", 'Enin Fujimi');
//define("PNS_INDEX_FILE", ''); // 小説一覧ページを別途用意する場合は、ここを書き換え
//define("PNS_INDEX_FILE", 'http://localhost/myapps/personal_novel_server_2/index.php');
//define("PNS_INDEX_FILE", 'http://localhost/myapps/fujimipolis/files/novel.php');
define("PNS_INDEX_FILE", 'https://enin-world.sakura.ne.jp/files/novel.php');
//define("PNS_INDEX_FILE", 'https://enin-world.sakura.ne.jp/files/app/demo/personal_novel_server/index.php');
define('PNS_NOVELS_DIR', __DIR__ . '/novels'); // 小説のディレクトリ（__DIR__ は現在のディレクトリ取得）
//define('PNS_PATH', ''); // プロジェクトフォルダのパス（外部サイトに組み込む場合は書き換える）
define('PNS_PATH', 'app/php/personal_novel_server/');
define('IMAGES_DIR_HTTP', 'img'); // HTTPでアクセスした際にディレクトリが変わるので用意
//define('PNS_LIGHT_AND_DARK', false); // 個人サイト用
define('PNS_LIGHT_AND_DARK', true);
