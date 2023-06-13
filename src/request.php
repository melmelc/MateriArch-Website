<?php include 'headerA.html'; ?>
<?php include 'conn.php'; 
session_start();
if (!isset($_SESSION['customer_id']))
{   
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
$ctg= $_GET['category'];

if(isset($_POST['sub']) and isset($_POST['title'])) {
    $title = trim($_POST['title']);
    $date = $_POST['date'];
    $qty = $_POST['qty'];
    $ctg = $_POST['category'];
    $desc = $_POST['desc'];
    $file = $_FILES['myfile']['name'];
    $agree = "";
    if(isset($_POST['agreement'])) {
        $agree = "yes";
    }
    else{
        $agree = "no";
    }
    $sql = "INSERT INTO request_order (cust_id, ro_title, ro_category, ro_desc, ro_qty, ro_date, ro_design, agree)
    VALUES ('$c_id','$title','$ctg','$desc','$qty','$date','$file','$agree')"; 
    if($conn->query($sql) == TRUE) {
        echo
        "<script language=javascript>
        alert('New Request Added Successfully');
        document.location.href = 'tender.php';
        </script>
        ";
        $_POST = array();
    
    }
    else{
        echo  $conn->error;
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
	/* border:1px solid #96cecf;
	border-top:1px solid #96cecf;;  */
}

</style>
<body>
    <div id="main">
        <div>
            <h3>Add new request</h3>
            <form action="#" method="POST" enctype="multipart/form-data">
                <label for="date"><h6>Request Deadline :</h6></label>
                <input type="date" id="date" name="date" placeholder="DD-MM-YYYY" required>
                <small><p>Fill the date where the material needs to be fully received</p></small>
                <label for="title"><h6>Request Title :</h6></label>
                <input type="text" id="title" name="title" required><br>
                <label for="qty"><h6>Request Quantity :</h6></label>
                <input type="number" id="qty" name="qty" min="100" max="10000" required><br>
                <label for="qty"><h6>Material Category :</h6></label>
                <select id="category" name="category" required>
                    <option default></option>
                    <?php
                     $sql = "SELECT category_name FROM category";
                     $result=$conn->query($sql);
                     if($result->num_rows>0){
                         while($row=$result->fetch_assoc()){
                             echo "<option>".$row['category_name']."</option>";
                         }
                     }
                    ?>
                </select>
                <br>
                <label for="title"><h6>Select design files :</h6></label>
                <input type="file" id="myfile" name="myfile" accept="image/*,.pdf" required>
                <p style="color:red"><small>(Please include the size dimension in the submitted file.)</small></p>
                
                <label for="desc">Describe your request in the field below as clear as possible</label>
                <input type="text" name="desc" style="width: 800px;height:100px; display:flex;text-align:center" placeholder="Describe your request here" required>
                <input type="checkbox" id="agreement" name="agreement" >
                <label for="agreement">Allow my design to be used by others for commercial purposes</label><br>
                <p style="color:red"><small>(By filling this checkbox, I allow my design to be used by others)</small></p>
                <button type="submit" name="sub">Submit</button>
            </form>
        </div>
        <br>
        <br>
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
            
            <option value="All">All</option>
            <?php 
                    $sql = mysqli_query($conn, "SELECT * FROM category");
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
        <?php
            if(isset($ctg)) {
                $query = "SELECT * FROM request_order WHERE cust_id=".$c_id." AND ro_category='".$ctg."'";
                
            }
            else {
                $query = "SELECT * FROM request_order WHERE cust_id=".$c_id;
            }
            
            if(isset($_POST['sub'])) {
                $temp = $_POST['filter'];
                $query = "SELECT * FROM request_order WHERE cust_id=".$c_id." AND ro_category='".$temp."'";
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
                        <a href='tender-detail.php?title=".urlencode($title)."'>
                            <div class='card'>
                            <img style='border:3px solid chocolate; border-radius: 50%; width: 180px;height: 180px;object-fit: cover; margin-left:32px' src='../assets/".$image."'>
                                <div class='card-body'>
                                <h3 class='card-sub align-middle' id='title'>" .$title. "</h3>
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
        ?>
        </div>
    </div>
</body>


<?php include 'footer2.html'; ?>