<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "materiarch2";
try {
 //Creating a connection
 $conn = mysqli_connect($servername, $username, $password, $database);

 if($conn->connect_errno){
    print("Connection Failed ");
 }else{
    
 }

} catch(PDOException $e) {
   die("Connection failed: " . $e->getMessage());
}
?>
