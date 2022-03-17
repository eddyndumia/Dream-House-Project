<?php

  class Session
  {
    public static function init(){
      session_start();
    }

    public static function set($key,$value){
      $_SESSION[$key] = $value;
    }

    public static function get($key){
      if(isset($_SESSION[$key])){
        return $_SESSION[$key];
      }
      else{
        return false;
      }
    }

    public static function checkSession(){
      // self::init();
      if(self::get('login') == false){
        self::sessionDestroy();
      }
    }

    public static function checkAdmin(){
      if(self::get('user') != 'admin'){
        session_destroy();
        Header('Location:login.php');
      }
    }

    public static function sessionDestroy(){
      session_destroy();
      Header('Location:index.php');
    }
    public function sessionDestroyadmin()
    {
      session_destroy();
      Header('Location:index.php');
    }
  }



 ?>
