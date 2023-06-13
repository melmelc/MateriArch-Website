<?php include 'headerB.html'; ?>
<?php include 'conn.php'; 
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
}
?>

<body>
    <div id="main" style="padding: 40px;">
    
    <h4>Offers You've Made</h4>
    <hr>
    <table class='table table-bordered' style='text-align:center'>
        <thead>
            <tr>
                <th>Request Design</th>
                <th>Order Title</th>
                <th>Offer Date</th>
                <th>Offered Price</th>
                <th>Vehicle Used</th>
                
            </tr>
        </thead>
        <tbody>
    <?php
        $myQuery = "SELECT * FROM request_order ro JOIN tender t ON ro.ro_id=t.ro_id WHERE comp_id=".$c_id. " AND o_stat='offered'";
        $result = mysqli_query($conn, $myQuery);
        echo "<br>";
        while($row = mysqli_fetch_assoc($result)) {
            $title=$row['ro_title'];
            if($row['vehicle'] == "EngkelB") {
                $v = "Engkel Box";
            }else if($row['vehicle'] == "DoubleE") {
                $v = "Double Engkel";
            }else if($row['vehicle'] == "EngkelPU") {
                $v = "Engkel Pick Up";
            }
            else{
                $v = "NONE";
            }
            echo "<tr>";
            echo "<td> <img src='../assets/" . $row['ro_design'] . "' style='width:100px'></td>";
            echo "<td>" . $row['ro_title'] . "</td>";
            echo "<td>" . $row['offer_date'] . "</td>";
            echo "<td>Rp  " . number_format($row['offered_price'],'0',',','.') . "</td>";
            echo "<td>" .$v. "</td>";
            echo "<td><a href='tender_input.php?title=".urlencode($title)."'><button class = 'btn btn btn-primary'>Detail</button></a></td></tr>";
        }
        echo "</tbody></table>";
        mysqli_close($conn);
    ?>
    </div>
</body>
