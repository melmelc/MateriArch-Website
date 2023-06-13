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
  
}
$c_id = $_SESSION['customer_id'];
  $tender_id = $_GET['tender'];



?>
<body>
    <div id="main" style="padding: 40px">
    <div id="detail" style="display: inline-flex;">
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
                    <h5> Date offered : ".$row['offer_date']." </h5>
            <h5> Price offered by this company : Rp ".number_format($row['offered_price'],0,',','.')."</h5>
            <h5> Company Phone : <a href='https://wa.me/".$ph."'>".$ph."</a></h5>
            <h5> Company Address : ".$row['comp_address']."</h5>
            <h5> Company City : ".$row['comp_city']."</h5>
            <br>
            <h6>Offer Description</h6>
            <p>".$row['offer_desc']."</p>
            <br>";
            if($row['status'] == "Awaiting Payment"){echo"<button class='btn btn-primary' disabled>Approve this offer</button>"; }
            else{ echo"
            <a href='payment.php?tender=".urlencode($tender)."'><button class='btn btn-primary'>Approve this offer</button></a>";}
            echo"
            </div>   ";
                }
            }
        }
    
        
        ?>
            
    </div>    
    <div>
        <br><br>
        <h3>Company Profile</h3>
        <div style="display: inline-flex;justify-content: space-evenly;">
        <img src="assets/agra.jpeg" style="width:40%">
        <div id="content" style="padding-left: 30px">
        <?php 
        $qu = "SELECT * FROM tender t JOIN company c ON t.comp_id = c.comp_id WHERE t.tender_id=".$tender_id;
        if($conn->query($qu) == TRUE) {
            $result = $conn->query($qu);
            $row = $result->fetch_assoc();
            echo "<h3>".$row['comp_name']."</h3>
            <hr>
            <p>".$row['comp_profile']."</p>
            <h3>Contact Us </h3>
            <b><p>Address : ".$row['comp_address'].", ".$row['comp_city']."</p>
            <p>Email : <a href='mailto:".$row['comp_email']."'>".$row['comp_email']."</a></p>
            <p>Phone Number : <a href='https://wa.me/".$row['comp_phone']."'>".$row['comp_phone']."</a></p></b>
            <a href='portfolio.php?compid=".urlencode($row['comp_id'])."'><button class='btn btn-primary'>See our portfolios</button></a>";
        }
        ?>
        
        </div>
        </div>
        <br>
        <br>
    </div>
    </div>
</body>

<?php include 'footer2.html'; ?>