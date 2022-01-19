<?php

require_once "Episode.php";

class Chapter
{
    public $id;
    public $title; // 第一章「日本編」
    public $path; // "novels/shiroganeki/"
    public $ep_num;
    public $start_ep_num;
    public $episodes = [];

    function __construct($id, $title, $path, $ep_num, $start_ep_num){
        $this->id = $id;
        $this->title = $title;
        $this->path = $path; // "novels/shoroganeki/"
        $this->ep_num = $ep_num;
        $this->start_ep_num = $start_ep_num;
        $this->get_episodes();
    }

    function get_episodes(){
        $list = file($this->path . "list.txt"); // ["1|001|第一話", "1|2|第二話", "1|03|第三話", "2|4|第四話"...]
        $i = 0;
        foreach ($list as $item){
            $temp = explode("|", $item); // [1, 001, "第一話"]
            array_push($this->episodes, new Episode($i, $temp[2], $this->path, $temp[0], $temp[1]));
            $i++;
        }
    }
}