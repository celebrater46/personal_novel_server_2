<?php

class Chapter
{
    public $novel_title; // 白金記
    public $title; // 第一章「日本編」
    public $path; // novels/shiroganeki/
    public $ep_num;
    public $start_ep_num;
    public $episodes = [];

    function __construct($title_path){
        $temp = explode("|", $title_path);
        $this->novel_title = $temp[0];
        $this->path = "novels/" . $temp[1] . "/";
    }
}