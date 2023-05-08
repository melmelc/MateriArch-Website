<?php include 'header.html';
include 'conn.php';
?> 
<style>
div#main{
	padding: 20px;
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
	/* border:1px solid #96cecf;
	border-top:1px solid #96cecf;;  */
}

</style>
<body>
<div id="up" style="display: block;text-align:center;padding-top:30px;">
<h3>Trending Material</h3>
</div>
<div id="main" style="display:flex">
<?php 

  $id = 1;
  $query = "SELECT * from category WHERE category_id=".$id;
  if($conn->query($query) == TRUE) {
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $category = $row['category_name'];
    $image = $row['cat_pic'];
    echo "<div class='container'>
<div class='card-deck'>
  <a href='http://google.com'>
      <div class='card'>
        <img style='clip-path:circle()' src='assets/Vector.png'>
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


?>
	
  <div class="container">
    <div class="card-deck">
      <a href="http://google.com">
          <div class="card">
            <img style="clip-path:circle()" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/64/Alberobello_BW_2016-10-16_13-43-03.jpg/250px-Alberobello_BW_2016-10-16_13-43-03.jpg" alt="Card image cap">
              <div class="card-body">
              <h3 class="card-sub align-middle">Card Title</h3>
              <p class="desc">Lorem ipsum dolor sit amet</p>
                <small><p class="time-card">2 Days Ago</p></small>
            </div>
        
          </div>
        </a>
    </div>
  </div>
  <div class="container">
    <div class="card-deck">
      <a href="http://google.com">
          <div class="card">
            <img style="clip-path:circle()" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/64/Alberobello_BW_2016-10-16_13-43-03.jpg/250px-Alberobello_BW_2016-10-16_13-43-03.jpg" alt="Card image cap">
              <div class="card-body">
              <h3 class="card-sub align-middle">Card Title</h3>
              <p class="desc">Lorem ipsum dolor sit amet</p>
                <small><p class="time-card">2 Days Ago</p></small>
            </div>
        
          </div>
        </a>
    </div>
  </div>
<!-- <div class="card m-5" style="width: 300px;text-align:center">

  <img src="https://assets.codepen.io/6093409/mountains-1.jpg" alt="a snow-capped mountain range"/>
  <div class="card-body">
    <h2 class="card-title">Mountains</h2>
    <p class="card-text">This is a photo of snowy-covered mountains. How majestic.</p>
    <a href="#" class="btn btn-secondary">Learn more</a>
  </div>
</div>
<div class="card m-5" style="width: 300px;text-align:center">
  <img src="https://assets.codepen.io/6093409/mountains-1.jpg" alt="a snow-capped mountain range">
  <div class="card-body">
    <h2 class="card-title">Mountains</h2>
    <p class="card-text">This is a photo of snowy-covered mountains. How majestic.</p>
    <a href="#" class="btn btn-secondary">Learn more</a>
  </div>
</div> -->
	</div>





</div>
</body>		
<?php include 'footer2.html'; ?>


<script src='js/jquery.js'></script>
<script src='js/plugins.js'></script>
<script src='js/scripts.js'></script>
<script src='js/masonry.pkgd.min.js'></script>
</html>