<?php include 'header.html';?>
<?php include 'conn.php';

if(isset($_POST['sub'])) {   
    if(isset($_POST['email']) and isset($_POST['pass']) and isset($_POST['role'])) {
        $user_email = trim($_POST['email']);
        $user_pass = trim($_POST['pass']);
        $user_ro = $_POST['role'];
        
        
        if($user_ro == "Buyer") {
            $userq = "SELECT customer_email, customer_pass FROM customer WHERE customer_email = '".$user_email."'";
            $result = $conn->query($userq);
            $output=mysqli_fetch_row($result);
            $hashed_password=$output[0]["password"];
            echo($hashed_password);
            if(password_verify($user_pass,$hashed_password))
            {
                echo("PASSWORD MATCH");
            }
            else{
                echo '<script language="javascript">';
                echo 'alert("Error: Invalid Email or Password !!". "<br>" . $conn->error;)';
                echo '</script>';
            }
            
        }
        else if($user_ro == "Craftman") {
            $userq = "SELECT company_email, company_password FROM company WHERE company_email = '".$user_email."'";
            $result = $conn->query($userq);
            if($conn->query($userq) == TRUE) {
            $output=mysqli_fetch_all($result);
            $hashed_password=$output[0]["password"];
                if(password_verify($user_pass,$hashed_password))
                {
                    echo("PASSWORD MATCH");
                }
                else{
                    echo '<script language="javascript">';
                    echo 'alert("Error: Invalid Email or Password !!". "<br>" . $conn->error;)';
                    echo '</script>';
                }
            }
            
            
        }
        // setcookie($user_email,$user_pass, time()+180);
        // header("Location:http://localhost:80/Proyek-ManproTI/loginHome.php");
    }    
}


?>
<style>
div#main{
	padding: 40px;
}
</style>
<body>
    <div id="main">
        <?php 
        if(isset($_POST['email']) and isset($_POST['pass']) and isset($_POST['role'])) {
            $user_email = trim($_POST['email']);
            $user_pass = trim($_POST['pass']);
            $user_ro = $_POST['role'];
        echo $user_email;
        echo $user_pass;
        echo $user_ro;
        }
        ?>
    <h3>Login To Your Account</h2>       
            <form method="POST">
                <h6>Login As :</h6>
                <h6>
                    <select name="role" required>
                        <option default></option>
                        <option value="Buyer">Buyer</option>
                        <option value="Craftman">Craftman</option>
                    </select>
                </h6>
                <h6><label for="email">Email :</label></h6>
                <input type="text" id="email" name="email" required> 
                <br>
                <br>
                <h6><label for="pass">Password :</label></h6>
                <input type="password" id="pass" name="pass" required><br><br>
                <button type="submit" value="sub">Sign In</button>
            </form>
            <br>
            <br>
            <h6>Don't have an account yet ? <a href="reg.php">Register Now</a></h6>
    </div>      
</body>
<?php include 'footer2.html'; ?>