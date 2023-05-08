<?php  include('conn.php');



header("Content-type: image/jpeg");
print base64_encode($row['cat_pic']);
exit;?>