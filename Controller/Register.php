<?php
  include_once 'Controller/baseController.php';
  class Register extends Basecontroller
  {
    public function __construct()
    {
      parent::__construct();
    }

    public function checkemail(){

    }

    public function register($data){
          $user = $this->help->validation($data['user']);
          $fname = $this->help->validation($data['fname']);
          $lname = $this->help->validation($data['lname']);
          $email = $this->help->validation($data['email']);
          $password = $this->help->validation($data['password']);

          if(empty($user) || empty($fname) || empty($lname) || empty($email) || empty($password)){
            return 'empty';
          }
          else if(strlen($password) < 6){
            return 'smallpass';
          }
          else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return 'emailprob';
          }
          else{
            $password = md5($password);

            $sql = "INSERT INTO tbl_user(user,fname,lname, email, password) VALUES (:user,:fname,:lname,:email,:password)";
            $query = $this->db->link->prepare($sql);
            $query->bindValue(':user',$user);
            $query->bindValue(':fname',$fname);
            $query->bindValue(':lname',$lname);
            $query->bindValue(':email',$email);
            $query->bindValue(':password',$password);
            $insert = $query->execute();

            if($insert){
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
                Session::set('fname',$result->fname);
                Session::set('lname',$result->lname);
                Header('Location:index.php');
              }
              else{
                return 'nouser';
              }
            }
            else{
              return 'fail';
            }

          }

    }




    public function registerTenant($data){

          $fname = $this->help->validation($data['fname']);
          $lname = $this->help->validation($data['lname']);
          $email = $this->help->validation($data['email']);
          $password = $this->help->validation($data['password']);

          if(empty($fname) || empty($lname) || empty($email) || empty($password)){
            return 'empty';
          }
          else if(strlen($password) < 6){
            return 'smallpass';
          }
          else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return 'emailprob';
          }
          else{
            $password = md5($password);

            $sql = "INSERT INTO tbl_tenant(fname,lname, email, password) VALUES (:fname,:lname,:email,:password)";
            $query = $this->db->link->prepare($sql);
            $query->bindValue(':fname',$fname);
            $query->bindValue(':lname',$lname);
            $query->bindValue(':email',$email);
            $query->bindValue(':password',$password);
            $insert = $query->execute();

            if($insert){
              if(empty($email) || empty($password)){
                return 'empty';
              }
              else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                return 'emailprob';
              }
              else{
                $sql = "select * from tbl_tenant where email = :email and password = :password limit 1";
                $query = $this->db->link->prepare($sql);
                $query->bindValue(':email',$email);
                $query->bindValue(':password',$password);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_OBJ);

                if($result){
                  Session::set('login',true);
                  Session::set('user','tenant');
                  Session::set('email',$result->email);
                  Session::set('lname',$result->lname);
                  Session::set('fname',$result->fname);
                  Header('Location:index.php');
                }
                else{
                  return 'nouser';
                }

              }
            }
            else{
              return 'fail';
            }

          }

    }
  }

 ?>
