<?php include 'headerA.html'; ?>
<?php include 'conn.php'; 
session_start();
if (!isset($_SESSION['customer_id'])) {
    echo
      "<script language=javascript>
      alert('You haven't logged in yet !');
      </script>
      ";
    header("Location: account.php");
}
else{
  $c_id = $_SESSION['customer_id'];
  if(isset($_GET['tender'])){
    $title = $_GET['tender'];
}
  
}
if(isset($_POST['cancel'])) {
    $del = "DELETE FROM request_order WHERE ro_title='".$title."'";
    $result = mysqli_query($conn, $del);
    if($result) {
        echo
        "<script language=javascript>
        alert('Request Cancelled !');
        </script>
        ";
        header("Location: tender.php");
        $_POST=array();
        }
}



?>
<style>
div#main{
	padding-left: 60px;
    padding-right: 60px;
    padding-top: 20px;
}
.card-container{
	max-width:1400px;
	width:100%;
}

.card-body{
	max-width:250px;
	transition:.3s;
	-webkit-transition:.3s;
  text-align: center;
  padding: 0.75rem;
}

.card-deck{
  justify-content: space-evenly;
  padding-top: 20px;
  padding-bottom: 20px;
}

.front-deck{
	padding-top:12rem;
}

.card{
	border:none;
	flex: 0 0 auto;
}

.card .card-body:first-of-type{
	border:1px solid #96cecf;
	border-top:1px solid #96cecf;; 
}

</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<body>
    <div id="main">
        <div id="detail" style="display: inline-flex;justify-content: space-evenly;">
        <?php 
        $select = "SELECT * FROM request_order WHERE cust_id=".$c_id. " AND ro_title='".$title."'";
        if($conn->query($select) == TRUE) {
            $result = $conn->query($select);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $stat = $row['status'];
                   
                    echo "<img style='width:30%' src='../assets/".$row['ro_design']."' >
                    <div id='content' style=width:60% '>
            <h3>".$row['ro_title']."</h3>
            <hr>
            <h5> Request End Date : ".$row['ro_date']."</h5>
            <h5> Quantity : ".$row['ro_qty']."</h5>
            <br>
            <h6>Request Description</h6>
            <p>".$row['ro_desc']."</p>
            <br>
            <form method='post'>";
            if($stat == "Awaiting Payment") {
                echo "<button name='cancel' class='btn btn-danger btn-block' style='width:30%' disabled>Cancel Request</button>";
            }
            else{
               echo "<button name='cancel' class='btn btn-danger btn-block' style='width:30%'>Cancel Request</button>";
            }echo"
            </form>
            </div>";
            echo "<input style='display:none' id='ro' value=".$row['ro_date'].">";
                }
            }
        }
        ?>
        </div>
        <br>
        <br>
        <br>
        <br>
        
        <div>
            <h3>Offers from companies : </h3>
            <hr>
            <div id="offer" style="display:flex;justify-content: space-between;">
            <?php 
        $query = "SELECT * FROM request_order ro JOIN tender t on ro.ro_id = t.ro_id JOIN company c on t.comp_id = c.comp_id WHERE ro.ro_title='".$title."'";
        if($conn->query($query) == TRUE) {
           
            $result = $conn->query($query);
            $row = $result->fetch_array();
            $count = $result->num_rows;
            if($count > 0) {
                
            $deadlineTimestamp = strtotime($row['ro_date']);
            $currentTimestamp = time();
           
            if($currentTimestamp < $deadlineTimestamp) {
                echo "<h4 style='color:red'>Selection is not allowed before the deadline !<h4>";
                echo "<p id='demo' style='color: darkred;border: 1px solid;font-weight: 700;'></p>";
            }
            else{
                $tender = $row['tender_id'];
                $name = $row['comp_name'];
            $price= $row['offered_price'];
            $loc = $row['comp_city'];
                echo "<div class='card text-center' style='width: 18rem;'>
                <div class='card-body'>
                <h5 class='card-title'>".$name."</h5>
                <h5 class='card-title'>".$loc."</h5>
                <p class='card-text'>Rp  ".number_format($price,0,',','.')."</p>
                <a href='company.php?tender=".urlencode($tender)."'><button class='btn btn-primary'>See detail</button></a>
                </div>
            </div>";
            echo "<p id='ro' name='ro' value=".$row['ro_date'].">";
                
            }
        }
        else{
            echo "<h4 style='color:red'>NO OFFER FOUND !</h4>";
        }
            
        }
    ?>
            </div>
            <br>
        <br>
        </div>
        
    </div>
<script>
    var temp = document.getElementById("ro").value;
    var countDownDate = new Date(temp).getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = days + "D : " + hours + "H : "
  + minutes + "m : " + seconds + "s";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "OPEN";
  }
}, 1000);
</script>
    
</body>

<?php include 'footer2.html'; ?>