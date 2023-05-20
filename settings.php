<?php include 'conn.php'; ?>
<?php include 'headerA.html';
session_start();
if (!isset($_SESSION['customer_id'])) {
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

$query= "SELECT * FROM customer where cust_id=".$c_id;
if($conn->query($query) == TRUE) {
	$result = $conn->query($query);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	$name = $row['cust_name'];
	$email = $row['cust_email'];
	$phone = $row['cust_phone'];
	$address = $row['cust_address'];
	$city = $row['cust_city'];
} 

if(isset($_POST['updateacc'])) {
	$uname = trim($_POST['uname']);
	$uemail = trim($_POST['uemail']);
	$unumber = trim($_POST['unumber']);
	$ct = $_POST['ct'];
	$uadr = trim($_POST['uadr']);
	$upd = "UPDATE customer SET
    cust_name = '$uname',
    cust_phone = '$unumber',
    cust_address = '$uadr',
    cust_city = '$ct',
    cust_email = '$uemail' 
	WHERE cust_id=".$c_id;

	if($conn->query($upd) == TRUE){
		echo "<script>alert('Account Updated Successfully')</script>";
	}
	else{
		echo "<script>alert('Error Updating Account')</script>";
	}
}
if(isset($_POST['updatepass'])) {
	$upass = trim($_POST['old']);
	$npass = trim($_POST['new']);
	$cpass = trim($_POST['new2']);

	$res = mysqli_prepare($conn,"SELECT cust_pass FROM customer WHERE cust_id=".$c_id);
	mysqli_stmt_execute($res);
	mysqli_stmt_store_result($res);
    if(mysqli_stmt_num_rows($res) == 1){
		mysqli_stmt_bind_result($res,$hashed_password);
		if(mysqli_stmt_fetch($res)){
			if(password_verify($upass, $hashed_password)){
				if($npass == $cpass){
					$cpass = password_hash($npass, PASSWORD_DEFAULT);
				if($conn->query("UPDATE customer SET cust_pass='$cpass' WHERE cust_id=".$c_id) == TRUE){
					echo
				"<script language=javascript>
				alert('Password update success !!');
				document.location.href = 'settings.php';
				</script>
				";
				$_POST = array();
				exit;
				session_destroy();
				}
			}
			else{
				echo
				"<script language=javascript>
				alert('The password you entered was not valid');
				document.location.href = 'settings.php';
				</script>
				";
			}
		}	
	}
}
}



?>
<style>
div#main{
	padding: 40px;
}
.container {
    width: 100%;
    margin-right: auto;
    margin-left: 60px;
}
</style>

<body>
    <div id=main>
	<section>
		<div class="container">
			<h2>Settings</h2>
			<div class="bg-white shadow rounded-lg d-block d-sm-flex">
				<div class="profile-tab-nav border-right">
					<div class="p-4">
						<div class="img-circle text-center mb-3">
							<img src="https://clipground.com/images/account-logo-png-11.png" alt="Image" class="shadow" style="width:150px">
						</div>
						<h4 class="text-center">Account Name</h4>
					</div>
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<a class="nav-link active" style="background-color:blanchedalmond;color: black;" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
							<i class="fa fa-home text-center mr-1"></i> 
							Account
						</a>
						<a class="nav-link" id="password-tab" style="color: black;background-color: #f6dcb4;" data-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
							<i class="fa fa-key text-center mr-1"></i> 
							Password
						</a>
					</div>
				</div>
				<div class="tab-content p-3 p-md-5" id="v-pills-tabContent">
					<div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                        <form method="POST">
                            <h3 class="mb-4">Account Data</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Account Name</label>
                                        <input name="uname" type="text" class="form-control" value=<?php echo $name; ?>>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input name="uemail" type="email" class="form-control" value=<?php echo $email; ?>>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone number</label>
                                        <input name="unumber" type="text" class="form-control" value=<?php echo $phone; ?>>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>City</label>
										<select class="form-control" name="ct" 
										onchange="if(this.options[this.selectedIndex].value=='customOption'){
											toggleField(this,this.nextSibling);
											this.selectedIndex='0';
										}" required>
										<option default value=<?php echo $city; ?>><?php echo $city; ?></option>
										<?php 
												$sql = mysqli_query($conn, "SELECT city_name FROM cities");
												while ($row = $sql->fetch_assoc()){
												echo "<option>" . $row['city_name'] . "</option>";
												}
												?>
										</select>
										<input name="ct" style="display:none;" disabled="disabled" 
                						onblur="if(this.value==''){toggleField(this,this.previousSibling);}">
                                    </div>
                                </div>
								<div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address Detail</label>
										
                                        <input name="uadr" type="text" class="form-control" style="height: 200px;" value="<?php echo $address;?>" required>
                                    </div>
                                </div>
                                
                            </div>
                            <div>
                                <button class="btn btn-primary" style="font-weight: 500;" name="updateacc">Update</button>
                            </div>
                        </form>
					</div>
                    
					<div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
						<h3 class="mb-4">Password Settings</h3>
						<form method="post">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Old password</label>
								  	<input name="old" type="password" class="form-control" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								  	<label>New password</label>
								  	<input name="new" type="password" class="form-control" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Confirm new password</label>
								  	<input name="new2" type="password" class="form-control" required>
								</div>
							</div>
						</div>
						<div>
                            <button class="btn btn-primary" style="font-weight: 500;" name="updatepass">Update</button>
                        </div>
						</form>
					</div>					
				</div>
			</div>
		</div>
	</section>
	</div>
</body>
<?php include 'footer2.html'; ?>
</html>