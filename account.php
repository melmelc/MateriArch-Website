<?php include 'header2.html';?>
<?php include 'conn.php';
session_start();

if(!empty($_POST["email"]) && !empty($_POST["pass"])) {
	setcookie ("email",$_POST["email"],time()+60);
	setcookie ("password",$_POST["pass"],time()+60);
} else {
	setcookie("username","");
	setcookie("password","");
}

?>
        <div style="padding:40px;">
            <h3>Login To Your Account</h2>
                
                <form action="loginHome.php" method="post">
                    <h6><label for="fname">Email :</label><br></h6>
                    <input type="text" id="email" name="email"> 
                    <br>
                    <h6><label for="pass">Password :</label><br></h6>
                    <input type="password" id="pass" name="pass"><br><br>
                    
                    <input type="submit" value="Login">
                    <br>
                </form>
                <h6>Don't have an account yet ? <a href="reg.php">Register Now</a></h6> 
                
        </div>
        <?php include 'footer2.html'; ?>
    </div>
    
</body>