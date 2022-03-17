<?php
  include_once 'Controller/baseController.php';

  class Homecontroller extends Basecontroller
  {
    public function __construct()
    {
      parent::__construct();
    }

    public function gethomeDetails(){
      $sql = 'select * from tbl_house where active_status = :active_status order by id DESC';
      $query = $this->db->link->prepare($sql);
      $query->bindValue(':active_status',0);
      $query->execute();
      $result = $query->fetchAll();
      return $result;
    }

    public function gethomeDetailsbyowner($id)
    {
      $sql = 'select * from tbl_house where owner_id=:id order by id DESC';
      $query = $this->db->link->prepare($sql);
      $query->bindValue(':id',$id);
      $query->execute();
      $result = $query->fetchAll();
      return $result;
    }

    public function gethomeDetailsbyTenant($id)
    {
      $sql = 'select * from tbl_house where tenant_id=:id order by id DESC';
      $query = $this->db->link->prepare($sql);
      $query->bindValue(':id',$id);
      $query->execute();
      $result = $query->fetchAll();
      return $result;
    }

    public function gethomeDetails_obj($id){
      $sql = 'select * from tbl_house where id = :id';
      $query = $this->db->link->prepare($sql);
      $query->bindParam('id',$id,PDO::PARAM_INT);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_ASSOC);
      return $result;
    }

    public function searchHome($min,$max,$data)
    {
      $sql = "SELECT id,address,house_type,rental_value FROM tbl_house WHERE rental_value BETWEEN :min and :max and active_status = :active_status";
      // $sql = "SELECT * FROM tbl_house WHERE rental_value BETWEEN SUBSTRING_INDEX(`:min`,'-', 1) AND SUBSTRING_INDEX(`:max`,'-', -1)"

      $address = 0;
      $house_type = 0;
      if (isset($data['address']) && (strlen($data['address']) > 0)) {
        $sql = $sql.' and address = :address';
        $address = 1;
      }
      if (isset($data['house_type'])) {
        $sql = $sql.' and house_type = :house_type';
        $house_type = 1;
      }
      $query = $this->db->link->prepare($sql);
      $query->bindParam(':min', $min, PDO::PARAM_INT);
      $query->bindParam(':max', $max, PDO::PARAM_INT);
      if ($address == 1) {
        $query->bindParam(':address', $data['address'], PDO::PARAM_STR);
      }
      if ($house_type == 1) {
        $query->bindParam(':house_type', $data['house_type'], PDO::PARAM_STR);
      }
      $query->bindValue(':active_status',0);
      $query->execute();
      $result = $query->fetchAll();
      return $result;
    }

    public function sendrequest($houseid,$ownerid)
    {
      $tenantid = Session::get('user_id');
      $sql = "insert into tbl_rentrequest(house_id,tenant_id,owner_id) values(:house_id,:tenant_id,:owner_id)";
      $query = $this->db->link->prepare($sql);
      $query->bindValue(':house_id',$houseid);
      $query->bindValue(':tenant_id',$tenantid);
      $query->bindValue(':owner_id',$ownerid);
      $insert = $query->execute();
      if($insert){
        $msg = 'You got a rent request for this <a href="housedetails.php?house_id='.$houseid.'">home</a> from a tenant!';
        $sql = "insert into tbl_message(from_id,to_id,message) values(:from_id,:to_id,:message)";
        $query = $this->db->link->prepare($sql);
        $query->bindValue(':from_id',$tenantid);
        $query->bindValue(':to_id',$ownerid);
        $query->bindValue(':message',$msg);
        $query->execute();
        return 'req_success';
      }
    }

    public function checkrequest($houseid)
    {
      $tenantid = Session::get('user_id');

      $sql = "select tenant_id from tbl_house where id=:house_id";
      $query = $this->db->link->prepare($sql);
      $query->bindValue(':house_id',$houseid);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_ASSOC);
      if($result['tenant_id'] == $tenantid){
        return 'booked';
      }



      $sql = "select tenant_id from tbl_rentrequest where tenant_id=:tenant_id and house_id=:house_id";
      $query = $this->db->link->prepare($sql);
      $query->bindValue(':tenant_id',$tenantid);
      $query->bindValue(':house_id',$houseid);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_ASSOC);
      if( is_array($result) && count($result) > 0){
        return 'yes';
      }else{
        return 'no';
      }
    }

    public function cancelrequest($houseid,$ownerid)
    {
      $tenantid = Session::get('user_id');
      $sql = "delete from tbl_rentrequest where house_id=:house_id and tenant_id=:tenant_id and owner_id=:owner_id";
      $query = $this->db->link->prepare($sql);
      $query->bindValue(':house_id',$houseid);
      $query->bindValue(':tenant_id',$tenantid);
      $query->bindValue(':owner_id',$ownerid);
      $query->execute();
    }

    public function totalRequest($houseid)
    {
      $sql = "select * from tbl_rentrequest where house_id=:house_id";
      $query = $this->db->link->prepare($sql);
      $query->bindValue(':house_id',$houseid);
      $query->execute();
      $result = $query->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }

    public function getUser($id)
    {
      $sql = "select * from tbl_user where id=:id";
      $query = $this->db->link->prepare($sql);
      $query->bindParam('id',$id,PDO::PARAM_INT);
      $query->execute();
      $result = $query->fetchObject(__CLASS__);
      return $result;
    }
    public function updateUser($id,$data,$files)
    {
      $sizenum = 0;
      $extnum = 0;

      $permited = array('jpg', 'jpeg', 'png', 'gif');
      if(isset($files['profile_img'] ) && $files['profile_img']['name'] != '') {

          $file_name = $files['profile_img']['name'];
          $file_size = $files['profile_img']['size'];
          $file_temp = $files['profile_img']['tmp_name'];

          $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

          if ($file_size>(10*1024*1024)){
              $sizenum++;
              Session::set('sizenum',$sizenum);
              $uploaded_image='';
          }
          else if(in_array($file_ext, $permited) === false) {
              $extnum++;
              Session::set('extnum',$extnum);
              $uploaded_image='';
          }
          else{
              $unique_image = substr(md5(microtime()), 0, 10) . '.' . $file_ext;
              $uploaded_image = "uploads/profile/" . $unique_image;
              move_uploaded_file($file_temp, $uploaded_image);

              $sql = "update tbl_user set fname=:fname, lname=:lname, address=:address, phone_number=:phone_number, nid=:nid, description=:description,pic=:pic where id=:id";
              $query = $this->db->link->prepare($sql);
              $query->bindParam('fname',$data['fname'],PDO::PARAM_STR);
              $query->bindParam('lname',$data['lname'],PDO::PARAM_STR);
              $query->bindParam('address',$data['address'],PDO::PARAM_STR);
              $query->bindParam('phone_number',$data['phone_number'],PDO::PARAM_STR);
              $query->bindParam('nid',$data['nid'],PDO::PARAM_INT);
              $query->bindParam('description',$data['description'],PDO::PARAM_STR);
              $query->bindParam('pic',$uploaded_image,PDO::PARAM_STR);
              $query->bindParam('id',$id,PDO::PARAM_INT);
              $query->execute();
          }
      }
      else{
        print_r($data);
        print_r($id);
        print_r($files);
        $sql = "update tbl_user set fname=:fname, lname=:lname, address=:address, phone_number=:phone_number, nid=:nid, description=:description where id=:id";
        $query = $this->db->link->prepare($sql);
        $query->bindParam('fname',$data['fname'],PDO::PARAM_STR);
        $query->bindParam('lname',$data['lname'],PDO::PARAM_STR);
        $query->bindParam('address',$data['address'],PDO::PARAM_STR);
        $query->bindParam('phone_number',$data['phone_number'],PDO::PARAM_STR);
        $query->bindParam('nid',$data['nid'],PDO::PARAM_INT);
        $query->bindParam('description',$data['description'],PDO::PARAM_STR);
        $query->bindParam('id',$id,PDO::PARAM_INT);
        $query->execute();
      }


    }

    public function acceptrequest($houseid,$tenants_id)
    {
      $act_st = 1;
      $sql = "update tbl_house set tenant_id=:tenant_id,active_status=:active_status  where id = :house_id";
      $query = $this->db->link->prepare($sql);
      $query->bindValue(':tenant_id',$tenants_id);
      $query->bindValue(':active_status',$act_st);
      $query->bindValue(':house_id',$houseid);

      $query->execute();

      $ownerid = Session::get('user_id');
      $msg = 'Your booked request for this <a href="housedetails.php?house_id='.$houseid.'">house</a> is accepted by the owner!';
      $sql = "insert into tbl_message(from_id,to_id,message) values(:from_id,:to_id,:message)";
      $query = $this->db->link->prepare($sql);
      $query->bindValue(':from_id',$ownerid);
      $query->bindValue(':to_id',$tenants_id);
      $query->bindValue(':message',$msg);
      $query->execute();
    }

    public function rejectrequest($houseid,$tenants_id)
    {
      $sql = "delete from tbl_rentrequest where house_id = :house_id and tenant_id=:tenant_id";
      $query = $this->db->link->prepare($sql);
      $query->bindValue(':house_id',$houseid);
      $query->bindValue(':tenant_id',$tenants_id);
      $query->execute();

      $ownerid = Session::get('user_id');
      $msg = 'Your booked request for this <a href="housedetails.php?house_id='.$houseid.'">house</a> is rejected by the owner!';
      $sql = "insert into tbl_message(from_id,to_id,message) values(:from_id,:to_id,:message)";
      $query = $this->db->link->prepare($sql);
      $query->bindValue(':from_id',$ownerid);
      $query->bindValue(':to_id',$tenants_id);
      $query->bindValue(':message',$msg);
      $query->execute();
    }

    public function freeHome($houseid)
    {
      $sql = "update tbl_house set tenant_id=:tenant_id, active_status = :active_status where id=:house_id";
      $query = $this->db->link->prepare($sql);
      $query->bindValue(':tenant_id',0);
      $query->bindValue(':active_status',0);
      $query->bindValue(':house_id',$houseid);
      $query->execute();
    }

    public function deletehouse($ids,$ownerid){
      echo 'This is test = '.$ids.' '.$ownerid;
      $sql = "delete from tbl_house where id =:id";
      $query = $this->db->link->prepare($sql);
      $query->bindValue(':id',$ids);
      $query->execute();
      Header("location:http://localhost/houserent/owner_profile.php?id=".$ownerid);
    }

  }
