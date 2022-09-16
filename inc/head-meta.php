<?php
    $setting = mysqli_fetch_assoc(select("SELECT * FROM `settings` WHERE `sr_no`=? LIMIT 1", [1], 'i'));
?>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
