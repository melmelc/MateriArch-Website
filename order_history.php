<?php include 'headerA.html'; ?>
<?php include 'conn.php'; 
$c_id = "";
session_start();
 if(isset($_SESSION["customer_id"])){
    $c_id = $_SESSION["customer_id"];
}
?>

<style>
div#main{
	padding: 40px;
}
</style>
<body>
    <div id="main">
		<div id="p">
            <h2>Order History</div>
            <br>
            <table class="table table-bordered" style="text-align:center">
            <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Order Name</th>
                        <th>Payment Date</th>
                        <th>Payment Total</th>
                        <th>Company Name</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
            </thead>
            <tbody>
                    <?php 
                        $query = "SELECT * FROM tender t JOIN payment p ON t.tender_id = p.tender_id JOIN request_order ro ON ro.ro_id = t.ro_id JOIN company c ON c.comp_id = t.comp_id 
                        JOIN delivery d ON d.tender_id = t.tender_id JOIN selected_tender st ON st.buyer_id= ro.cust_id WHERE ro.cust_id =".$c_id;
                        $result=$conn->query($query);
                    if($result->num_rows>0){
                        while($row=$result->fetch_assoc()){
                            echo "<tr><td>".$row['ro_id']."</td>;
                           <td>".$row['ro_title']."</td>;
                            <td>".$row['payment_date']."</td>;
                            <td> Rp  ".number_format($row['payment_total'],0,',','.')."</td>;
                            <td>".$row['comp_name']."</td>;
                           <td>".$row['payment_status']."<br><br><a href='invoice.php?request=".urlencode($row['ro_title'])."'><button class='btn btn-success'>See Invoice</button></a></td>;
                           <td><a href='order_detail.php?tender=".urlencode($row['tender_id'])."'><button class='btn btn-primary'>Detail</button></a></td></tr>";
                        }
                    }
                    ?>
            </tbody>
            </table>
        </div>
    </div>
</body>
<?php include 'footer2.html'; ?>