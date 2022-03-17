<?php
  include 'inc/header.php';
  if(Session::get('login')==true && (Session::get('user') == 'owner' || Session::get('user') == 'tenant')) {
    Header('Location:index.php');
  }
  include 'inc/navbar.php';
  include 'Controller/Login.php';
?>



<div class="register_area">
  <div style="padding:40px 0px;min-height:600px;" class="register_main container">

    <?php
      $login = new Login();
      if(($_SERVER["REQUEST_METHOD"] === "POST") && isset($_POST['login'])) {
        $msg = $login->login($_POST['email'],$_POST['password']);
      }

      if((isset($msg)) && ($msg=='nouser')){
        echo "<p class='alert alert-danger'>No User Found!</p>";
        $msg = null;
      }
      else if((isset($msg)) && ($msg=='empty')){
        echo "<p class='alert alert-danger'>Fill all the Field please!</p>";
        $msg = null;
      }
      else if((isset($msg)) && ($msg=='emailprob')){
        echo "<p class='alert alert-danger'>Email Format is Invalid!</p>";
        $msg = null;
      }

   ?>

    <form class="" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
      <div class="house_pic">
        <img src="assets/images/house.jpg" alt="">
      </div>
      <div class="login_title">
        <p class="text-center">Login</p>
      </div>
      <input type="email" class="form-control" name="email" placeholder="Email">
      <input type="password" name="password" class="form-control" placeholder="Password">
      <p class="text-right clear"> <input type="submit" class="btn btn-primary loginbtn" name="login" value="Login"> </p>
      <p class="text-center"> Not a member? <a href="user_register.php"> Sign Up ! </a></p>
    </form>
  </div>
</div>


<?php
  include 'inc/footer.php';
 ?>
