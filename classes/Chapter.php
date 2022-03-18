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
        $this->id = (int)$id;
        $this->title = $title;
        $this->path = $path; // "novels/shoroganeki/"
        $this->ep_num = (int)$ep_num;
        $this->start_ep_num = (int)$start_ep_num;
        $this->get_episodes();
    }

    function get_episodes(){
        $list = file($this->path . "list.txt"); // ["1|001|第一話", "1|2|第二話", "1|03|第三話", "2|4|第四話"...]
        for($i = 0; $i < $this->ep_num; $i++){
            $ep_id = $i + $this->start_ep_num - 1;
            $temp = explode("|", $list[$ep_id]); // [1, 001, "第一話"]
            array_push($this->episodes, new Episode($ep_id, $temp[2], $this->path, $temp[0], $temp[1]));
        }
    }
}