<?php
  include 'inc/header.php';
  include 'inc/navbar.php';
  include 'Controller/Homecontroller.php';
  Session::checkSession();
?>
<?php
  $home = new Homecontroller();
  $id=0;
  if(isset($_GET['owner_id'])){
    $id = $_GET['owner_id'];
  }
  $user = $home->getUser($id);
 ?>

<div class="profile_area">
  <div class="profile_main container">
    <div class="inner_profile row">
      <div class="left_profile col-sm-3">
        <div class="left_profile_inner">
          <div class="profile_title">
            <div class="profile_image">
              <img src="<?php
               if(isset($user->pic) && $user->pic != ''){echo $user->pic;}else{ echo 'assets/images/owner.png'; } ?>" class="img-thumbnail" alt="Owner">
            </div>
            <p class="text-center"> <i class="fas fa-user" style="margin-right:5px;"></i> <?php if(isset($user->fname)) echo $user->fname;if(isset($user->lname)) echo ' '.$user->lname; ?> </p>
          </div>
          <div class="profile_nav">
            <ul class="main_profile_nav">
              <li> <i class="fas fa-envelope"></i> <strong>Email:</strong> <?php if(isset($user->email)) echo $user->email; ?> </li>
              <li> <i class="fas fa-phone"></i> <strong>Phone:</strong> <?php if(isset($user->phone_number)) echo $user->phone_number; ?> </li>
              <li> <i class="fas fa-address-card"></i> <strong>Address:</strong> <?php if(isset($user->address)) echo $user->address; ?> </li>
              <li> <i class="fas fa-id-card-alt"></i> <strong>NID:</strong> <?php if(isset($user->nid)) echo $user->nid; ?> </li>
              <li> <i class="fas fa-angle-double-right"></i> <strong>Description:</strong> <p class="text-justify"><?php if(isset($user->description)) echo $user->description; ?></p> </li>
            </ul>

            <?php
              if(Session::get('user_id') == $id){
             ?>

            <ul class="extra_nav">
              <!-- <li style="margin:20px 0px;"> <a class="btn btn-info" href="">Your Tenent List</a> </li> -->
              <li> <a class="btn btn-primary" href="editprofile.php?id=<?php echo Session::get('user_id'); ?>">Edit Profile</a> </li>
            </ul>
          <?php } ?>
          </div>
        </div>
      </div>
      <div class="right_profile col-sm-9">
        <div class="right_profile_inner">
          <div class="house_main">
            <div class="available_house col-sm-12">
              <h4>Your Home List</h4>

<?php
  $home = new Homecontroller();

  $ava_home = $home->gethomeDetailsbyowner($id);
 ?>


              <div class="all_house row">

      <?php
      if(count($ava_home) > 0) {
        foreach ($ava_home as $house){
        $houseid = $house['id'];
        $total_req = $home->totalRequest($houseid);
       ?>

                <div class="single_house card">
                  <div class="single_house_inner card-body">
                    <div class="house_title">
                      <p style="font-weight:600;">  <i class="fas fa-map-marker-alt"></i> <?php echo $house['address']; ?> </p>
                      <p class="rent"> <i class="fas fa-money-check-alt"></i> <?php echo $house['rental_value']; ?> </p>
                    </div>
                    <div class="house_img">
                      <img src="assets/images/house/house29.png" alt="House">
                    </div>
                    <?php
                      if ($house['active_status'] == 1) {
                        $getuser = $home->getUser($house['tenant_id']);
                    ?>
                      <p style="overflow:hidden;">Booked By <a href="tenant_profile.php?tenant_id=<?php echo $getuser->id; ?>" target="_blank" style="font-weight:strong;margin:0px;float:none;border:none;"><?php echo $getuser->fname.' '.$getuser->lname; ?></a> </p>
                    <?php
                      }else if(is_array($total_req) && count($total_req) > 0){ ?>
                    <p style="display:inline-block;margin-top:10px;padding:4px 6px;color:#fff;border-radius:3px;background-color:cornflowerblue;"><span style="margin-left:5px;" class="badge badge-light"> <?php echo count($total_req); ?></span> request !</p>
                  <?php } ?>
                    <a href="housedetails.php?house_id=<?php echo $house['id']; ?>">Details</a>
                  </div>
                </div>


        <?php } }else{ echo "You havn't any availabe/free room."; } ?>


              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
  include 'inc/footer.php';
?>
