<?php

include "conn.php";

$tender_id = $_GET['tender_id'];
$selCity = $_GET['city'];


$compcity = "SELECT * FROM company c JOIN tender t ON c.comp_id=t.comp_id  WHERE tender_id=".$tender_id;
    $result = mysqli_query($conn, $compcity);
    $row = $result->fetch_array();
    $count = $result->num_rows;
    if($count > 0) {
        $compct = $row['comp_city'];
        $vhc = $row['vehicle'];
        $prices = "SELECT biaya FROM shipment WHERE kota_asal='".$compct."' AND kota_tujuan='".$selCity."'";
    $result2 = mysqli_query($conn, $prices);
    $row2 = $result2->fetch_array();
    $count = $result2->num_rows;
    if($count > 0) {
        $price = $row2['biaya'];
        if($vhc == "DoubleE") {
            $price = $price*5000;
        }
        if($vhc == "EngkelPU") {
            $price = $price*3000;
        }
        if($vhc == "EngkelB") {
            $price = $price*4000;
        }
    }
    else{
        if($compct == $selCity) {
            if($vhc == "DoubleE") {
                $price = 500000;
            }
            if($vhc == "EngkelPU") {
                $price = 300000;
            }
            if($vhc == "EngkelB") {
                $price = 400000;
            }
        }
        else {
            if($vhc == "DoubleE") {
                $price = 700000;
            }
            if($vhc == "EngkelPU") {
                $price = 600000;
            }
            if($vhc == "EngkelB") {
                $price = 500000;
            }
        }
    }
    }
// Send the response back to the AJAX request
echo $price;


?>
