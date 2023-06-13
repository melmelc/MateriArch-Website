<?php include 'headerB.html'; ?>
<?php include 'conn.php'; 
$c_id = "";
session_start();
 if(isset($_SESSION["company_id"])){
    $c_id = $_SESSION["company_id"];
}


?>

<style>
div#main{
	padding: 40px;
}
</style>
<body>
    <div id="main">
		<div id="primary">
            <h2>Order History</div>
            <hr>
            <table class="table table-bordered" style="text-align:center">
            <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Name</th>
                        <th>Payment Date</th>
                        <th>Payment Total</th>
                        <th>Buyer Name</th>
                        <th>Design</th>
                        <th></th>
                    </tr>
            </thead>
            <tbody>
                    <?php 
                        $query = "SELECT * FROM tender t JOIN payment p ON t.tender_id = p.tender_id JOIN request_order ro ON ro.ro_id = t.ro_id JOIN customer cu ON cu.cust_id = ro.cust_id JOIN company c ON c.comp_id = t.comp_id 
                        WHERE t.comp_id =".$c_id;
                        
                        $result=$conn->query($query);
                    if($result->num_rows>0){
                        while($row=$result->fetch_assoc()){
                            echo "<tr><td> #00000".$row['ro_id']."</td>;
                           <td>".$row['ro_title']."</td>;
                            <td>".$row['payment_date']."</td>;
                            <td> Rp  ".number_format($row['payment_total'],0,',','.')."</td>;
                            <td>".$row['cust_name']."</td>;
                            <td><img src='assets/" . $row['ro_design'] . "' style='width:100px'></td>;
                           <td><a href='order_detailB.php?tender=".urlencode($row['tender_id'])."'><button class='btn btn-primary'>Detail</button></a><br><br>
                           <a href='invoice.php?request=".urlencode($row['ro_title'])."'><button class='btn btn-success'>See Invoice</button></a></td></tr>";
                        }
                    }
                    ?>
            </tbody>
            </table>
        </div>
    </div>
</body>
<?php include 'footer2.html'; ?>