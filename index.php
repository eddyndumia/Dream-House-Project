<?php

  include 'inc/header.php';
  include 'Controller/Message.php';
  $msg = new Message();

  if(isset($_POST['sendmsg'])){
    $result = $msg->adminmsg($_POST);
  }

  include 'inc/navbar.php';
  include 'inc/cover.php';
  include 'inc/about.php';
  include 'inc/contact.php';
  include 'inc/footer.php';
 ?>
 <script>
 $(function(){
   $( "#main_range_cover" ).slider({
         range: true,
         min: 100,
         max: 100000,
         values: [<?php if(isset($range1) && isset($range2)){
           echo $range1.','.$range2;}
           else{?> 100,100000 <?php } ?>],
         slide: function( event, ui ) {
           $( "#input_range_cover" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
         }
    });
    $( "#input_range_cover" ).val( "$" + $( "#main_range_cover" ).slider( "values", 0 ) +
     " - $" + $( "#main_range_cover" ).slider( "values", 1 ) );
   });
 </script>
