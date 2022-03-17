<div class="contact_area" id="contact">
  <div class="contact_main container">
    <?php $h='2px'; $title = 'Contact';include 'inc/heading_title.php';?>
    <div class="contact">
      <form class="" action="index.php" method="post">
        <table>
          <tr class="margin-10px;">
            <td>Email:</td>
            <td> <input class="form-control" type="text" name="email" value=""> </td>
          </tr>
          <tr>
            <td style="vertical-align:top;">Comment:</td>
            <td> <textarea class="form-control" name="message" rows="8" cols="80"></textarea> </td>
          </tr>
        </table>
        <input type="submit" class="btn btn-primary submit" name="sendmsg" value="Send">
      </form>
    </div>
  </div>
</div>
