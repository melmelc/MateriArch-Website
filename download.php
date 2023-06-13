<?php 
require_once('D:\xampp\htdocs\vendor\autoload.php');

include 'conn.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
// Continue using $dompdf as needed
$ro = $_GET['request'];
$select = "SELECT * FROM request_order ro JOIN customer c ON ro.cust_id = c.cust_id JOIN tender t 
on t.ro_id = ro.ro_id JOIN delivery d ON d.tender_id = t.tender_id JOIN payment p ON 
p.tender_id=t.tender_id JOIN company comp ON comp.comp_id= t.comp_id WHERE ro_title = '".$ro."'";
if($conn->query($select) == TRUE) {
    $result = $conn->query($select);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $html = '<div style="padding:40px;">
            <div>
                    <img src="assets/vector.png">
                    </div>
                    <br>
                    <br>
                <div style="display:flex; justify-content:space-between;">
                    <div>
                    <h3>Invoice Number : #1000000'.$row['tender_id'].'</h3>
                    <hr>
                    <h4>Order Title : '.$row['ro_title'].'</h4>
                    <p style="color:red">Request Date :'.$row['req_date'].' || Request End Date : '.$row['ro_date'].'</p>
                    </div>
                    <div>
                    <h3>Seller Information</h3>
                    <hr>
                    <p>Seller Name : '.$row['comp_name'].'</p>
                    <p>Seller Phone : '.$row['comp_phone'].'</p>
                    <p>Seller Address : '.$row['comp_address']." ".$row['comp_city'].'</p>
                    </div>
                    <div>
                    <h3>Buyer Information</h3>
                    <hr>
                    <p>Buyer Name : '.$row['cust_name'].'</p>
                    <p>Buyer Phone : '.$row['cust_phone'].'</p>
                    </div>
                </div>
                <br><br>
                <div style="display:flex; justify-content:space-between;">
                <div>
                <h3>Payment Information</h3>
                <hr>
                <p>Payment Date : '.$row['payment_date'].'</p>
                <p>Payment Total : Rp  '.number_format($row['payment_total'],0,',','.').'</p>
                <p>Payment ID : #9900000'.$row['payment_id'].'</p>
                </div>
                <div>
                    <h3>Receiver Information</h3>
                    <hr>
                    <p>Name : '.$row['penerima'].'</p>
                    <p>Phone : '.$row['phone'].'</p>
                    <p>Address : '.$row['delivery_address']." ".$row['delivery_city'].'</p>
                    </div>
                <div>
                <h3>Order Description</h3>
                <hr>
                <p>Order Quantity : '.$row['ro_qty'].'</p>
                <p>'.$row['ro_desc'].'</p>
                <br>
                </div>
                </div>
                <h3>Order Design</h3>
                <img src="assets/'.$row['ro_design'].'" alt="Order Design" width="100%">
                </div>';
        }
    }
}
error_reporting(E_ALL);
ini_set('display_errors', 1);


$dompdf->setPaper('A4', 'portrait');
$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream('invoice.pdf');



?>