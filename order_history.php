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
		<div id="primary" class="content-area column full">
            <h2>Order History</div>
            <br>
            <table class="table table-bordered" style="text-align:center">
                    <tr>
                        <th>Order Number</th>
                        <th>Order Name</th>
                        <th>Payment Date</th>
                        <th>Payment Total</th>
                        <th>Company Name</th>
                        <th>Status</th>
                    </tr>
                    <?php 
                   
                        
                        $query = "SELECT * FROM orders o JOIN request_order ro ON o.order_id = ro.ro_id JOIN payment p ON o.payment_id = p.payment_id JOIN customer c on ro.cust_id = c.cust_id WHERE c.cust_id=".$c_id ;
                        $result=$conn->query($query);
                    if($result->num_rows>0){
                        while($row=$result->fetch_assoc()){
                            echo "<tr><td>".$row['o.order_id']."</td>;
                           <td>".$row['ro.ro_title']."</td>;
                            <td>".$row['p.payment_date']."</td>;
                            <td>".$row['p.payment_total']."</td>;
                            <td>".$row['c.comp_name']."</td>;
                           <td>".$row['o.status']."</td></tr>";
                        }
                    }
                    ?>
            </table>
        </div>
    </div>
</body>
<?php include 'footer2.html'; ?>