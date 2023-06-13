<?php
$number = $_GET['number'];
$formattedNumber = number_format($number, 0, ',', '.');
echo $formattedNumber;
?>
