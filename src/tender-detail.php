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
<body>
    <div id="main">
        <div id="detail" style="display: inline-flex;justify-content: space-evenly;">
        <?php 
        $select = "SELECT * FROM request_order WHERE cust_id=".$c_id. " AND ro_title='".$title."'";
        if($conn->query($select) == TRUE) {
            $result = $conn->query($select);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<img style='width:30%' src='../assets/".$row['ro_design']."' >
                    <div id='content' style='padding-left: 30px'>
            <h3>".$row['ro_title']."</h3>
            
            <h4> Deadline : ".$row['ro_date']."</h4>
            <h4> Quantity : ".$row['ro_qty']."</h4>
            <br>
            <h6>REQUEST DESCRIPTION</h6>
            <p>".$row['ro_desc']."</p>
            </div>   ";
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
            <div id="offer" style="display:flex;overflow-x:auto;scroll-behavior:smooth">
            <?php 
        $query = "SELECT * FROM request_order ro JOIN tender t on ro.ro_id = t.ro_id JOIN company c on t.comp_id = c.comp_id WHERE ro.ro_title='".$title."'";
        if($conn->query($query) == TRUE) {
            $result = $conn->query($query);
            $row = $result->fetch_array();
            $count = $result->num_rows;
            if($count > 0) {
                $tender = $row['tender_id'];
                $name = $row['comp_name'];
            $price= $row['offered_price'];
            $loc = $row['comp_city'];
            echo "<div class='card text-center' style='width: 18rem;'>
            <div class='card-body'>
              <h5 class='card-title'>".$name."</h5>
              <h5 class='card-title'>".$loc."</h5>
              <p class='card-text'>".$price."</p>
              <a href='company.php?tender=".urlencode($tender)."'><button class='btn btn-primary'>See detail</button></a>
            </div>
          </div>";
            }
            else{
                echo "NO DATA FOUND";
            }
            
        }
    ?>
    
            </div>
            <br>
    <br>
        </div>
       
        
    </div>
    
</body>

<?php include 'footer2.html'; ?>