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
  $c_id = $_GET['compid'];

}




?>

<body>
    <div id="main" style="padding-left:50px;padding-right:50px">
    <div>
        <br>
        <h3>Company Profile</h3>
        <br>            
        <div style="display: inline-flex;justify-content: space-evenly;">
        <img src="../assets/agra.jpeg" style="width:40%">
        <div id="content" style="padding-left: 30px">
        <?php 
        $qu = "SELECT * FROM company WHERE comp_id=".$c_id;
        if($conn->query($qu) == TRUE) {
            $result = $conn->query($qu);
            $row = $result->fetch_assoc();
            echo "<h3>".$row['comp_name']."</h3>
            <hr>
            <p>".$row['comp_profile']."</p>
            <h3>Contact Us </h3>
            <b><p>Address : ".$row['comp_address'].", ".$row['comp_city']."</p>
            <p>Email : <a href='mailto:".$row['comp_email']."'>".$row['comp_email']."</a></p>
            <p>Phone Number : <a href='https://wa.me/".$row['comp_phone']."'>".$row['comp_phone']."</a></p></b>";
        }
        ?>
        
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
                        <th>Download Design</th>
                        <th>Buyer Review</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $q = "SELECT * FROM tender t JOIN request_order ro ON t.ro_id = ro.ro_id JOIN payment p ON p.tender_id = t.tender_id WHERE comp_id =".$c_id;
                    if($conn->query($q) == TRUE) {
                        $result = $conn->query($q);
                        while($row = $result->fetch_assoc()) {
                            $order_name = $row['ro_title'];
                            $order_date = $row['ro_date'];
                            $order_design = $row['ro_design'];
                            echo "<tr><td>".$order_name."</td>
                            <td>".$order_date."</td>
                            <td><img style='width:100px' src='assets/".$order_design."' ></td>";
                            if($row['agree'] == "yes") {
                                echo "<td><a href='../assets/".$row['ro_design']."'download><button class='btn btn-primary'>Download Design</button></a></td>";
                            }
                            else if($row['agree'] == "no"){
                                echo "<td><button class='btn btn-primary' disabled>Download Design</button></a></td>";
                            }
                            
                            
                            echo "<td></td>
                            </tr>";
                            // $order_review = $row['ro_review'];
                        }

                    }
                    
                    
                    ?>
                </tbody>
            </table>
                </div>
        </div>

    </div>
</body>
<?php include 'footer2.html'; ?>