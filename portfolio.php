<?php include 'headerA.html'; 
include 'conn.php';
session_start();
if (!isset($_SESSION['customer_id']))
{   
    echo
    "<script language=javascript>
    alert('You haven't logged in yet !');
    </script>
    ";
    header("Location: account.php");
}
else{
  $c_id = $_SESSION['customer_id'];
  $tender_id = $_GET['tender'];

}




?>

<body>
    <div id="main">
        <div class="profile" style="display: inline-flex;justify-content: space-evenly;">
            <img src="assets/ERD Manpro 8.jpg" style="width:30%">
            <div>
                <h2>Company Name</h2>
                <h5>Company Address</h5>
                <h5>Company Contact</h5>
                <h5>Company Email</h5>
                <h5>Company Description</h5>
                <p>Company Description</p>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <div class="projects">
            <h3>Projects done by this company</h3>
            <table class="table table-bordered" style="text-align:center">
                <thead>
                    <tr>
                        <th>Order Name</th>
                        <th>Order Date</th>
                        <th>Order Design</th>
                        <th>Buyer Review</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $q = "SELECT * FROM orders o JOIN request_order ro ON o.ro_id = ro.ro_id WHERE ro.comp_id =".$comp_id;
                    if($conn->query($q) == TRUE) {
                        $result = $conn->query($q);
                        while($row = $result->fetch_assoc()) {
                            $order_name = $row['ro_title'];
                            $order_date = $row['ro_date'];
                            $order_design = $row['ro_design'];
                            $order_review = $row['ro_review'];
                        }

                    }
                    
                    
                    ?>
                </tbody>

            </table>
        </div>

    </div>
</body>
<?php include 'footer2.html'; ?>