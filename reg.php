<?php include 'header.html';?>
<?php include "conn.php"; 
if (isset($_POST['submit']) AND isset($_POST['custname']) AND isset($_POST['email']))
{
    $ro = $_POST['role'];
    $uname = trim($_POST['custname']);
    $email = trim($_POST['email']);
    $num = trim($_POST['number']);
    $password = password_hash(trim($_POST['pass']), PASSWORD_DEFAULT);
    $address = trim($_POST['addr']);
    $city = $_POST['cityname'];
  
    if($ro == "Buyer") {
        
        $query1 = "INSERT INTO customer (cust_name,cust_phone,cust_address,cust_city,cust_email,cust_pass) VALUES 
        ('$uname','$num','$address','$city','$email','$password')";
        
        if ($conn->query($query1) === TRUE) {
            echo
            "<script language=javascript>
            alert('Register Success');
            document.location.href = 'account.php';
            </script>
            ";

          } else {
            echo '<script language="javascript">';
            echo 'alert("Error: " . $query1 . "<br>" . $conn->error;)';
            echo '</script>';
          }
          
          $conn->close();
          unset($ro,$uname,$num,$email,$password,$address,$city,$cquery,$query1);

    }
    elseif ($ro == "Craftman") {
        $query2 = "INSERT INTO company (comp_name,comp_address,comp_city,comp_email,comp_password) VALUES 
        ('$uname','$address','$city','$email','$password')";
        
        if ($conn->query($query2) === TRUE) {
            echo
            "<script language=javascript>
            alert('Register Success');
            document.location.href = 'account.php';
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


<style>
div#main{
	padding: 40px;
}
.form-control {
        width: 50%;
        display: inline;
    }
</style>
<body>
<div id="main" style="text-align:center">
    <h3>Customer Registration Form</h3>
    <hr>
        <form id="f1" method="POST">
            <h6>Register As :</h6>
            <h6><select name="role" class="form-control" required>
                <option default></option>
                <option value="Buyer">Buyer</option>
                <option value="Craftman">Craftman</option>
            </select></h6>
            <h6> Client / Company Name :</h6>
            <input type="text" class="form-control" id="custname" name="custname" placeholder="Enter name" required><br>
            <h6>Address :</h6>
            <input type="text" class="form-control" id="addr" name="addr" placeholder="Enter address" required><br>
            <h6>City :</h6>
            <h6><select name="cityname" class="form-control"
            onchange="if(this.options[this.selectedIndex].value=='customOption'){
                toggleField(this,this.nextSibling);
                this.selectedIndex='0';
            }" required>
            <option default></option>
            <?php 
                    $sql = mysqli_query($conn, "SELECT city_name FROM cities");
                    while ($row = $sql->fetch_assoc()){
                    echo "<option>" . $row['city_name'] . "</option>";
                    }
                    ?>
            </select></h6>
            <input name="cityname" style="display:none;" disabled="disabled" 
                onblur="if(this.value==''){toggleField(this,this.previousSibling);}">
            <h6>Phone Number :</h6>
            <input type="text" class="form-control" id="number" name="number" placeholder="62XXXXXXX" required><br>
            <h6>Email :</h6>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required><br>
            <h6><label for="pass">Password :</label><br></h6>
            <input type="password" class="form-control" id="pass" name="pass" placeholder="Enter Password" required><br><br>
            <button type="submit" class="btn btn-primary" name="submit">Sign Up</button>
        </form>
    <br>
    <h5>Already have an account ? <a href="account.php">Sign In</a></h5> 
</div>
</body>

<?php include 'footer2.html'; ?>