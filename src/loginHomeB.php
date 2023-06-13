<?php include 'headerB.html';
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
<div id="main">
<h3 style='text-align:center'>Recently Added Requests</h3>
<br>
	<div style="display:flex;overflow-x:auto;scroll-behavior:smooth">
  
<?php 
   $query = "SELECT * FROM request_order ro WHERE status != 'Awaiting Payment' AND status != 'Done' AND ro_date >= CURRENT_DATE ORDER BY ro_date DESC";
   $result = mysqli_query($conn, $query);
  if($conn->query($query) == TRUE) {
    $result = $conn->query($query);
    while($row = mysqli_fetch_assoc($result)) {
    $title = $row['ro_title'];
    $image = $row['ro_design'];
    echo "<div class='container'>
          <div class='card-deck'>
            <a href='tender_list.php' style='color:black'>
                <div class='card'>
                  <img style='border:3px solid chocolate;width: 250px;height: 180px;object-fit: cover;margin-left: 0px;' src='../assets/".$image."'>
                    <div class='card-body'>
                    <h3 class='card-sub align-middle'>" .$title. "</h3>
                    <p class='desc'>" .$row['ro_desc']. "</p>
                      <small><p class='time-card'>" .$row['ro_date']. "</p></small>
                  </div>
              
                </div>
              </a>
          </div>
          </div>";
            }
          }
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