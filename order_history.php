<?php include 'headerA.html'; ?>
<?php include 'conn.php'; 

$query = "SELECT * FROM orders o JOIN request_order ro ON o.order_id = ro.ro_id JOIN payment p ON o.payment_id = p.payment_id" ;


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
            </table>
        </div>
    </div>
</body>
<?php include 'footer2.html'; ?>