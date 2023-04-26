<?php include 'header2.html';?>
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
          unset($ro,$uname,$email,$password,$address,$city,$cquery,$query1);

    }
    elseif ($ro == "Craftman") {
        $query2 = "INSERT INTO companies (c_name,c_address,c_city,c_email,c_pass) VALUES 
        ('$uname','$address','$sresult','$email','$password')";
        
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



<div style="padding:40px;">
    <h3>Customer Registration Form</h3>
        <form id="f1" method="POST">
            <h6>Register As :</h6>
            <h6><select name="role" required>
                <option value="Buyer">Buyer</option>
                <option value="Craftman">Craftman</option>
            </select></h6>
            <h6> Client / Company Name :</h6>
            <input type="text" id="custname" name="custname" placeholder="Enter name" required><br>
            <h6>Address :</h6>
            <input type="text" id="addr" name="addr" placeholder="Enter address" required><br>
            <h6>City :</h6>
            <h6><select name="cityname" 
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
            </select></h6>
            <input name="cityname" style="display:none;" disabled="disabled" 
                onblur="if(this.value==''){toggleField(this,this.previousSibling);}">
            <h6>Email :</h6>
            <input type="text" id="email" name="email" placeholder="Enter email" required><br>
            <h6><label for="pass">Password :</label><br></h6>
            <input type="password" id="pass" name="pass" placeholder="Enter Password" required><br><br>
            <button type="submit" class="btn btn-primary" name="submit">Sign Up</button>
        </form>
    <br>
    <h5>Already have an account ? <a href="account.php">Sign In</a></h5> 
</div>

<?php include 'footer2.html'; ?>
</body>