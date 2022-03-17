<?php
	include 'inc/header.php';
		Session::checkAdmin();
	include 'inc/sidebar.php';
 ?>
<div class="main-panel">
<?php
	include 'inc/topnav.php';
	include 'Admincontroller/Tenant.php';
?>

<?php
  $tenant = new Tenant();
  $alluser = $tenant->getMessage();

  if (isset($_POST['id'])) {
    $tenant->delmessage($_POST['id']);
  }
 ?>

  <div class="content">
    <div class="container-fluid">
      <div class="card" style="padding: 20px 5px;">
        <div class="card-body">
          <table id="table_id" class="display">
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
              <?php
                if($alluser){
                  $i = 0;
                  foreach($alluser as $user){
                    $i++;
               ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $user['from_id']; ?></td>
                    <td><?php echo $user['to_id']; ?></td>
                    <td style="padding-left:75px;"><?php echo $user['message']; ?></td>
                    <td>
                      <form class="" action="allmessage.php" method="post">
												<input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                        <input class="btn btn-danger" type="submit" name="delmsg" value="Delete">
                      </form>
                    </td>
                </tr>
              <?php } }else{ echo "<p>There is no user!</p>"; } ?>
            </tbody>
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
