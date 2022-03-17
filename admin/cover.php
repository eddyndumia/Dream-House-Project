<?php
	include 'inc/header.php';
		Session::checkAdmin();
	include 'inc/sidebar.php';
 ?>
<div class="main-panel">
<?php
	include 'inc/topnav.php';
	//include 'Admincontroller/eliment.php';
?>

<?php

 ?>

  <div class="content">
    <div class="container-fluid">
      <div class="card" style="padding: 20px 5px;">
        <div class="card-body" style="padding:10px;">
          <h3>Present Cover</h3>
          <div class="img_cover">
            <img src="" alt="">
          </div>
          <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input style="margin:20px 0px;" type="file" class="form-control" name="cover">
            <input style="margin-top:10px;" type="submit" class="btn btn-primary" name="cover" value="Update Cover">
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
