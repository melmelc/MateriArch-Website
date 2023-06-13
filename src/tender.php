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
if(isset($_GET['category'])){
    $ctg= $_GET['category'];
}
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
    <div style="display:flex;justify-content: space-between;">
                <h3>Requests you have posted</h3>
            <div style="width:30%">
                <form method='post'>
                    <label for="filter"><b>Filter : </b></label>
                    <select name="filter" class="form-control" style="width:60%;display:inline-flex;">
                    <option value="All">All</option>
                        <?php 
                                $sql = mysqli_query($conn, "SELECT * FROM category");
                                while ($row = $sql->fetch_assoc()){
                                echo "<option>" . $row['category_name'] . "</option>";
                                }
                            ?>
                        </select>
                        <input name="filter" style="display:none;" disabled="disabled" 
                        onblur="if(this.value==''){toggleField(this,this.previousSibling);}">
                        <button class="btn btn-success" name="sub">Search</button>
                </form>
            </div>
        </div>
        <hr>
        
        <div style="display:flex;overflow-x:scroll;scroll-behavior:smooth">
        <?php
        $query = "SELECT * FROM request_order WHERE cust_id=".$c_id." ORDER BY ro_date ASC";
            if(isset($_POST['sub'])) {
                $temp = $_POST['filter'];
                if($temp != "All") {
                $query = "SELECT * FROM request_order WHERE cust_id=".$c_id." AND ro_category='".$temp."' ORDER BY ro_date ASC";
            }
            }
            else{
                $query = "SELECT * FROM request_order WHERE cust_id=".$c_id." ORDER BY ro_date ASC";
            }
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
                            <img style='border:3px solid chocolate;width: 100%;height: 180px;object-fit: cover;margin-left: 0px;' src='../assets/".$image."'>
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
        <br><br>
        
        <h3>Add New Request</h3>
        <div>
            <form action="#" method="POST" enctype="multipart/form-data" class='form-control'>
                <label for="title"><h6>Request Title :</h6></label>
                <input type="text" id="title" class="form-control" name="title" required><br>
                    <div style="display:flex;justify-content:space-between" >
                        <div>
                            <label for="qty"><h6>Material Category :</h6></label>
                            <select id="category" style="width:100%" class="form-control" name="category" required>
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
                        </div>
                        <div>
                            <label for="qty"><h6>Request Quantity :</h6></label>
                            <input type="number" id="qty" class="form-control" style="width:100%" name="qty" min="5" max="10000" required><br>
                        </div>
                        <div class="mb-3">
                            <label for="myfile"><h6>Select design files :</h6></label>
                            <input class="form-control" style="width:100%" type="file" id="myfile" name="myfile" accept="image/*">
                            <small style="color:red;">(Please include the size dimension in the submitted file.)</small>
                        </div>
                        <div>
                            <label for="date"><h6>Request Deadline :</h6></label>
                            <input type="date" id="date" name="date" class="form-control" required>
                            <small><p>Choose End Date for the request</p></small>
                        </div>
                    </div>
                <label for="desc"><h6>Describe your request in the field below as clear as possible</h6></label>
                <input type="text" name="desc" class="form-control" style="height:100px; display:flex;text-align:center" placeholder="Describe your request here" required>
                <br>
                <input type="checkbox" id="agreement" name="agreement" >
                <label for="agreement">Allow my design to be used by others for commercial purposes</label><br>
                <p style="color:red"><small>(By filling this checkbox, I allow my design to be used by others)</small></p>
                <button class="btn btn-primary" style="width:100%" name="sub">Submit</button>
            </form>
        </div>
    </div>
</body>


<?php include 'footer2.html'; ?>