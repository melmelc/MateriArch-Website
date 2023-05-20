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
</style>
<body>
<div id="main">
	<div style="display:flex;">
<?php 
  $arr = array();
  while(true) {
  $id = random_int(1,5);
  if(!in_array($id,$arr)) {
    array_push($arr,$id);
  }
  if(sizeof($arr) == 4) {
    break;
  }
}
  
  foreach($arr as $i) {
  $query = "SELECT * from category WHERE category_id=".$i;
  if($conn->query($query) == TRUE) {
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $category = $row['category_name'];
    $image = $row['cat_pic'];
    echo "<div class='container'>
          <div class='card-deck'>
            <a href='http://google.com'>
                <div class='card'>
                  <img style='border:3px solid chocolate; border-radius: 50%; width: 200px;height: 200px;object-fit: cover; margin-left:10px' src='assets/".$image."'>
                    <div class='card-body'>
                    <h3 class='card-sub align-middle'>" .$category. "</h3>
                    <p class='desc'>Lorem ipsum dolor sit amet</p>
                      <small><p class='time-card'>2 Days Ago</p></small>
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