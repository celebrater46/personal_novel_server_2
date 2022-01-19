<?php

class Episode
{
    public $id;
    public $title; // 第一話「訪問者」
    public $path; // "novels/shiroganeki/"
//    public $link; // "novels/shiroganeki/001.txt
    public $chap_num;
    public $file_name; // 001

    function __construct($id, $title, $path, $chap_num, $file_name){
        $this->id = $id;
        $this->title = $title;
        $this->path = $path;
        $this->chap_num = $chap_num;
        $this->file_name = $file_name;
//        $this->link = $this->path . $this->file_name . ".txt";
    }
}