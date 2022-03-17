<?php
	include 'inc/header.php';
	Session::checkAdmin();
	include 'inc/sidebar.php';
 ?>
 <?php
 if (isset($_POST['logout'])) {
   Session::sessionDestroyadmin();
 }
  ?>
<div class="main-panel">
<?php
	include 'inc/topnav.php';
	include 'inc/main_content.php';
	include 'inc/footer.php';
 ?>
</div>
<?php
	include 'inc/jsarea.php';
 ?>
