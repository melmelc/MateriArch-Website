<?php
include "conn.php";
include "header.html";
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}



$user_email = $user_password = $company_email = $company_password = "";
$user_email_err = $password_err = $company_email_err = $company_password_err = "";
$user_role = $_POST['role'];

if(isset($_POST['role']) and isset($_POST['sub'])) {
    if($user_role == "Buyer") {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(empty(trim($_POST["email"]))){
                $user_email_err = "Please enter your email";
            } else {
                $user_email = trim($_POST["email"]);
            }
        }
    
        if(empty(trim($_POST["password"]))){
            $user_password_err = "Please enter your password";
        } else {
            $user_password = trim($_POST["password"]);
        }
    
        if(empty($user_email_err) && empty($user_password_err)){
            $sql = "SELECT cust_id, cust_email, cust_pass FROM customer WHERE cust_email = ?";
    
            if($stmt = mysqli_prepare($conn, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_user_email);
    
                $param_user_email = $user_email;
    
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        mysqli_stmt_bind_result($stmt, $customer_id, $user_email, $hashed_password);
                        if(mysqli_stmt_fetch($stmt)){
                            if(password_verify($user_password, $hashed_password)){
                                session_start();
    
                                $_SESSION["loggedin"] == true;
                                $_SESSION["customer_id"] = $customer_id;
                                $_SESSION["email"] = $user_email;
    
                                header("location: loginHome.php");
    
                            }else {
                                $user_password_err = "The password you entere was not valid";
                            }
                        }
                    } else {
                        $user_email_err = "No email found";
                    }
                } else {
                    echo "Having trouble.";
                }
    
                mysqli_stmt_close($stmt);
            }
        }
    
        mysqli_close($conn);
    }
    
    else if($user_role == "Craftman") {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(empty(trim($_POST["email"]))){
                $company_email_err = "Please enter your email";
            } else {
                $company_email = trim($_POST["email"]);
            }
        }
    
        if(empty(trim($_POST["password"]))){
            $company_password_err = "Please enter your password";
        } else {
            $company_password = trim($_POST["password"]);
        }
    
        if(empty($company_email_err) && empty($company_password_err)){
            $sql = "SELECT comp_id, comp_email, comp_password FROM company WHERE comp_email = ?";
    
            if($stmt = mysqli_prepare($conn, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_company_email);
    
                $param_company_email = $company_email;
    
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        mysqli_stmt_bind_result($stmt, $company_id, $company_email, $hashed_password);
                        if(mysqli_stmt_fetch($stmt)){
                            if(password_verify($company_password, $hashed_password)){
                                session_start();
    
                                $_SESSION["loggedin"] == true;
                                $_SESSION["company_id"] = $company_id;
                                $_SESSION["email"] = $company_email;
    
                                header("location: loginHomeB.php");
    
                            }else {
                                $company_password_err = "The password you entere was not valid";
                            }
                        }
                    } else {
                        $company_email_err = "No email found";
                    }
                } else {
                    echo "Having trouble.";
                }
    
                mysqli_stmt_close($stmt);
            }
        }
    
        mysqli_close($conn);
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
                <input type="password" id="password" name="password" required><br><br>
                <button type="submit" name="sub">Sign In</button>
                <br>
            </form>
            <br>
            <h6>Don't have an account yet ? <a href="reg.php">Register Now</a></h6>
    </div>      
</body>
<?php include 'footer2.html'; ?>

