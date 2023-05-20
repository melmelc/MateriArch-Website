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
    $ro_id = $row['ro_id'];
    $price=$_POST['price'];
    $sel2 = "SELECT * FROM tender WHERE ro_id=".$ro_id;
    $result2 = $conn->query($sel2);
    if ($result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
            $temp = $row['offered_price'];   
            if($temp != $price) {
                $sql = "UPDATE tender SET offered_price='".$price."' WHERE ro_id=".$ro_id." AND comp_id=".$c_id;
                }
            }
    }
    else{
        $sql = "INSERT INTO tender (comp_id,ro_id,offered_price) VALUES ('$c_id','$ro_id',$price)";
    }
    if($conn->query($sql) == TRUE) {
        $_POST = array();
        echo
            "<script language=javascript>
            alert('Offer Submitted Successfully')
            document.location.href = 'tender_list.php';
            </script>
            ";
        exit;
    }
    else{
        $_POST = array();
        exit;
    }
}
}
    // $offer = "";
    // $offer_err = "";

    // if($_SERVER["REQUEST_METHOD"] == "POST"){
    //     if(empty(trim($_POST["offered"]))){
    //         $offer_err = "Please enter an amount";
    //     }else{
    //         $sql = "SELECT tender_id FROM tender WHERE offered_price = ?";

    //         if($stmt = mysqli_prepare($conn, $sql)){
    //             mysqli_stmt_bind_param($stmt, "s", $param_offer);
    //             $param_offer = trim($_POST["offered"]);

    //             if(mysqli_stmt_execute($stmt)){
    //                 mysqli_stmt_store_result($stmt);

    //                 if(mysqli_stmt_num_rows($stmt) == 1){
    //                     $offer = trim($_POST["offered"]);
    //                 }
    //             } else{
    //                 echo "Something went wrong. Please try again later.";
    //             }

    //             mysqli_stmt_close($stmt);
    //         }
    //     }

    //     if(empty($offer_err)){
        
    //         // Prepare an insert statement
    //         $sql = "INSERT INTO tender (offered_price) VALUES (?)";
             
    //         if($stmt = mysqli_prepare($conn, $sql)){
    //             // Bind variables to the prepared statement as parameters
    //             mysqli_stmt_bind_param($stmt, "s", $param_offer);
                
    //             // Set parameters
    //             $param_offer = $offer;
                
    //             // Attempt to execute the prepared statement
    //             if(mysqli_stmt_execute($stmt)){
    //                 // Redirect to login page
    //                 header("location: tender_list.php");
    //             } else{
    //                 echo "Something went wrong. Please try again later.";
    //             }
    
    //             // Close statement
    //             mysqli_stmt_close($stmt);
    //         }
    //     }

    //     mysqli_close($conn);
    // }

?>
<body>
    <div id="main" style="padding:40px">
    <div id="detail" style="display: inline-flex;justify-content: space-evenly;">
        <?php 
        $select = "SELECT * FROM request_order WHERE ro_title='".$title."'";
        if($conn->query($select) == TRUE) {
            $result = $conn->query($select);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<img style='width:30%' src='assets/".$row['ro_design']."' >
                    <div id='content' style='padding-left: 30px'>
            <h3>".$row['ro_title']."</h3>
            
            <h4> Deadline : ".$row['ro_date']."</h4>
            <h4> Quantity : ".$row['ro_qty']."</h4>
            <h6> Permission to reuse design : ".$row['agree']."</h6>
            <br>
            <br>
            <h6>REQUEST DESCRIPTION</h6>
            <p>".$row['ro_desc']."</p>

            <br>
            <h6><a href='assets/".$row['ro_design']."'download>Download design here</a></h6>";
            echo "<br><br><form action='#' method='post'>
            <h5><label for='price'>Offer Price</label></h5>
            <input style='width:50%' type='number' id='price' name='price' placeholder='Enter Price' min='1000000' required>
            <button type='submit' name='sub'>Submit</button>
            </form>
            </div> ";
                }
            }
        }
           
        ?>     
        </div>
    <br>
    <br>

    
    </div>
</body>