<?php include 'headerA.html'; ?>
<?php include 'conn.php'; 




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
            <img style="width:50%" src="assets/ERD Manpro 8.jpg" >
            <div id="content">
            <h3>TITLE LOREM IPSUM DOLOR SIT AMET</h3>
            <h5>CATEGORY NAME</h5>
            <h4>DEADLINE DATE</h4>
            <h4>REQUESTED QTY</h4>
            <h6>REQUEST DESCRIPTION</h6>
            <p>dljjjjddaaaaaaaaaaaa faaaaaaaaaa avvvvvvvvvvvvvvvvvvvvvvv vaaaaaa</p>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <div>
            <h3>Offers from companies : </h3>
            <div id="offer" style="display:flex;overflow-x:auto;scroll-behavior:smooth">
            <?php 
        $query = "SELECT * FROM request_order ro JOIN tender t on ro.ro_id = t.ro_id JOIN company c on t.comp_id = c.comp_id";
        if($conn->query($query) == TRUE) {
            $result = $conn->query($query);
            $row = $result->fetch_array();
            $count = $result->num_rows;
            if($count > 0) {
                $name = $row['comp_name'];
            $price= $row['offered_price'];
            $loc = $row['comp_address'];
            echo "<div class='container'>
        <div class='card-deck'>
        <a href='http://google.com'>
            <div class='card'>
                <img src='assets/Vector.png'>
                <div class='card-body'>
                <h3 class='card-sub align-middle'>" .$name. "</h3>
                <h3 class='card-sub align-middle'>" .$price. "</h3>
                <p class='desc'>".$loc."</p>
                    <small><p class='time-card'>2 Days Ago</p></small>
                </div>
            
            </div>
            </a>
        </div>
        </div>";
            }
            else{
                echo "NO DATA FOUND";
            }
            
        }
    ?>
            </div>
        </div>
       
        
    </div>
    
</body>

<?php include 'footer2.html'; ?>