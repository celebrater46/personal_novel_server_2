<?php

require_once "Novel.php";
$novel = new Novel("白金記|shiroganeki");
//$novel = new Novel("第三世界収容所|prison");

$has_chapters = $novel->has_chapters();

if($has_chapters){
    $novel->get_chapters();
} else {
    $novel->get_episodes();
}

//var_dump($has_chapters);
//var_dump($novel->chapters[2]->test_array);
var_dump($novel->chapters);
//foreach ($novel->chapters[0]->episodes as $episode){
//    var_dump($episode);
//    echo "_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/\r\n \r \n" . PHP_EOL;
//}
//echo "_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/";
//var_dump($novel->chapters[2]->episodes);
//var_dump($novel->nums_eps_in_chap);
//var_dump($novel->nums_chap_start);
//var_dump($novel->test);
//var_dump($novel->episodes);