
<?php include 'conn.php'; ?>
<?php include 'headerB.html'; 
session_start();
if (!isset($_SESSION['company_id']))
{   
    echo
    "<script language=javascript>
    alert('You haven't logged in yet !');
    </script>
    ";
    header("Location: account.php");
}
else{
  $c_id = $_SESSION['company_id'];
}
$query = "SELECT * FROM company WHERE comp_id = $c_id";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['comp_name'];
    $email = $row['comp_email'];
    $phone = $row['comp_phone'];
    $address = $row['comp_address'];
    $city = $row['comp_city'];
} 

if (isset($_POST['updateacc'])) {
    $uname = trim($_POST['uname']);
    $uemail = trim($_POST['uemail']);
    $unumber = trim($_POST['unumber']);
    $ct = $_POST['ct'];
    $uadr = trim($_POST['uadr']);
    
    $stmt = $conn->prepare("UPDATE company SET comp_name = ?, comp_phone = ?, comp_address = ?, comp_city = ?, comp_email = ? WHERE comp_id = ?");
    $stmt->bind_param("sssssi", $uname, $unumber, $uadr, $ct, $uemail, $c_id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Account Updated Successfully');
		document.location.href = 'settingsB.php';</script>";
    } else {
        echo "<script>alert('Error Updating Account');
		document.location.href = 'settingsB.php';</script>";
    }
    
    $stmt->close();
}

if (isset($_POST['updatepass'])) {
    $upass = trim($_POST['old']);
    $npass = trim($_POST['new']);
    $cpass = trim($_POST['new2']);
    
    $stmt = $conn->prepare("SELECT comp_password FROM company WHERE comp_id = ?");
    $stmt->bind_param("i", $c_id);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        
        if (password_verify($upass, $hashed_password)) {
            if ($npass == $cpass) {
                $new_password = password_hash($npass, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("UPDATE company SET comp_password = ? WHERE comp_id = ?");
                $stmt->bind_param("si", $new_password, $c_id);
                
                if ($stmt->execute()) {
                    echo "<script>alert('Password Updated Successfully')</script>";
                    session_destroy();
                    exit;
                } else {
                    echo "<script>alert('Error Updating Password')</script>";
                }
            } else {
                echo "<script language='javascript'>
                    alert('The password you entered was not valid');
                    document.location.href = 'settingsB.php';
                </script>";
            }
        }
    }
    
    $stmt->close();
}

$_POST = array();
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<body>
    <div id=main>
	<section>
		<div class="container">
			<h2>Settings</h2>
			<div class="bg-white shadow rounded-lg d-block d-sm-flex">
				<div class="profile-tab-nav border-right">
					<div class="p-4">
						<div class="img-circle text-center mb-3">
						<img style="width:180px;clip-path:circle()" src=<?php if($row['picture'] != NULL) {
										echo ("'assets/".$row['picture']."'");
									}
									else{ echo("https://clipground.com/images/account-logo-png-11.png"); } ?> alt="Image" class="shadow">
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
                        <form method="POST" action="settingsB.php" enctype="multipart/form-data">
                            <h3 class="mb-4">Account Data</h3>
							<div>
							<label><b>Upload Profile Picture (Optional) :</b></label>&nbsp;&nbsp;<input type='file' name='pic'>
							</div>
                            <div class="row">
							<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Account Name</label>
                                        <input name="uname" type="text" class="form-control" value='<?php echo $name; ?>'>
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
                                
								<div class="col-md-6" style="display:flex; justify-content:space-between">
                                    <div class="form-group">
										<label>Provinsi :</label>
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
										</div>
									<div class="form-group">
										<label>Kota :</label>
										<h6><select id="city" name="ct" class="form-control" required>
										<option value="" default><?php echo $city; ?></option>
										</select></h6>
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
	<script>
						$(document).ready(function() {
						// When the state selection changes

						$('#state').change(function() {
							var stateId = $(this).val(); // Get the selected state ID
							
							// Clear the city selection
							$('#city').empty().html('');
							
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
</body>
<?php include 'footer2.html'; ?>
</html>