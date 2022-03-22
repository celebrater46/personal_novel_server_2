<?php

namespace personal_novel_server\classes;

use personal_novel_server\modules as modules;

require_once "Chapter.php";
require_once "Episode.php";
require_once( dirname(__FILE__) . '/../modules/converter.php');

class Novel
{
    public $id;
    public $title; // 白金記
    public $path; // novels/shiroganeki/
    public $caption; // 世界からありとあらゆる争いを根絶し……
    public $has_chapters;
    public $has_episodes; // 短編など、1エピソードしかないものは false（list.txt がないものは短編とみなす）
    public $chapters = [];
    public $episodes = [];
    public $links = [];
    public $error = "";
    public $cover = null; // cover.jpg || cover.png が作品フォルダ内にあるか
    public $nums_eps_in_chap = []; // [3, 5, 2] (白金記サンプル、各チャプターの話数)
    public $nums_chap_start = [1]; // [1, 4, 8]（白金記サンプル、各チャプターが何話めから始まるか）

    function __construct($id, $title_path, $state){
        $this->id = $id;
        $temp = explode("|", $title_path);
//        var_dump($temp);
        $this->title = $temp[0];
        $temp[1] = str_replace([" ", "　", "\n", "\r", "\r\n"], "", $temp[1]); // 悪魔のバグ要因、全角＆半角スペース、改行コードの排除
        $this->path = ($state->is_v ? "" : PNS_PATH) . "novels/" . $temp[1] . "/";
        $this->caption = $this->get_caption();
        $this->has_chapters = $this->check_has_chapters();
        $this->has_episodes = $this->check_has_episodes();
        $this->cover = $this->get_cover();
        $this->get_links_to_posting_sites();
    }

    function get_text($chap, $ep){
//        var_dump($this);
        if($this->has_chapters){
            $start_ep_num = $this->chapters[$chap]->start_ep_num;
            $file_name = $this->chapters[$chap]->episodes[$ep - $start_ep_num]->file_name;
        } else if($this->has_episodes){
            $file_name = $this->episodes[$ep - 1]->file_name;
        } else {
            $file_name = "text"; // 1話のみの短編の場合は、text.txt で統一
        }
        $text = [];
        if(file_exists($this->path . "txts/" . $file_name . ".txt")){
            $array = file($this->path . "txts/" . $file_name . ".txt");
            $array2 = modules\convert_to_dot($array);
            $text = modules\convert_to_ruby($array2);
        } else {
            array_push($text, "[Error]");
            array_push($text, $file_name . ".txt が存在しないか、読み込めません。");
        }
        return $text;
    }

    function get_links_to_posting_sites(){
        if(file_exists($this->path . "links.txt")){
            $lines = file($this->path . "links.txt");
            foreach ($lines as $line){
                $temp = explode("|", $line);
                array_push(
                    $this->links,
                    [
                        "site_name" => $temp[0],
                        "url" => modules\delete_br($temp[1])
                    ]
                );
            }
        }
    }

    function get_cover(){
        if(file_exists($this->path . "cover.png")){
            return $this->path . "cover.png";
        } else if(file_exists($this->path . "cover.jpg")){
            return $this->path . "cover.jpg";
        }
    }

    function get_caption(){
        if(file_exists($this->path . "caption.txt")){
            $temp_array = file($this->path . "caption.txt");
            $caption_lines = [];
            foreach ($temp_array as $line){
                array_push($caption_lines, str_replace(["\n", "\r", "\r\n"], "", $line));
            }
            return $caption_lines;
        } else {
            return ["Not found: caption.txt"];
        }
    }

    function get_chapters(){
        $this->get_starts_eps_in_chap(); // create $nums_eps_in_chap, $nums_chap_start
        if(file_exists($this->path . "chapters.txt")){
            $temp_chapters = file($this->path . "chapters.txt"); // ["第一章「日本編」", "第二章「北朝鮮編」", "第三章「アメリカ編」"]
            $j = 0;
            foreach ($temp_chapters as $chapter){
                array_push(
                    $this->chapters,
                    new Chapter(
                        $j,
                        str_replace(["\n", "\r", "\r\n"], "", $chapter),
                        $this->path,
                        $this->nums_eps_in_chap[$j],
                        $this->nums_chap_start[$j]
                    )
                );
                $j++;
            }
        } else {
            $this->error = "チャプターリスト（chapters.txt）が存在しないか、読み込めません。chapters.txt does not exist or unavailable.";
        }
    }

    function get_episodes(){
        if(file_exists($this->path . "list.txt")){
            $list = file($this->path . "list.txt"); // ["1|001|第一話", "1|2|第二話", "1|03|第三話", "2|4|第四話"...]
            $i = 0;
            foreach ($list as $item){
                $temp = explode("|", $item); // [1, 001, "第一話"]
                array_push(
                    $this->episodes,
                    new Episode(
                        $i,
                        str_replace(["\n", "\r", "\r\n"], "", $temp[2]),
                        $this->path,
                        $temp[0],
                        $temp[1]
                    )
                );
                $i++;
            }
        } else {
            $this->error = "エピソードリスト（list.txt）が存在しないか、読み込めません。list.txt does not exist or unavailable.";
        }
    }

    function get_starts_eps_in_chap(){
        if(file_exists($this->path . "list.txt")){
            $list = file($this->path . "list.txt"); // ["1|001|第一話", "1|2|第二話"... ]
            $eps = 0;
            $start_ep = 1;
            $current_chap = 1;
            foreach ($list as $item){
                $chapid_ep = explode("|", $item); // [1, 001, "第一話"]
                if((int)$chapid_ep[0] > $current_chap){
                    array_push($this->nums_eps_in_chap, $eps);
                    array_push($this->nums_chap_start, $start_ep);
                    $eps = 0;
                    $current_chap++;
                }
                $eps++;
                $start_ep++;
            }
            array_push($this->nums_eps_in_chap, $eps); // final
        } else {
            $this->error = "エピソードリスト（list.txt）が存在しないか、読み込めません。list.txt does not exist or unavailable.";
        }
    }

    function check_has_chapters(){
        if(file_exists($this->path . "chapters.txt")){
            return true;
        } else {
            return false;
        }
    }

    function check_has_episodes(){
        if(file_exists($this->path . "list.txt")){
            return true;
        } else {
            return false;
        }
    }

    function get_max_ep(){
        if($this->has_chapters){
            $sum = 0;
            foreach ($this->chapters as $chapter){
                $sum += count($chapter->episodes);
            }
            return $sum;
        } else {
            return count($this->episodes);
        }
    }
}