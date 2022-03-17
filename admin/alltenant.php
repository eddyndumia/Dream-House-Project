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
  $owner = new Tenant();
  $alluser = $owner->alltenant();
 ?>

  <div class="content">
    <div class="container-fluid">
      <div class="card" style="padding: 20px 5px;">
        <div class="card-body">
          <table id="table_id" class="display">
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Name</th>
                    <th>Gmail</th>
                    <th>address</th>
                    <th>View</th>
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
                    <td><?php echo $user['fname'].' '.$user['lname']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td style="padding-left:75px;"><?php echo $user['address']; ?></td>
                    <td> <a class="btn btn-info" href="tenantdetails.php?id=<?php echo $user['id']; ?>" >view</a> </td>
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
