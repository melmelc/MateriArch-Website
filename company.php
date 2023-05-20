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
    <div id="main" style="padding: 40px">
    <div id="detail" style="display: inline-flex;justify-content: space-evenly;">
        <?php 
        $select = "SELECT * FROM tender t JOIN request_order ro ON t.ro_id = ro.ro_id JOIN company c ON c.comp_id = t.comp_id WHERE t.tender_id=".$tender_id;
        if($conn->query($select) == TRUE) {
            $result = $conn->query($select);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $tender = $row['tender_id'];
                    $ph = $row['comp_phone'];
                    echo "<img style='width:30%' src='assets/".$row['ro_design']."' >
                    <div id='content' style='padding-left: 30px'>
            
            <h3>".$row['comp_name']."</h3>
            <h3> Price offered by this company : ".$row['offered_price']."</h3>
            <h4> Company Address : ".$row['comp_address']."</h4>
            <h4> Company Phone : <a href='https://wa.me/".$ph."'>".$ph."</a></h4>
            <br>
            <h6>REQUEST DESCRIPTION</h6>
            <p>".$row['ro_desc']."</p>
            <a href='payment.php?tender=".urlencode($tender)."'><button class='btn btn-primary'>Approve this offer</button></a>
            </div>   ";
                }
            }
        }
        
        ?>
            
    </div>    
    <div>
        <br><br>
        <h3>Company Profile</h3>
        <br>            
        <h3> Company Name </h3>
        <hr>
        <div style="display: inline-flex;justify-content: space-evenly;">
        <img src="assets/ERD Manpro 8.jpg" style="width:40%">
        <div id="content" style="padding-left: 30px">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, tenetur nostrum! Repudiandae, modi aspernatur. Atque, dolore maiores suscipit ipsam saepe nihil officiis. Soluta qui earum quae. Beatae dignissimos impedit odit.</p>
        <h3>Contact Us</h3>
        <p>Address : </p>
        <p>Email : </p>
        <p>Phone Number :</p>
        <a href="portfolio.php"><button type="primary">See our portfolios</button></a>
        </div>
        </div>
    </div>
            
    
    </div>
</body>

<?php include 'footer2.html'; ?>