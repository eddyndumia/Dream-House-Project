<?php
  include_once 'Controller/baseController.php';

  class Login extends Basecontroller
  {
    public function __construct()
    {
      parent::__construct();
    }

    public function login($sndemail,$sndpassword){
          $email = $this->help->validation($sndemail);
          $password = $this->help->validation($sndpassword);

          if(empty($email) || empty($password)){
            return 'empty';
          }
          else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return 'emailprob';
          }
          else{
            $password = md5($password);

            $sql = "select * from tbl_user where email = :email and password = :password limit 1";
            $query = $this->db->link->prepare($sql);
            $query->bindValue(':email',$email);
            $query->bindValue(':password',$password);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_OBJ);

            if($result){
              Session::set('login',true);
              Session::set('user',$result->user);
              Session::set('user_id',$result->id);
              Session::set('email',$result->email);
              Session::set('lname',$result->lname);
              Session::set('fname',$result->fname);
              if (Session::get('path')) {
                Header('Location:'.Session::get('path'));
              }
              else{
                Header('Location:index.php');
              }
            }
            else{
              return 'nouser';
            }

          }

    }
  }

 ?>
