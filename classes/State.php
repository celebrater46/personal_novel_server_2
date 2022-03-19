<?php

class State
{
    public $novel_id;
    public $chap_id;
    public $ep_id;
    public $font_family; // 0 = Gothic, 1 = Mincho
    public $font_size; // 1-9, 5 == default medium
    public $color; // 0 = default (ライトモード、ダークモードに依存), 1 = white, 2 = black, 3 = beige
    public $x; // 1 なら横書き
    public $has_other_state = false; // Personal Novel Server 以外で使っている URL パラメーターがあるか
    public $other_states = [];
    public $other_states_str = "";

    function __construct(){
        $this->novel_id = isset($_GET["novel"]) ? (int)$_GET["novel"] : 0;
        $this->chap_id = isset($_GET["chap"]) ? (int)$_GET["chap"] : 0;
        $this->ep_id = isset($_GET["ep"]) ? (int)$_GET["ep"] : 1;
        $this->font_family = isset($_GET["family"]) ? (int)$_GET["family"] : 0;
        $this->font_size = isset($_GET["size"]) ? (int)$_GET["size"] : 5;
        $this->color = isset($_GET["color"]) ? (int)$_GET["color"] : 0;
        $this->x = isset($_GET["x"]) ? (int)$_GET["x"] : 1;
        $this->get_other_states();
    }

    function get_other_states(){
        $keys = array_keys($_GET);
//        $other_states = [];
//        $other_states_str = "?";
        foreach ($keys as $key){
            if($key !== "novel"
            && $key !== "chap"
            && $key !== "ep"
            && $key !== "family"
            && $key !== "size"
            && $key !== "color"
            && $key !== "x")
            {
                if($this->has_other_state === false){
                    $this->other_states_str .= "?" . $key . "=" . $_GET[$key];
                    $this->has_other_state = true;
                } else {
                    $this->other_states_str .= "&" . $key . "=" . $_GET[$key];
                }
                array_push($this->other_states, $key);
            }
        }
    }
}