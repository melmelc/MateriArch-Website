<?php include 'headerB.html'; ?>
<?php include 'conn.php';

$q1 = "SELECT * FROM request_order";

?>

<style>
div#main{
	padding: 40px;
}
</style>
<body>
    <div id="main">
        <div>
            <h3>Recent request from customer</h3>
            
        </div>
        <div>
            <h3>Offers you've made :</h3>

        </div>
    </div>
</body>



<?php include 'footer2.html'; ?>