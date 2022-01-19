<?php

class Episode
{
    public $id;
    public $title; // 第一話「訪問者」
    public $path; // "novels/shiroganeki/"
    public $chap_num;
    public $file_name; // 001
//    public $text = [];

    function __construct($id, $title, $path, $chap_num, $file_name){
        $this->id = (int)$id;
        $this->title = $title;
        $this->path = $path;
        $this->chap_num = (int)$chap_num;
        $this->file_name = $file_name;
    }

    function get_text(){
        $temp_array = file($this->path . "txts/" . $this->file_name . ".txt");
        $text = [];
        foreach ($temp_array as $line){
            // <ruby>堕天男><rp>（</rp><rt>ルシファー</rt><rp>）</rp></ruby>
            $temp = str_replace(["|", "｜"], "<ruby>", $line);
            $temp = str_replace("《", "<rp>（</rp><rt>", $temp);
            $temp = str_replace("》", "</rt><rp>）</rp></ruby>", $temp);
            array_push($text, $temp);
        }
        return $text;
    }
}