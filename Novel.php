<?php

class Novel
{
    public $title; // 白金記
    public $path; // novels/shiroganeki/
    public $caption; // 世界からありとあらゆる争いを根絶し……
    public $chapters = [];

    function __construct($title_path){
        $temp = explode("|", $title_path);
        $this->title = $temp[0];
        $this->path = "novels/" . $temp[1] . "/";
        $this->caption = file($this->path . "txts/caption.txt");
    }

    function get_chapters(){
        if(file_exists($this->path . "chapters.txt")){
            $this->chapters = file($this->path . "chapters.txt");
            return $this->chapters;
        } else {
            return null;
        }
    }

    function get_episodes(){
        if(file_exists($this->path . "list.txt")){
            return true;
        } else {
            return ["エピソードリスト（list.txt）が存在しないか、読み込めません。list.txt does not exist or unavailable."];
        }
    }

    function get_num_of_each_chapters(){
        $array = file($this->path . "list.txt"); // ["1|001|第一話「訪問者」", "1|2|第二話「蹂躙」"... ]
        $chapids = [];
        foreach ($array as $item){
            $chapid_ep = explode("|", $item);
            array_push($chapids, $chapid_ep[0]); // [1, 1, 1, 2, 2, 2...]
        }
        $nums = array_count_values($chapids);
        return $nums; // [[1] => 2, [2] => 1, [3] => 4... ]
    }

    function has_chapters(){
        if(file_exists($this->path . "chapters.txt")){
            return true;
        } else {
            return false;
        }
    }

}