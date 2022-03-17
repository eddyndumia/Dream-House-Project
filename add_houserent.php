<?php
  include 'inc/header.php';
  include 'inc/navbar.php';
  include 'Controller/Homerent.php';
  Session::checkSession();
  if(Session::get('user') !== 'owner'){
    Header('Location:index.php');
  }
?>
  <div class="housearea">
    <div class= "housemain container">
      <div class="inner_house">
        <div class="title_house">
          <h3>Give details Your House</h3>


    <?php
      $homecon = new Homerent();
      if(($_SERVER["REQUEST_METHOD"] === "POST") && isset($_POST['fam_add_rent']) ){
        $result = $homecon->addRent($_POST,$_FILES);
      }

      if((isset($result)) && ($result=='success')){
        echo "<p class='alert alert-success alert-dismissible'>New House rent added successfully!</p>";
        $result = null;
      }
      else if((isset($result)) && ($result=='fail')){
        echo "<p class='alert alert-danger alert-dismissible'>There are problem to add this house rent now!</p>";
        $result = null;
      }
      else if((isset($result)) && ($result=='notfill')){
        echo "<p class='alert alert-danger alert-dismissible'>House address, House type and Rental value must be required!</p>";
        $result = null;
      }

      if(isset($_SESSION['extnum']) && $_SESSION['extnum'] > 0){
        if ($_SESSION['extnum'] == 1) {
          $img = 'image';
        }else{
          $img = 'images';
        }
        echo "<p class='alert alert-danger alert-dismissible'>".$_SESSION['extnum']."   ".$img." failed to add due to invalid extension ( use <strong>jpg, jpeg, gif or png</strong> file format. )!</p>";
        unset($_SESSION['extnum']);
        unset($_SESSION['sizenum']);
      }
      else if(isset($_SESSION['sizenum']) && $_SESSION['sizenum'] > 0){
        if ($_SESSION['sizenum'] == 1) {
          $imgs = 'image';
        }else{
          $imgs = 'images';
        }
        echo "<p class='alert alert-danger alert-dismissible'>".$_SESSION['sizenum']."   ".$imgs." failed to add due to the size.( use <strong>less than 10MB</strong> file format. )!</p>";
        unset($_SESSION['sizenum']);
        unset($_SESSION['extnum']);
      }


     ?>







        </div>
        <div class="form_main">
          <form enctype="multipart/form-data" class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="house_type from-group" style="margin-bottom:15px;">
              <select class="form-control" id="select_type" style="background-color:lavender;" name="house_type" required>
                <option value="" selected disabled>Rent Type</option>
                <option value="Family">Family</option>
                <option value="Bachelor">Bachelor</option>
                <option value="Sublet">Sub-Let</option>
                <option value="Mess/Hostel">Hostel/Mess</option>
              </select>
            </div>

            <div class="fam_bac_sub">
              <div class="fam_bac_sub_inner">
                <div class="address">
                  <input type="text" class="form-control" name="address" placeholder="House Address">
                </div>
                <div class="rent">
                  <label for="amount" style="margin-right:5px;">Rental Value :</label>

                  <div id="price_tab">
                    <ul>
                      <li class="fixeds"><a href="#fixed">Fixed Value</a></li>
                      <!-- <li class="ranges"><a href="#range">Ranged Value</a></li> -->
                    </ul>
                    <div id="fixed">
                      <label for="amount_fixed" style="font-weight:bold;color:coral;">$</label>
                      <input type="text" id="amount_fixed" name="rental_value" readonly style="border:0; color:#f6931f; font-weight:bold;">
                      <div id="slider-range-max" class="myrange" title="Tap left or right button to set more precise value."></div>
                    </div>
                    <!-- <div id="range">
                      <input type="text" id="amount" name="no" readonly style="border:0; color:#f6931f; font-weight:bold;">
                      <div id="slider-range" class="myrange" title="Tap left or right button to set more precise value."></div>
                    </div> -->
                  </div>

                </div>
                <div class="road">
                  <input type="text" class="form-control" name="road_no" placeholder="Road No">
                </div>
                <div class="house_no">
                  <input type="text" class="form-control" name="house_no" placeholder="House No">
                </div>
                <div class="floor">
                  <input type="text" class="form-control" name="floor" placeholder="Floor No">
                </div>
                <div class="bedroom">
                  <select class="form-control" name="bedroom">
                    <option hidden value="">Bedroom</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                  </select>
                </div>
                <div class="dinning">
                  <select class="form-control" name="dinning_room">
                    <option hidden value="">Dinning Room</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </div>
                <div class="kitchen">
                  <select class="form-control" name="kitchen">
                    <option hidden value="">Kitchen</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </div>
                <div class="balconies">
                  <select class="form-control" name="balconies">
                    <option value="" hidden>Balconies</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </div>
                <div class="bathrooms">
                  <select class="form-control" name="bathroom">
                    <option hidden value="">Bathrooms</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </div>


                <div class="image_input">
                  <p>Add image of your House(Optional and Maximum 3)<span class="hidden_plus_btn"> <i class="fas fa-plus"></i> </span></p>
                  <div class="inner_image_input">
                    <div class="main_input">
                      <input type="file" style="float:left;" class="form-control-file" name="img_1" placeholder="Add Image(Optional)">
                      <span class="plus_btn"> <i class="fas fa-plus"></i> </span>
                      <span class="minus"> <i class="fas fa-minus"></i> </span>
                    </div>
                  </div>
                </div>
                <div class="description">
                  <textarea class="form-control" rows="8" cols="80" placeholder="Description(Optional)" name="description"></textarea>
                </div>
                <p class="text-center" style="margin-top:10px;">
                  <input type="submit" style="margin-bottom:0px;" class="btn btn-info" name="fam_add_rent" value="Add For Rent">
                </p>
              </div>
            </div>

            <div class="mess">
              <div class="mess_inner">
                <div class="address">
                  <input type="text" class="form-control" name="" placeholder="House Address">
                </div>
                <div class="rent">
                    <label for="amount" style="margin-right:5px;">Rental Value :</label>

                    <div id="price_tab_mess">
                      <ul>
                        <li><a href="#fixed">Fixed Value</a></li>
                        <li><a href="#range">Ranged Value</a></li>
                      </ul>
                      <div id="fixed">
                        <label for="amount_mess" style="font-weight:bold;color:coral;">$</label>
                        <input type="text" id="amount_mess" readonly style="border:0; color:#f6931f; font-weight:bold;">
                        <div id="slider-range-mess" class="myrange" title="Tap left or right button to set more precise value."></div>
                      </div>
                      <div id="range">
                        <input type="text" id="amount_range_mess" readonly style="border:0; color:#f6931f; font-weight:bold;">
                        <div id="slider_range_formess" class="myrange" title="Tap left or right button to set more precise value."></div>
                      </div>
                    </div>
                </div>
                <div class="road">
                  <input type="text" class="form-control" name="" placeholder="Road No">
                </div>
                <div class="house_no">
                  <input type="text" class="form-control" name="" placeholder="House No">
                </div>
                <div class="floor">
                  <input type="text" class="form-control" name="" placeholder="Floor No">
                </div>
                <div class="kitchen">
                  <select class="form-control" name="">
                    <option selected disabled>kitchen Room</option>
                    <option value="">Yes</option>
                    <option value="">No</option>
                  </select>
                </div>
                <div class="balconies">
                  <select class="form-control" name="">
                    <option selected disabled>Balconies</option>
                    <option value="">Yes</option>
                    <option value="">No</option>
                  </select>
                </div>

                <div class="image_input">
                  <p>Add image of your House(Optional)<span class="hidden_plus_btn"> <i class="fas fa-plus"></i> </span></p>
                  <div class="inner_image_input">
                    <div class="main_input">
                      <input type="file" style="float:left;" class="form-control-file" name="image1" placeholder="Add Image(Optional)">
                      <span class="plus_btn"> <i class="fas fa-plus"></i> </span>
                      <span class="minus"> <i class="fas fa-minus"></i> </span>
                    </div>
                  </div>
                </div>
                <div class="description">
                  <textarea class="form-control" rows="8" cols="80" placeholder="Description(Optional)"></textarea>
                </div>
                <p class="text-center" style="margin-top:10px;">
                  <input type="submit" style="margin-bottom:0px;" class="btn btn-info" name="fam_add_rent" value="Add For Rent">
                </p>

              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>


<?php
  include 'inc/footer.php';
?>
