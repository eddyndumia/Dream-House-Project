<?php
  include_once 'Controller/baseController.php';

  class Message extends Basecontroller
  {
    public function __construct()
    {
      parent::__construct();
    }

    public function getMessage($id)
    {
      $sql = "select * from tbl_message where to_id=:id and read_message=:read_message order by id DESC";
      $query = $this->db->link->prepare($sql);
      $query->bindValue(':id',$id);
      $query->bindValue(':read_message',0);
      $query->execute();
      $result = $query->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }
    public function tempDelmsg($id,$msgid)
    {
      $sql = "update tbl_message set read_message=:read_message where to_id=:to_id and id=:id";
      $query = $this->db->link->prepare($sql);
      $query->bindValue(':read_message',1);
      $query->bindValue(':to_id',$id);
      $query->bindValue(':id',$msgid);
      $query->execute();

      Header('Location:'.Session::get('path'));
    }


    public function adminmsg($value)
    {
      $email = $value['email'];
      $message = $value['message'];
      $sql = "insert into tbl_adminmsg(email,message) values(:email,:message)";
      $query = $this->db->link->prepare($sql);
      $query->bindValue(':email',$email);
      $query->bindValue(':message',$message);
      $query->execute();
    }

  }
 ?>
