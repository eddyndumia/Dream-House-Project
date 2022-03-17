<?php
include_once 'admincontroller/Login.php';
include_once '../lib/Session.php';
Session::init();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<style>
  input{
    margin-bottom: 15px;
  }
  form{
    margin: 0px auto;
    width: 460px;
    background-color: aliceblue;
    padding: 10px;
    margin-top: 100px;
    box-shadow: 0px 0px 5px 1px grey;
  }
  .house_image{
    width: 320px;
    height: 280px;
    margin: 0px auto;
  }
  .house_image img{
    width: 100%;
    height: 100%;
  }
  body{
    background-color: lightgray;
  }
  .login_main{
    padding-top: 20px;
  }
</style>
<script>
  if(window.history.replaceState){
    window.history.replaceState( null, null, window.location.href );
  }
</script>
<body>
  <div class="main">
    <div class="login_area">
      <div class="login_main container">


<?php
    $login = new Login();
    if(($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['login'])) {
      $msg = $login->login($_POST['username'],$_POST['password']);
    }

    if((isset($msg)) && ($msg=='nouser')){
      echo "<p class='alert alert-danger'>No User Found!</p>";
      $msg = null;
    }
    else if((isset($msg)) && ($msg=='empty')){
      echo "<p class='alert alert-danger'>Fill all the Field please!</p>";
      $msg = null;
    }

 ?>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="house_image">
            <img src="../assets/images/loginhouse.png" alt="">
          </div>
          <div class="main_input">
            <input type="text" name="username" class="form-control" value="" placeholder="Username">
            <input type="text" name="password" class="form-control" value="" placeholder="Password">
            <p class="text-center"><input type="submit" class="btn btn-success" name="login" class="from-control" value="Login"></p>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="../assets/js/jquery.min.js" charset="utf-8"></script>
  <script src="../assets/js/bootstrap.min.js" charset="utf-8"></script>
</body>
</html>
