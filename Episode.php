<?php

class Episode
{
    public $novel_title; // 白金記
    public $chapter_title; // 第一章「日本編」
    public $title; // 第一話「訪問者」
    public $path; // novels/shiroganeki/

    function __construct($title_path){
        $temp = explode("|", $title_path);
        $this->novel_title = $temp[0];
        $this->path = "novels/" . $temp[1] . "/";
    }
}