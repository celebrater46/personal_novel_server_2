<?php

class State
{
    public $font_family; // 0 = Gothic, 1 = Mincho
    public $font_size; // 1-9, 5 == default medium
    public $color; // 0 = default (ライトモード、ダークモードに依存), 1 = white, 2 = black, 3 = beige
    public $x; // 1 なら横書き

    function __construct(){
        $this->font_family = isset($_GET["family"]) ? (int)$_GET["family"] : 0;
        $this->font_size = isset($_GET["size"]) ? (int)$_GET["size"] : 5;
        $this->color = isset($_GET["color"]) ? (int)$_GET["color"] : 0;
        $this->x = isset($_GET["x"]) ? (int)$_GET["x"] : 1;
    }
}