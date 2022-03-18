<?php

require_once "Chapter.php";
require_once "Episode.php";

class Novel
{
    public $title; // 白金記
    public $path; // novels/shiroganeki/
    public $caption; // 世界からありとあらゆる争いを根絶し……
    public $has_chapters;
    public $chapters = [];
    public $episodes = [];
    public $error = "";
    public $nums_eps_in_chap = []; // [3, 5, 2] (白金記サンプル、各チャプターの話数)
    public $nums_chap_start = [1]; // [1, 4, 8]（白金記サンプル、各チャプターが何話めから始まるか）

    function __construct($title_path){
        $temp = explode("|", $title_path);
        $this->title = $temp[0];
        $temp[1] = str_replace([" ", "　", "\n", "\r", "\r\n"], "", $temp[1]); // 悪魔のバグ要因、全角＆半角スペース、改行コードの排除
        $this->path = "novels/" . $temp[1] . "/";
        $this->caption = file($this->path . "caption.txt");
        $this->has_chapters = $this->has_chapters();
    }

    function get_chapters(){
        $this->get_starts_eps_in_chap(); // create $nums_eps_in_chap, $nums_chap_start
        if(file_exists($this->path . "chapters.txt")){
            $temp_chapters = file($this->path . "chapters.txt"); // ["第一章「日本編」", "第二章「北朝鮮編」", "第三章「アメリカ編」"]
            $j = 0;
            foreach ($temp_chapters as $chapter){
                array_push(
                    $this->chapters,
                    new Chapter(
                        $j,
                        $chapter,
                        $this->path,
                        $this->nums_eps_in_chap[$j],
                        $this->nums_chap_start[$j]
                    )
                );
                $j++;
            }
        } else {
            $this->error = "チャプターリスト（chapters.txt）が存在しないか、読み込めません。chapters.txt does not exist or unavailable.";
        }
    }

    function get_episodes(){
        if(file_exists($this->path . "list.txt")){
            $list = file($this->path . "list.txt"); // ["1|001|第一話", "1|2|第二話", "1|03|第三話", "2|4|第四話"...]
            $i = 0;
            foreach ($list as $item){
                $temp = explode("|", $item); // [1, 001, "第一話"]
                array_push($this->episodes, new Episode($i, $temp[2], $this->path, $temp[0], $temp[1]));
                $i++;
            }
        } else {
            $this->error = "エピソードリスト（list.txt）が存在しないか、読み込めません。list.txt does not exist or unavailable.";
        }
    }

    function get_starts_eps_in_chap(){
        if(file_exists($this->path . "list.txt")){
            $list = file($this->path . "list.txt"); // ["1|001|第一話", "1|2|第二話"... ]
            $eps = 0;
            $start_ep = 1;
            $current_chap = 1;
            foreach ($list as $item){
                $chapid_ep = explode("|", $item); // [1, 001, "第一話"]
                if((int)$chapid_ep[0] > $current_chap){
                    array_push($this->nums_eps_in_chap, $eps);
                    array_push($this->nums_chap_start, $start_ep);
                    $eps = 0;
                    $current_chap++;
                }
                $eps++;
                $start_ep++;
            }
            array_push($this->nums_eps_in_chap, $eps); // final
        } else {
            $this->error = "エピソードリスト（list.txt）が存在しないか、読み込めません。list.txt does not exist or unavailable.";
        }
    }

    function has_chapters(){
        if(file_exists($this->path . "chapters.txt")){
            return true;
        } else {
            return false;
        }
    }

}