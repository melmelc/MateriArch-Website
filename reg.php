<?php include 'header.html';?>
<?php include "conn.php"; 
if (isset($_POST['submit']) AND isset($_POST['custname']) AND isset($_POST['email']))
{
    $ro = $_POST['role'];
    $uname = $_POST['custname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $address = $_POST['addr'];
    $city = $_POST['cityname'];
    $cquery = "SELECT city_id FROM cities WHERE city_name = '" .$city ."'";
    $result = $conn->query($cquery);
    $sresult = $result->fetch_array()[0] ?? '';
  
    if($ro == "Buyer") {
        
        $query1 = "INSERT INTO buyers (b_name,b_address,b_city,b_email,b_password) VALUES 
        ('$uname','$address','$sresult','$email','$password')";
        
        if ($conn->query($query1) === TRUE) {
            echo
            "<script language=javascript>
            alert('Sent Successfully');
            document.location.href = 'loginHome.php';
            </script>
            ";

          } else {
            echo '<script language="javascript">';
            echo 'alert("Error: " . $query1 . "<br>" . $conn->error;)';
            echo '</script>';
          }
          
          $conn->close();
          unset($ro,$uname,$email,$password,$address,$city,$cquery,$query1);

    }
    elseif ($ro == "Craftman") {
        $query2 = "INSERT INTO companies (c_name,c_address,c_city,c_email,c_pass) VALUES 
        ('$uname','$address','$sresult','$email','$password')";
        
        if ($conn->query($query2) === TRUE) {
            echo
            "<script language=javascript>
            alert('Sent Successfully');
            document.location.href = 'loginHome.php';
            </script>
            ";

          } else {
            echo '<script language="javascript">';
            echo 'alert("Error: " . $query2 . "<br>" . $conn->error;)';
            echo '</script>';
          }
          
          $conn->close();
          unset($ro,$uname,$email,$password,$address,$city,$cquery,$query2);
    }
}
?>


<script>
$(document).ready(function(){
    $('button[type="button"]').click(function(){
    	var rolevalue = $(this).val(); 
        $("div.myDiv").hide();
        $("#Form"+rolevalue).show();
    });
});
</script>
<script>
function toggleField(hideObj,showObj){
  hideObj.disabled=true;        
  hideObj.style.display='none';
  showObj.disabled=false;   
  showObj.style.display='inline';
  showObj.focus();}
</script>


<!-- <h2> Register As :</h2>
<form method="post">
    <button type="button" class="" name="role" value="Buyer" style="color:blue">Buyer</button>
    <button type="button" class="" name="role" value="Craftman" style="color:brown">Craftmen</button>
    <br>
    <br>
</form> -->
<!-- 
<div id="FormBuyer" class="myDiv" style="display: none;">
        <h2>Customer Registration Form</h2>
        <form id="f1" method="POST">
            <h4>Customer Name :</h4>
            <input type="text" id="custname" name="custname" placeholder="Enter name" style="width: 50%"><br><br>
            <h4>Address :</h4>
            <input type="text" id="addr" name="addr" placeholder="Enter address"><br><br>
            <h4>City :</h4>
            <h4><select name="cityname" 
            onchange="if(this.options[this.selectedIndex].value=='customOption'){
                toggleField(this,this.nextSibling);
                this.selectedIndex='0';
            }">
            <?php 
                    $sql = mysqli_query($conn, "SELECT city_name FROM cities");
                    while ($row = $sql->fetch_assoc()){
                    echo "<option>" . $row['city_name'] . "</option>";
                    }
                    ?>
            </select></h4>
            <input name="cityname" style="display:none;" disabled="disabled" 
                onblur="if(this.value==''){toggleField(this,this.previousSibling);}">
            <br>
            <h4>Email :</h4>
            <input type="text" id="email" name="email" placeholder="Enter email"><br>
            <h5><label for="pass">Password :</label><br></h5>
            <input type="password" id="pass" name="pass" placeholder="Enter Password"><br><br>
            <button type="submit" class="btn btn-primary" name="submit">Sign Up</button>
        </form>
    </div>

    <div id="FormCraftman" class="myDiv" style="display: none;">
        <h2>Craftmen / Company Registration Form</h2>
        <br>
        <form id="f2" method="POST" >
            <h4>Craftmen / Company Name :</h4>
            <input type="text" id="cname" name="cname" placeholder="Enter name" required><br><br>
            <h4>Address :</h4>
            <input type="text" id="addr2" name="addr2" placeholder="Enter address" required><br><br>
            <h4>City :</h4>
            <h4><select name="cityname" 
            onchange="if(this.options[this.selectedIndex].value=='customOption'){
                toggleField(this,this.nextSibling);
                this.selectedIndex='0';
            }">
            <?php 
                    $sql = mysqli_query($conn, "SELECT city_name FROM cities");
                    while ($row = $sql->fetch_assoc()){
                    echo "<option>" . $row['city_name'] . "</option>";
                    }
                    ?> 
            </select></h4>
            <input name="cityname" style="display:none;" disabled="disabled" 
                onblur="if(this.value==''){toggleField(this,this.previousSibling);}">
            <br>
            <h4>Email :</h4>
            <input type="text" id="email2" name="email2" placeholder="Enter email" required><br><br>
            <h4>Password :</h4>
            <input type="password" id="pass2" name="pass2" placeholder="Enter password" required><br><br>
            <button type="submit" class="btn btn-primary" name="submit">Sign Up</button>
        </form>
    </div> -->



    <h2>Customer Registration Form</h2>
        <form id="f1" method="POST">
            <h4>Register As :</h4>
            <h4><select name="role" required>
                <option value="Buyer">Buyer</option>
                <option value="Craftman">Craftman</option>
            </select></h4>
            <h4> Client / Company Name :</h4>
            <input type="text" id="custname" name="custname" placeholder="Enter name" required><br><br>
            <h4>Address :</h4>
            <input type="text" id="addr" name="addr" placeholder="Enter address" required><br><br>
            <h4>City :</h4>
            <h4><select name="cityname" 
            onchange="if(this.options[this.selectedIndex].value=='customOption'){
                toggleField(this,this.nextSibling);
                this.selectedIndex='0';
            }">
            <?php 
                    $sql = mysqli_query($conn, "SELECT city_name FROM cities");
                    while ($row = $sql->fetch_assoc()){
                    echo "<option>" . $row['city_name'] . "</option>";
                    }
                    ?>
            </select></h4>
            <input name="cityname" style="display:none;" disabled="disabled" 
                onblur="if(this.value==''){toggleField(this,this.previousSibling);}">
            <br>
            <h4>Email :</h4>
            <input type="text" id="email" name="email" placeholder="Enter email" required><br>
            <h5><label for="pass">Password :</label><br></h5>
            <input type="password" id="pass" name="pass" placeholder="Enter Password" required><br><br>
            <button type="submit" class="btn btn-primary" name="submit">Sign Up</button>
        </form>
<br>
<br>


<h5>Already have an account ? <a href="account.php">Sign In</a></h5> 
</div>
<?php include 'footer.html'; ?>
</div>
</body>