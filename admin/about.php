<?php
	include 'inc/header.php';
		Session::checkAdmin();
	include 'inc/sidebar.php';
 ?>
<div class="main-panel">
<?php
	include 'inc/topnav.php';
?>



  <div class="content">
    <div class="container-fluid">
      <div class="card" style="padding: 20px 5px;">
        <div class="card-body" style="padding:10px;">
          <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <textarea style="background-color:#fff;border:1px solid black; margin-bottom:10px;height:500px;" class="form-control" name="about"></textarea>
            <input type="submit" class="btn btn-primary" name="about" value="Update About">
          </form>
        </div>
      </div>
    </div>
  </div>

 <?php
	include 'inc/footer.php';
 ?>
</div>
<?php
	include 'inc/jsarea.php';
 ?>
