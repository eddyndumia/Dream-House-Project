<?php
  include_once 'admincontroller/Admincontroller.php';

  class Others extends Admincontroller
  {
    public function __construct()
    {
      parent::__construct();
    }

    public function getMessage()
    {
      $read = 0;
      $sql = "select * from tbl_adminmsg where readmsg=:read";
      $query = $this->db->link->prepare($sql);
      $query->bindValue(':read',$read);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function mgsbyId($id)
    {
      $read = 0;
      $sql = "select * from tbl_adminmsg where id=:id";
      $query = $this->db->link->prepare($sql);
      $query->bindValue(':id',$id);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_ASSOC);

      $sql = "update tbl_adminmsg set readmsg=:one where id=:id";
      $query = $this->db->link->prepare($sql);
      $query->bindValue(':one',1);
      $query->bindValue(':id',$id);
      $query->execute();

      return $result;

    }

    public function countmsg()
    {
      $read =0;
      $sql = "select count(*) as msg_num from tbl_adminmsg where readmsg=:read";
      $query = $this->db->link->prepare($sql);
      $query->bindValue(':read',$read);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_ASSOC);
      return $result;
    }

    public function countowner()
    {
      $type = 'owner';
      $sql = "select count(*) as owner from tbl_user where user=:user";
      $query = $this->db->link->prepare($sql);
      $query->bindValue(':user',$type);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_ASSOC);
      return $result;
    }

    public function counttenant()
    {
      $type = 'tenant';
      $sql = "select count(*) as tenant from tbl_user where user=:user";
      $query = $this->db->link->prepare($sql);
      $query->bindValue(':user',$type);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_ASSOC);
      return $result;
    }

    public function countall()
    {
      $sql = "select count(*) as alls from tbl_user";
      $query = $this->db->link->prepare($sql);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_ASSOC);
      return $result;
    }


  }

 ?>
