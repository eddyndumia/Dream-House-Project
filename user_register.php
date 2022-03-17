<?php
  include 'inc/header.php';
  include 'inc/navbar.php';
  include 'Controller/Register.php';
?>


<div class="register_area">
  <div class="register_main container">
    <?php
      $reg = new Register();
      if(($_SERVER["REQUEST_METHOD"] === "POST") && isset($_POST['register'])) {
        $msg = $reg->register($_POST);
      }


      if((isset($msg)) && ($msg=='success')){
        echo "<p class='alert alert-success'>You registered Successfully!</p>";
        $msg = null;
      }
      else if((isset($msg)) && ($msg=='fail')){
        echo "<p class='alert alert-danger'>Unfortunately Not Registered!</p>";
        $msg = null;
      }
      else if((isset($msg)) && ($msg=='empty')){
        echo "<p class='alert alert-danger'>Fill all the Field please!</p>";
        $msg = null;
      }
      else if((isset($msg)) && ($msg=='smallpass')){
        echo "<p class='alert alert-danger'>Password length must be 6 or more characters!</p>";
        $msg = null;
      }
      else if((isset($msg)) && ($msg=='emailprob')){
        echo "<p class='alert alert-danger'>Email Format is Invalid!</p>";
        $msg = null;
      }

   ?>



    <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="house_pic">
        <img src="assets/images/house.jpg" alt="">
      </div>
      <div class="reg_title">
        <p class="text-center">Register</p>
      </div>
      <select class="form-control" id="reg_as" name="user" style="margin-top:10px;background-color:lavender;" required="true">
        <option value="" hidden>Register As</option>
        <option value="1">Owner</option>
        <option value="2">Tenant</option>
      </select>
      <input type="text" class="form-control" name="fname" placeholder="First Name">
      <input type="text" class="form-control" name="lname" placeholder="Last Name">
      <input type="text" class="form-control" name="email" placeholder="Email">
      <input type="password" name="password" class="form-control" placeholder="Password">
      <p class="text-right clear"> <input type="submit" class="btn btn-primary loginbtn" name="register" value="Register"> </p>
      <p class="text-center"> Already a member? <a href="user_login.php"> Sign In! </a></p>
    </form>
  </div>
</div>

<?php
  include 'inc/footer.php';
 ?>
