<?php

class Helper
{
    public function formatDate($date){
        return date('F j, Y, g:i a', strtotime($date));
    }

    public function textShort($text,$limit){
        $text .=' ';
        $text = substr($text,0,$limit);
        $text = substr($text,0, strrpos($text,' '));
        $text .='...';
        return $text;
    }

    public function validation($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    public function title(){
        $path = $_SERVER['SCRIPT_FILENAME'];
        $title = basename($path,'.php');
        $title = str_replace('-',' ',$title);
        if ($title=='contact') {
            $title = 'Contact';
        }else if($title=='index'){
            $title = 'Home';
        }
        return ucfirst($title);
    }
}

?>
