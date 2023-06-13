<?php include 'headerB.html'; ?>
<?php 

include 'conn.php'; 
session_start();
if (!isset($_SESSION['company_id']))
{   
    echo
    "<script language=javascript>
    alert('You haven't logged in yet !');
    </script>
    ";
    header("Location: account.php");
}
else{
  $c_id = $_SESSION['company_id'];
  if(isset($_GET['title'])){
    $title = $_GET['title'];
    }

if(isset($_POST['sub'])){
    $select = "SELECT ro_id FROM request_order WHERE ro_title='".$title."'";
    $result = mysqli_query($conn,$select);
    $row = mysqli_fetch_array($result);
    $vhc = $_POST['vehicle'];
    $cur = $_POST['currency']; 
    $price=$_POST['price'];
    $descr = $_POST['desc'];
    $ro_id = $row['ro_id'];
    if($cur == "$" ){
        $price2 = 14000*$price;
    }else{
        $price2 = $price;
    }
    // Check if the entry already exists for the given RO ID and company ID
$checkQuery = "SELECT * FROM tender WHERE ro_id = $ro_id AND comp_id = $c_id";
$checkResult = $conn->query($checkQuery);

if ($checkResult->num_rows > 0) {
    while($row = $checkResult->fetch_assoc()) {
    // Entry already exists, update the existing record
    $updateQuery = "UPDATE tender SET ";
    $updateFields = array();
    
    if ($row['offered_price'] != $price) {
        $updateFields[] = "offered_price = '$price'";
    }
    if ($row['vehicle'] != $vhc) {
        $updateFields[] = "vehicle = '$vhc'";
    }
    if ($row['offer_desc'] != $descr) {
        $updateFields[] = "offer_desc = '$descr'";
    }
    
    

    // Construct the UPDATE query
    $updateQuery .= implode(", ", $updateFields);
    $updateQuery .= " WHERE ro_id = $ro_id AND comp_id = $c_id";

    // Execute the UPDATE query
    if ($conn->query($updateQuery) === TRUE) {
        echo "<script language=javascript>
              alert('Offer Updated Successfully');
              document.location.href = 'offered_list.php';
              </script>";
        $_POST = array();
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
    
} else {
    // Entry doesn't exist, insert a new record
    $insertQuery = "INSERT INTO tender (comp_id, ro_id, offered_price, vehicle,offer_desc,o_stat) VALUES ($c_id, $ro_id, '$price', '$vhc','$descr','offered')";
    
    // Execute the INSERT query
    if ($conn->query($insertQuery) === TRUE) {
        echo "<script language=javascript>
              alert('Offer Submitted Successfully');
              document.location.href = 'offered_list.php';
              </script>";
        $_POST = array();
        exit;
    } else {
        echo "Error inserting record: " . $conn->error;
    }
}
}
}

?>
<body>
    <div id="main" style="padding:40px">
    <div id="detail" style="display: inline-flex;justify-content: space-evenly;">
        <?php 
        $select = "SELECT * FROM request_order ro JOIN customer c ON ro.cust_id = c.cust_id WHERE ro_title='".$title."'";
        if($conn->query($select) == TRUE) {
            $result = $conn->query($select);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div><img style='width:400px;max-width:auto;height:auto' src='../assets/".$row['ro_design']."' ></div>
                    <div id='content' style='padding-left: 30px'>
            <h3>".$row['ro_title']."</h3>
            <hr>
            <h5> Request End Date : ".$row['ro_date']."</h5>
            <h5> Quantity : ".$row['ro_qty']."</h5>
            <h6 style='color:red'> Permission to reuse design : ".$row['agree']."</h6>
            <h6><a href='assets/".$row['ro_design']."'download>Download design here</a></h6><br>";
            if($row['status'] != 'Done') {
                echo "<form action='#' method='post'>
                <h5><label for='vehicle'>Select vehicle that fits for shipment</label></h5>
                <small style='color:red'>Vehicle will be provided by our company, please measure accurately to avoid problems in the near future</small>
                <select name='vehicle' required class='form-control'>
                <option value='' default>--Select Vehicle Type--</option>
                <option value='EngkelPU' default>Engkel Pick-Up (PxLxT = 200x156x120 cm / max. 800kg)</option>
                <option value='EngkelB' default>Engkel Box (PxLxT = 310x170x170 cm / max. 2,200kg)</option>
                <option value='DoubleE' default>Double Engkel (PxLxT = 420x200x170 cm / max. 4,200kg)</option>
                </select>
                <br>
                <h5><label for='desc'>Write your offer description</label></h5>
                <input type='text' class='form-control' name='desc'><br>
                <h5><label for='price'>Offer Price</label></h5>
                <select name='currency' required class='form-control' style='width:20%;display:inline-flex'>
                <option value='Rp' default>Rp</option>
                <option value='$'>$ (USD)</option>
                </select>&nbsp;&nbsp;<input style='width:63%;display:inline' class='form-control' type='number' id='price' name='price' placeholder='Enter Price' min='100' required>
                &nbsp;&nbsp;<button class='btn btn-success' name='sub'>Submit</button>
                
               ";
            }
           echo"
            </form>
            </div>";
                
            
           
        ?>     
        </div>
        <br>
        <div>
            <h5>Request Description</h5>
            <hr>
            <p><?php echo($row['ro_desc']); ?></p>
            <h6>Customer contact :</h6>
            <h6><?php echo($row['cust_name']); ?></h6>
            <h6><?php echo "<a href='https://wa.me/".$row['cust_phone']."'>".$row['cust_phone']."</a>"; ?></h6>
            <?php }}} $conn->close()?>
        </div>
    

    
    </div>
</body>
<?php include 'footer2.html'; ?>
</html>