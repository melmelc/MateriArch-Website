<?php include 'headerA.html';
include 'conn.php';
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
}

?> 
<style>
div#main{
	padding: 40px;
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
p {
  white-space: nowrap; 
  width: 70%s; 
  overflow: hidden;
  text-overflow: ellipsis; 
}
.card{
    border-radius: 4px;
    background: #fff;
    box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);
      transition: .3s transform cubic-bezier(.155,1.105,.295,1.12),.3s box-shadow,.3s -webkit-transform cubic-bezier(.155,1.105,.295,1.12);
  cursor: pointer;
}

.card:hover{
     transform: scale(1.05);
  box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
}

.card h6{
  font-weight: 600;
}

@media(max-width: 990px){
  .card{
    margin: 20px;
  }
} 
</style>
<body>
<div id="main" style='text-align:center'>
<h3>Recently Posted Requests</h3>
    <div style="display:flex;overflow-x:auto;scroll-behavior:smooth">
    
      <?php
        $query = "SELECT * FROM request_order WHERE cust_id=".$c_id." ORDER BY ro_date ASC";
            if($conn->query($query) == TRUE) {
                $result = $conn->query($query);
                $count = $result->num_rows;
                if($count > 0) {
                    while($row = $result->fetch_assoc()) {
                    $title = $row['ro_title'];
                $category = $row['ro_category'];
                $image = $row['ro_design'];
                $desc = $row['ro_desc'];
                $date = $row['ro_date'];
                echo "<div class='container' style='padding-right: 15px;padding-left: 15px;'>
                        <div class='card-deck'>
                        <a href='request-detail.php?tender=".urlencode($title)."'>
                            <div class='card'>
                            <img style='border:3px solid chocolate;width: 250px;height: 180px;object-fit: cover;margin-left: 0px;' src='assets/".$image."'>
                                <div class='card-body'>
                                <h6 class='card-sub align-middle' id='title'>" .$title. "</h6>        
                                <p class='desc' style='color:black;text-overflow: ellipsis;' >".$desc."</p>
                                    <small><p class='time-card' style='color:red'>Request End Date : ".$date."</p></small>
                                </div>
                            </div>
                            </a>
                        </div>
                        </div>";
                }
            }
                else{
                    echo "<h4><b style='color:red'>NO REQUEST FOUND !</b></h4>";
                    echo " <br>
                    <br><br><br>";
                   
                    // echo
                    // "<script language=javascript>
                    // alert('NO REQUEST FOUND !');
                    // document.location.href = 'tender.php';
                    // </script>
                    // ";
                    // $_POST=array();
                }
                
            }
            $_POST=array();
        ?>
    </div>
</div>
</body>		
<?php include 'footer2.html'; ?>


<script src='js/jquery.js'></script>
<script src='js/plugins.js'></script>
<script src='js/scripts.js'></script>
<script src='js/masonry.pkgd.min.js'></script>
</html>