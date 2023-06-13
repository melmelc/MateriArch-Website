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
    
    <h4>Available Requests</h4>
    <hr>
    <table class='table table-bordered' style='text-align:center'>
        <thead>
            <tr>
                <th>Request Design</th>
                <th>Order Title</th>
                <th>Order Description</th>
                <th>Quantity</th>
                <th>Request Deadline Date</th>
            </tr>
        </thead>
        <tbody>
    <?php
        $myQuery = "SELECT * FROM request_order ro WHERE status != 'Awaiting Payment' AND status != 'Done' AND ro_date >= CURRENT_DATE ORDER BY ro_date DESC";
        $result = mysqli_query($conn, $myQuery);
        echo "<br>";
        while($row = mysqli_fetch_assoc($result)) {
            $title=$row['ro_title'];
            echo "<tr>";
            echo "<td> <img src='../assets/" . $row['ro_design'] . "' style='width:100px'></td>";
            echo "<td>" . $row['ro_title'] . "</td>";
            echo "<td>" . $row['ro_desc'] . "</td>";
            echo "<td>" . $row['ro_qty'] . "</td>";
            echo "<td>" . $row['ro_date'] . "</td>";
            echo "<td><a href='tender_input.php?title=".urlencode($title)."'><button class = 'btn btn btn-primary'>Detail</button></a></td></tr>";
        }
        echo "</tbody></table>";
        mysqli_close($conn);
    ?>
    </div>
</body>
