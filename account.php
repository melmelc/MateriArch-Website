<?php include 'header.html';?>
<?php
session_start();

if(!empty($_POST["email"]) && !empty($_POST["pass"])) {
	setcookie ("email",$_POST["email"],time()+60);
	setcookie ("password",$_POST["pass"],time()+60);
} else {
	setcookie("username","");
	setcookie("password","");
}

?>

                <h2>Login To Your Account</h2>
                
                <form action="loginHome.php" method="post">
                    <h5><label for="fname">Email :</label><br></h5>
                    <input type="text" id="email" name="email" value=<?php if(isset($_COOKIE["email"])) { $_COOKIE["email"]; } ?>> 
                    <br>
                    <h5><label for="pass">Password :</label><br></h5>
                    <input type="password" id="pass" name="pass" value=123><br><br>
                    
                    <input type="submit" value="Login">
                    <br>
                </form>
                <h5>Don't have an account yet ? <a href="reg.php">Register Now</a></h5> 
                
        </div>
        <?php include 'footer.html'; ?>
    </div>
    
</body>