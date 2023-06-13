<?php include 'headerA.html'; ?>
<?php include 'conn.php'; 
require_once '../vendor/autoload.php';

session_start();


$tender_id = $_GET['tender'];

if(isset($_POST['sub'])) {
    $name = trim($_POST['penerima']);
    $phone = trim($_POST['telephone']);
    $adr = trim($_POST['alamat']);
    $city = trim($_POST['cityname']);
    $cost = trim($_POST['shipment']);

}

$delivery_address = $penerima = $telephone = "";
$delivery_address_err = $penerima_err = $telephone_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["alamat"])) == TRUE){
        $delivery_address_err = "Please enter address";
    } else{
        $sql = "SELECT delivery_id FROM delivery WHERE delivery_address = ?";
    
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_address);
            $param_address = trim($_POST["alamat"]);

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $delivery_address = trim($_POST["alamat"]);
                }
            } else{
                echo "Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    if(empty(trim($_POST["penerima"])) == TRUE){
        $penerima_err = "Please enter reciever name";
    } else{
        $sql = "SELECT delivery_id FROM delivery WHERE penerima = ?";
   

        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_penerima);
            $param_penerima = trim($_POST["penerima"]);

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $penerima = trim($_POST["penerima"]);
                }
            } else{
                echo "Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    if(empty(trim($_POST["telephone"])) == TRUE){
        $telephone_err= "Please enter reciever phone number";
    } else{
        $sql = "SELECT delivery_id FROM delivery WHERE telephone = ?";

        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_telephone);
            $param_telephone = trim($_POST["telephone"]);

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $telephone = trim($_POST["telephone"]);
                }
            } else{
                echo "Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    if(empty($delivery_address_err) && empty($penerima_err) && empty($telephone_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO delivery (delivery_address, penerima, telephone) VALUES (?, ?, ?)";

         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_address, $param_penerima, $param_region);
            
            // Set parameters
            $param_address = $delivery_address;
            $param_penerima = $penerima;
            $param_telephone = $telephone;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: loginHome.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($conn);
    
}

?>
<body>
    <div id="main">
        <h3>Delivery Page</h3>
        <h5>Estimated shipment arrival : H+30 from order placed</h5>
        <hr>
        <br>
        <h4>Rincian Pengiriman</h6><br>
        
        <form method="POST">
        <label>Nama Penerima:</label>
        <input type="text" name="penerima" placeholder="penerima" class="form-control" required>
        <br>
        <label>Nomor telepon/HP Penerima : </label>
        <input type="text" name="telephone" placeholder="Telephone" class="form-control" required>
        <br>
        <label>Alamat Pengiriman:</label>
        <input type="text" name="alamat" placeholder="address" class="form-control"required>
        <br>
        <label>Kota Tujuan : </label>
                <select name="cityname" class="form-control"
                    onchange="if(this.options[this.selectedIndex].value=='customOption'){
                        toggleField(this,this.nextSibling);
                        this.selectedIndex='0';
                    }" required>
                    <option default></option>
                    <?php 
                            $sql = mysqli_query($conn, "SELECT city_name FROM cities");
                            while ($row = $sql->fetch_assoc()){
                            echo "<option>" . $row['city_name'] . "</option>";
                            }
                            ?>
                </select>
                <input name="cityname" style="display:none;" disabled="disabled" 
                onblur="if(this.value==''){toggleField(this,this.previousSibling);}">
                <br>
                <label>Biaya Jasa Pengiriman : </label>
                <input type="number" name="shipment" class="form-control" value="<?php echo(random_int(800000,2000000));?>" readonly>
                <br>
                <a href="payment.php?tender=".urlencode($tender)><button type="submit" class="btn btn-primary" name="sub">Confirm</button></a>
        </form>
        <br>
        
        <br>
        <br>
        
        
        
        <br>
    </div>
</body>
<?php include 'footer2.html'; ?>