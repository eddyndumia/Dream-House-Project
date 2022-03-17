<?php
  include 'inc/header.php';
  include 'inc/navbar.php';
  include 'Controller/Homecontroller.php';
 ?>

<div class="housedetails_area">
  <div class="housedetails_main container">
    <div class="housedetails_inner row">


<?php
  $home = new Homecontroller();
  if(isset($_GET['house_id'])){
    $id = $_GET['house_id'];
  }
  $house = $home->gethomeDetails_obj($id);
  $houseid = $house['id'];

  $ownerid = $house['owner_id'];
  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['free_home'])){
    $req = $home->freeHome($houseid);
    echo "<meta http-equiv='refresh' content='0'>";
  }
 ?>


 <?php
   if(($_SERVER["REQUEST_METHOD"] === "POST") && isset($_POST['delhouse'])){
     $home->deletehouse($houseid,Session::get('user_id'));
   }
  ?>

      <div class="house_slider col-sm-6">
        <div class="house_slider_inner">
          <div class="all_house_slider">
            <?php if($house['img_1'] != ''){?>
            <div class="single_house_slider">
              <img src="<?php echo $house['img_1']; ?>" alt="">
            </div>
            <?php } ?>
            <?php if($house['img_2'] != ''){?>
            <div class="single_house_slider">
              <img src="<?php echo $house['img_2']; ?>" alt="">
            </div>
            <?php } ?>
            <?php if($house['img_3'] != ''){?>
            <div class="single_house_slider">
              <img src="<?php echo $house['img_3']; ?>" alt="">
            </div>
            <?php } ?>
          </div>
          <div class="house_description">
            <p class="text-justify"><?php echo $house['description']; ?></p>
          </div>
        </div>
      </div>
      <div class="house_details col-sm-4">
        <div class="house_details_inner">
          <table>
            <tr>
              <td> <strong>Type:</strong> </td>
              <td> <?php echo $house['house_type']; ?> </td>
            </tr>
            <tr>
              <td> <strong>Rental value:</strong> </td>
              <td> <?php echo $house['rental_value']; ?> </td>
            </tr>
            <tr>
              <td> <strong>Address:</strong> </td>
              <td><?php echo $house['address']; ?></td>
            </tr>
            <tr>
              <td> <strong>Road no:</strong> </td>
              <td> <?php echo $house['road_no']; ?> </td>
            </tr>
            <tr>
              <td> <strong>House no:</strong> </td>
              <td> <?php echo $house['house_no']; ?> </td>
            </tr>
            <tr>
              <td> <strong>Floor:</strong> </td>
              <td> <?php echo $house['floor']; ?> </td>
            </tr>
            <tr>
              <td> <strong>Bedroom:</strong> </td>
              <td> <?php echo $house['bedroom']; ?> </td>
            </tr>
            <tr>
              <td> <strong>Bathroom:</strong> </td>
              <td> <?php echo $house['bathroom']; ?> </td>
            </tr>
            <tr>
              <td> <strong>Dinning room:</strong> </td>
              <td> <?php echo $house['dinning_room']; ?> </td>
            </tr>
            <tr>
              <td> <strong>Kitchen:</strong> </td>
              <td> <?php echo $house['kitchen']; ?> </td>
            </tr>
            <tr>
              <td> <strong>balconies:</strong> </td>
              <td> <?php echo $house['balconies']; ?> </td>
            </tr>
          </table>
        </div>
      </div>
      <div class="action_area col-sm-2">
        <div class="action_main">

          <?php
            $total_req = $home->totalRequest($houseid);

            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accept'])) {
              $tenants_id = $_POST['tenant_id'];
              $req = $home->acceptrequest($houseid,$tenants_id);
              echo "<meta http-equiv='refresh' content='0'>";
            }
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reject'])) {
              $tenants_id = $_POST['tenant_id'];
              $req = $home->rejectrequest($houseid,$tenants_id);
              echo "<meta http-equiv='refresh' content='0'>";
            }
           ?>
          <?php if($house['owner_id'] == Session::get('user_id')){ ?>


          <div class="single_action">

            <?php
              if( $house['tenant_id'] != 0) {
                $tenant = $home->getUser($house['tenant_id']);
             ?>
             <div class="dropdown">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                  Booked by <a href="tenant_profile.php?tenant_id=<?php echo $tenant->id; ?>" target="_blank" ><?php echo $tenant->fname.' '.$tenant->lname; ?></a>
                </button>
                <div style="left:45px !important;" class="dropdown-menu">
                  <form class="dropdown-item" action="<?php echo $_SERVER['PHP_SELF'].'?house_id='.$house['id'];?>" method="post">
                    <input style="cursor:pointer;" type="submit" class="btn btn-default" name="free_home" value="Free">
                  </form>
                </div>
              </div>
            <?php }else{?>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                Booked request<span style="margin-left:5px;" class="badge badge-light"><?php if(is_array($total_req)){echo count($total_req);} ?></span>
              </button>
            <?php } ?>



              <form action="<?php echo $_SERVER['PHP_SELF'].'?house_id='.$houseid; ?>" method="post" style="margin-top:10px;">
                <input type="submit" class="btn btn-danger" onclick="return confirm('Are you Sure to Delete?');" name="delhouse" value="Delete This House">
              </form>



              <!-- The Modal -->
              <div style="top:200px;z-index:9999999999;" class="modal fade" id="myModal">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">All requested for this home.</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                      <?php
                        if (count($total_req)>0) {
                          foreach ($total_req as $request) {
                            $tenant = $home->getUser($request['tenant_id']);
                       ?>
                      <form class="" action="<?php echo $_SERVER['PHP_SELF'].'?house_id='.$house['id'];?>" method="post">
                        <div class="row">
                          <p style="padding-top:5px;" class="col-sm-6"> <a href="tenant_profile.php?tenant_id=<?php echo $tenant->id; ?>" target="_blank" > <?php echo $tenant->fname.' '.$tenant->lname; ?></a></p>
                          <input type="hidden" name="tenant_id" value="<?php echo $tenant->id; ?>">
                          <!-- <div class="profile_btn col-sm-2 ">
                            <a style="width:90%;color:#fff;cursor:pointer;" class="btn btn-info">Profile</a>
                          </div> -->
                          <div class="accept_btn col-sm-2 ">
                            <input style="width:90%;" class="btn btn-success" type="submit" name="accept" value="Accept">
                          </div>
                          <div class="reject_btn col-sm-2">
                            <input style="width:90%;" class="btn btn-danger" type="submit" name="reject" value="reject">
                          </div>
                        </div>
                      </form>
                      <?php
                        } }
                       ?>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        <?php } ?>


