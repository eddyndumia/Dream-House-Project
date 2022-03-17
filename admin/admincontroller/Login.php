<?php
  include_once 'admincontroller/Admincontroller.php';

  class Login extends Admincontroller
  {
    public function __construct()
    {
      parent::__construct();
    }

    public function login($sndusername,$sndpassword){
          $username = $this->help->validation($sndusername);
          $password = $this->help->validation($sndpassword);

          if(empty($username) || empty($password)){
            return 'empty';
          }
          else{
            $password = md5($password);

            $sql = "select * from tbl_admin where username = :username and password = :password limit 1";
            $query = $this->db->link->prepare($sql);
            $query->bindValue(':username',$username);
            $query->bindValue(':password',$password);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_OBJ);

            if($result){
              Session::set('login',true);
              Session::set('user','admin');
              Session::set('user_id',$result->id);
              Session::set('email',$result->email);
              Session::set('username',$result->username);
              Header('Location:index.php');
            }
            else{
              return 'nouser';
            }

          }

    }
  }

 ?>
