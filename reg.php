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
        if(isset($_FILES['myfile']['name'])){
            $file = $_FILES['myfile']['name'];
            $query1 = "INSERT INTO customer (cust_name,cust_phone,cust_address,cust_city,cust_email,cust_pass,picture) VALUES 
            ('$uname','$num','$address','$city','$email','$password','$file')";
        }
        else{
        $query1 = "INSERT INTO customer (cust_name,cust_phone,cust_address,cust_city,cust_email,cust_pass) VALUES 
        ('$uname','$num','$address','$city','$email','$password')";
        }
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
          $_POST=array();
          $conn->close();
          unset($ro,$uname,$num,$email,$password,$address,$city,$cquery,$query1);

    }
    elseif ($ro == "Craftman") {
        if(isset($_FILES['myfile']['name'])){
            $file = $_FILES['myfile']['name'];
        $query2 = "INSERT INTO company (comp_name,comp_address,comp_city,comp_email,comp_password,picture) VALUES 
        ('$uname','$address','$city','$email','$password','$file')";
        }
        else{
            $query2 = "INSERT INTO company (comp_name,comp_address,comp_city,comp_email,comp_password) VALUES 
        ('$uname','$address','$city','$email','$password')";
        }
        
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
          $_POST=array();
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="script.js"></script>
<body>
<div id="main" style="text-align:center">
    <h3>Customer Registration Form</h3>
    <hr>
        <form id="f1" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
            <label for="myfile" class="form-label">Profile Picture (Optional)</label>
            <input class="form-control" style="width:30%" type="file" id="myfile" name="myfile" accept="image/*">
            </div>
            <h6>Register As :</h6>
            <h6><select name="role" class="form-control" required>
                <option default value="">Select Role</option>
                <option value="Buyer">Buyer</option>
                <option value="Craftman">Craftman</option>
            </select></h6>
            <h6> Client / Company Name :</h6>
            <input type="text" class="form-control" id="custname" name="custname" placeholder="Enter name" required><br>
            <h6>Address :</h6>
            <input type="text" class="form-control" id="addr" name="addr" placeholder="Enter address" required><br>
            <h6>Provinsi :</h6>
            <h6><select id="state" class="form-control" required>
            <option value="" default>--Select State--</option>
            <?php 
                    $sql = mysqli_query($conn, "SELECT * FROM provinsi");
                        while ($row = $sql->fetch_assoc()){
                        ?>
                    <option value="<?php echo $row['prov_id'] ?>">
                        <?php echo $row['prov_name'] ?>
                    </option>   
                   <?php   }  ?>
            </select></h6>
            <h6>Kota :</h6>
            <h6><select id="city" name="cityname" class="form-control" required>
            <option value="" default>--Select City--</option>
            </select></h6>
            <script>
                $(document).ready(function() {
                // When the state selection changes

                $('#state').change(function() {
                    var stateId = $(this).val(); // Get the selected state ID
                    
                    // Clear the city selection
                    $('#city').empty().html('<option value="">Select city</option>');
                    
                    // Make an AJAX request to get cities based on the selected state
                    $.ajax({
                    url: 'ajax_getcity.php', // The PHP file to handle the request
                    method: 'POST',
                    data: { stateId: stateId }, // Send the selected state ID
                    success: function(response) {
                        // Populate the city selection with the received cities
                        $('#city').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        // Handle any error that occurred during the AJAX request
                    }
                    });
                });
                });

            </script>


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