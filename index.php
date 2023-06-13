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
p {
  white-space:break-spaces;
  word-wrap: break-word;
}

</style>
<body>
<div id="up" style="display: block;text-align:center;padding-top:30px;">
<h3>Materials Category</h3>
</div>
<div id="main" style="display:flex;overflow:scroll;scroll-behavior:smooth">
<?php 
  $query = "SELECT * from category ORDER BY category_name ASC";
  if($conn->query($query) == TRUE) {
    $result = $conn->query($query);
    while($row = $result->fetch_assoc()) {
    
    $category = $row['category_name'];
    $image = $row['cat_pic'];
    echo "<div class='container'>
<div class='card-deck'>
  <a href='tender.php' style='color:black'>
      <div class='card'>
        <img style='border:3px solid chocolate; width: 250px;height: 180px;object-fit: cover;' src='assets/".$image."'>
          <div class='card-body'>
          <h3 class='card-sub align-middle'>" .$category. "</h3>
          <p class='desc'>".$row['cat_desc']."</p>
        </div>
    
      </div>
    </a>
</div>
</div>";

  }
}



?>
	

</div>
</body>		
<?php include 'footer2.html'; ?>


<script src='js/jquery.js'></script>
<script src='js/plugins.js'></script>
<script src='js/scripts.js'></script>
<script src='js/masonry.pkgd.min.js'></script>
</html>