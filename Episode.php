<?php

class Episode
{
    public $id;
    public $title; // 第一話「訪問者」
    public $path; // "novels/shiroganeki/"
    public $chap_num;
    public $file_name; // 001

    function __construct($id, $title, $path, $chap_num, $file_name){
        $this->id = (int)$id;
        $this->title = $title;
        $this->path = $path;
        $this->chap_num = (int)$chap_num;
        $this->file_name = $file_name;
    }
}