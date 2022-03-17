<?php include 'admincontroller/others.php'; ?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar bar1"></span>
                <span class="icon-bar bar2"></span>
                <span class="icon-bar bar3"></span>
            </button>
            <a class="navbar-brand" href="index.php">Dashboard</a>
        </div>

<?php
$obj = new Others();
$result = $obj->getMessage();
$msgcount = $obj->countmsg();

 ?>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="ti-bell"></i>
                            <p class="notification"><?php echo $msgcount['msg_num']; ?></p>
                        <p>Notifications</p>
                        <b class="caret"></b>
                      </a>
                      <ul class="dropdown-menu">
                        <?php if(count($result) > 0 ){
                          foreach ($result as $msg) {
                        ?>
                          <li><a href="msgdetails.php?id=<?php echo $msg['id']; ?>" ><?php echo $msg['message']; ?></a></li>
                        <?php } }else{ ?>
                          <li>No new message!</li>
                        <?php } ?>
                      </ul>
                </li>

                <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="ti-user"></i>
                        <p><?php echo Session::get('username'); ?></p>
                        <b class="caret"></b>
                      </a>
                      <ul class="dropdown-menu">
                        <li>
                          <form class="text-center" action="index.php" method="post">
                          <input style="border:none;" class="btn" type="submit" name="logout" value="logout">
                          </form>
                        </li>
                      </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>
