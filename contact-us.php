<?php
    include 'admin/inc/db_config.php';
    include 'admin/inc/essentials.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'inc/head-meta.php' ?>
        <?php include 'inc/links.php' ?>
        <?php include 'inc/scripts.php' ?>

        <link href="stylesheet/contact-us.css" rel="stylesheet" type="text/css">
    </head>
    <body class="p-contact-us bg-light">
        <?php include 'inc/header.php' ?>
        <div class="main-content">
            <?php include 'page-sections/contact-us/header.php' ?>
            <?php include 'page-sections/contact-us/items.php' ?>
            <?php include 'inc/footer.php' ?>
        </div>
    </body>
</html>

<?php
  $isSent = isset($_POST['contact-us-send']);

  if($isSent) {
      $frmData = filteration($_POST);
      $q = "INSERT INTO `user_queries`(`name`,`email`,`subject`,`message`) VALUES(?,?,?,?)";
      $values = [$frmData['name'],$frmData['email'],$frmData['subject'],$frmData['message']];

      $res = insert($q, $values, 'ssss');

      if($res == 1) {
          echo "<script>customAlert('success', 'Message sent succesfully', 'bottom-alert');</script>";
      }else {
          echo "<script>customAlert('error', 'Server error, try again later', 'bottom-alert');</script>";
      }
      echo "<script>window.location.href = 'contact-us.php';</script>";
  }
?>