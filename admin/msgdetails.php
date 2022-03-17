<?php
	include 'inc/header.php';
		Session::checkAdmin();
	include 'inc/sidebar.php';
 ?>
<div class="main-panel">
<?php
	include 'inc/topnav.php';
?>

<?php
  if(isset($_GET['id'])){
    $result = $obj->mgsbyId($_GET['id']);
  }
 ?>


  <div class="content">
    <div class="container-fluid">
      <div class="card" style="padding: 20px 5px;">
        <div class="card-body" style="padding:10px;">
          <table class="msg_admin">
            <tr>
              <td style="padding:10px;">Form:</td>
              <td style="padding:10px;"><?php echo $result['email']; ?></td>
            </tr>
            <tr>
              <td style="padding:10px;">Message:</td>
              <td style="padding:10px;"> <?php echo $result['message']; ?> </td>
            </tr>
          </table>
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