<?php
  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['request'])) {
    $req = $home->sendrequest($houseid,$ownerid);
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancel'])) {
    $cancel = $home->cancelrequest($houseid,$ownerid);
  }
  $check = $home->checkrequest($houseid);
 ?>


<?php if(Session::get('user') == 'tenant'){ ?>
          <div class="single_action">
            <form class="" action="<?php echo $_SERVER['PHP_SELF'].'?house_id='.$house['id'];?>" method="post">
              <?php
                if ($check=='no') {
               ?>
              <input type="submit" class="btn btn-primary" name="request" value="Request for rent">
            <?php }else if($check=='yes'){ ?>
              <input type="submit" class="btn btn-danger" name="cancel" value="Cancel Booked">
            <?php }else if($check=='booked'){ ?>
                <p class="btn btn-primary">Booked by You</p>
            <?php } ?>
            </form>
          </div>

          <div class="single_action">
            <a class="btn btn-info" href="owner_profile.php?owner_id=<?php echo $house['owner_id']; ?>">Contact to owner</a>
          </div>
<?php } else if(!Session::get('user') == 'owner'){ ?>

  <div class="single_action">
    <a class="btn btn-info" onclick="loginpage(<?php echo $house['id']; ?>);">Contact to owner</a>
  </div>
<?php } ?>
<script>
  function loginpage($id){
    <?php
        Session::set('path',"housedetails.php?house_id=".$id);
     ?>
     window.location = "user_login.php";

  }
</script>

        </div>
      </div>
    </div>
  </div>
</div>

<?php
  include 'inc/footer.php';
 ?>
