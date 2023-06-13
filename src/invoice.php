<?php 
include 'conn.php';
session_start();
if (!isset($_SESSION['company_id']) AND !isset($_SESSION['customer_id']))
{   
	include 'header.html';
    echo
    "<script language=javascript>
    alert('You haven't logged in yet !');
    </script>
    ";
}
else{
  if(isset($_SESSION['company_id'])) {
	include 'headerB.html';
	$c_id =$_SESSION['company_id'];
  }

else if(isset($_SESSION['customer_id'])){
	include 'headerA.html';
	$c_id = $_SESSION['customer_id'];

	}
}
$ro = $_GET['request'];
$sql = "SELECT * FROM request_order ro JOIN customer c ON ro.cust_id = c.cust_id JOIN tender t on t.ro_id = ro.ro_id JOIN delivery d 
ON d.tender_id = t.tender_id JOIN payment p ON p.tender_id=t.tender_id JOIN company comp ON comp.comp_id= t.comp_id WHERE ro_title = '".$ro."'";
if($conn->query($sql) == TRUE) {
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $html = '<div style="padding-left:100px;padding-right:100px">
            <br><br>
            <div style="display:flex; justify-content:space-between;">
                    <div>
                    <img src="../assets/vector.png" style="width:120%">
                    </div>
                    <div>
                    <h3>Invoice Number : #1000000'.$row['tender_id'].'</h3>
                    </div>
            </div>
                    <br>
                    <br>
                <div style="display:flex; justify-content:space-between;">
                    <div style="width:50%">
                    <h3>Order Title : '.$row['ro_title'].'</h3>
                    <hr>
                    <p>Payment ID : #9900000'.$row['payment_id'].'</p>
                    <p>Payment Date : '.$row['payment_date'].'</p>
                    <h6 style="color:red">Payment Total : Rp  '.number_format($row['payment_total'],0,',','.').'</h6>
                    <p>Shipment ID : #MA00000'.$row['delivery_id'].' || Shipment Type : '.$row['vehicle'].'</p>
                    </div>
                    <div style="width:40%">
                    <h3>Seller Information</h3>
                    <hr>
                    <p>Seller Name : '.$row['comp_name'].'</p>
                    <p>Seller Phone : '.$row['comp_phone'].'</p>
                    <p>Seller Address : '.$row['comp_address']." ".$row['comp_city'].'</p>
                    </div>
                </div>
                <br><br>
                <table class="table table-bordered table-striped" style="text-align:center">
                <thead>
                    <tr>
                        <th>Item Description</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td> '.$row['ro_title'].". Jumlah Qty : ".$row['ro_qty'].'</td><td> Rp  '.number_format($row['offered_price'],0,',','.').'</td></tr>
                    <tr><td>Biaya Administrasi</td><td> Rp  '.number_format($row['offered_price']*0.01,0,',','.').'</td></tr>
                    <tr><td>Biaya Pengiriman dengan tipe kendaraan : '.$row['vehicle'].'</td><td> Rp  '.number_format($row['cost'],0,',','.').'</td></tr>
                    <tr><td>Biaya Asuransi Pengiriman</td><td> Rp  '.number_format($row['offered_price']*0.05,0,',','.').'</td></tr>
                    <tr><th>Total Biaya</th><th>Rp  '.number_format($row['payment_total'],0,',','.').'</th></tr>
                </tbody>
                </table>
                <br><br>
                <div style="display:inline-flex; justify-content:space-between;">
                    <div>
                        <h3>Design</h3>
                        <img src="../assets/'.$row['ro_design'].'" alt="Order Design" width="90%">
                    </div>
                    <div>
                    <h3>Order Description</h3>
                        <hr>
                        <p>Order Quantity : '.$row['ro_qty'].'</p>
                        <p>'.$row['ro_desc'].'</p>
                        <br>
                        <h3>Receiver Information</h3>
                    <hr>
                    <p>Name : '.$row['penerima'].'</p>
                    <p>Phone : '.$row['phone'].'</p>
                    <p>Address : '.$row['delivery_address']." ".$row['delivery_city'].'</p>
                    </div>                   
                </div>
            </div><br><br>';
        }
    } echo ($html);
}

include 'footer2.html';
?>