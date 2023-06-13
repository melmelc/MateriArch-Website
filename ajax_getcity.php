<?php
include 'conn.php';

if (isset($_POST['stateId'])) {
  $stateId = $_POST['stateId'];
  
  // Query to retrieve cities based on the selected state
  $query = "SELECT city_name FROM cities WHERE prov_id = $stateId";
  
  $result = mysqli_query($conn, $query);
  
  $cities = '<option value="">Select a city</option>';
  
  $cities2 = "";
  while ($row = mysqli_fetch_assoc($result)) {
    $cities2 .="<option value='" . $row['city_name'] . "'>".$row['city_name']."</option>";
  }
  
  echo $cities2;
}
?>
