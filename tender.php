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
        <div>
            <h3>Add new request</h3>
            <form action="#">
                <label for="date"><h6>Request Deadline :</h6></label>
                <input type="date" id="date" name="date" placeholder="dd/mm/yyyy">
                <small><p>Fill the date where the material needs to be fully received</p></small>
                <label for="title"><h6>Request Title :</h6></label>
                <input type="text" id="title" name="title" required><br>
                <label for="qty"><h6>Request Quantity :</h6></label>
                <input type="number" id="qty" name="qty" min="50" max="10000" required><br>
                <label for="qty"><h6>Material Category :</h6></label>
                <select id="category" name="category" required>
                    <option default></option>
                    <?php
                     $sql = mysqli_query($conn, "SELECT category_name FROM category");
                     while ($row = $sql->fetch_assoc()){
                     echo "<option>" . $row['category_name'] . "</option>";
                     }
                    ?>
                </select>
                <br>
                <label for="title"><h6>Select design files :</h6></label>
                <input type="file" id="myfile" name="myfile" accept="image/*,.pdf" multiple required>
                <p><small>(Please include the size dimension in the submitted file.)</small></p>
                <input type="submit">
            </form>
        </div>
        <br>
        <br>
        <div style="display: flex;">
            <h3>Requests you have posted</h3>
            &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
            <form method='post'>
            <label for="filter">Filter :</label>
            <select name="filter" 
            onchange="if(this.options[this.selectedIndex].value=='customOption'){
                toggleField(this,this.nextSibling);
                this.selectedIndex='0';
            }" required> <h4>
            <option default value="All">All</option>
            <?php 
                    $sql = mysqli_query($conn, "SELECT category_name FROM category");
                    while ($row = $sql->fetch_assoc()){
                    echo "<option>" . $row['category_name'] . "</option>";
                    }
                    ?>
             </h4></select>
            <input name="filter" style="display:none;" disabled="disabled" 
                onblur="if(this.value==''){toggleField(this,this.previousSibling);}">
            <button type="submit" name="sub">Search</button>
            </form>
            
        </div>
        
        <div style="display:flex;overflow-x:auto;scroll-behavior:smooth">
        <?php if(isset($_POST['sub']) and isset($_POST['filter'])) {
    $temp = $_POST['filter'];
    if($temp == "All") {
        $query = "SELECT * FROM request_order";
    }
    else if($temp != "All") {
        $query = "SELECT * FROM request_order WHERE ro_category='".$temp."'";
    }
    if($conn->query($query) == TRUE) {
        $result = $conn->query($query);
        $row = $result->fetch_array();
        $count = $result->num_rows;
        if($count > 0) {
            $title = $row['ro_title'];
        $category = $row['ro_category'];
        $image = $row['ro_design'];
        echo "<div class='container'>
    <div class='card-deck'>
      <a href='tender-detail.php'>
          <div class='card'>
            <img src='assets/Vector.png'>
              <div class='card-body'>
              <h3 class='card-sub align-middle'>" .$title. "</h3>
              <h3 class='card-sub align-middle'>" .$category. "</h3>
              <p class='desc'>Lorem ipsum dolor sit amet</p>
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
}

?>
        </div>
        
    </div>
    
</body>

<?php include 'footer2.html'; ?>