<?php include 'headerA.html'; ?>
<?php include 'conn.php'; 
session_start();


if(isset($_GET['tender2'])) {
    $tender_id = $_GET['tender2'];
}
else {
    $tender_id = $_GET['tender'];
}


$total2 = $price2 = 0;
$name = $adr = $city = $phone2 = "";
if(isset($_POST['sub'])) {
    $name = trim($_POST['penerima']);
    $phone2 = trim($_POST['telephone']);
    $adr = trim($_POST['alamat']);
    $city = trim($_POST['cityname']);
    $compcity = "SELECT comp_city FROM company c JOIN tender t ON c.comp_id=t.comp_id  WHERE tender_id=".$tender_id;
    $result = mysqli_query($conn, $compcity);
    $row = $result->fetch_array();
    $count = $result->num_rows;
    if($count > 0) {
        $compct = $row['comp_city'];
        $prices = "SELECT biaya FROM shipment WHERE kota_asal='".$compct."' AND kota_tujuan='".$city."'";
    $result2 = mysqli_query($conn, $prices);
    $row2 = $result2->fetch_array();
    $count = $result2->num_rows;
    if($count > 0) {
        $price = $row2['biaya'];

    }
    else{
        if($compct == $city) {
            $price = 300000;
        }
        else {
            $price = 700000;
        }
    }
    }

    $price2 = $price;
    
    $payment = $_POST['payment'];
    $total2 = $_POST['total'];
    $total_pay = $total2 + (0.01*$total2) + (0.05*$total2) + $price2;
    echo($price2);
    echo($total_pay);
    echo($name);
    echo($phone2);
    echo($adr);
    echo($city);
    echo($payment);
    
}


?>
<style>
div#main{
	padding-left: 60px;
    padding-right: 60px;
    padding-top: 20px;
}
</style>

<body>
    <div id="main">
    <h3>Payment & Delivery</h3>
        <h5>Estimated shipment arrival : H+30 from order placed</h5>
        <hr>
        <br>
        <div style="display:flex; justify-content:space-between">
        <div style="width:50%">
        <h4>Rincian Pengiriman</h4>
        <hr>
        <form method="POST">
        <label>Nama Penerima:</label>
        <input type="text" name="penerima" placeholder="penerima" class="form-control" required value="<?php if(isset($_POST["penerima"])){
            echo($name); } else {
            ""; }?>">
        <label>Nomor HP Penerima : </label>
        <input type="text" name="telephone" placeholder="Telephone" class="form-control" required value="<?php if(isset($_POST["telephone"])){
            echo($phone2); } else {
            ""; }?>">
        <label>Alamat Pengiriman:</label>
        <input type="text" name="alamat" placeholder="address" class="form-control"required value="<?php if(isset($_POST["alamat"])){
            echo($adr); } else {
            ""; }?>">
        
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
                <a href="payment.php?tender=".urlencode($tender)><button type="submit" class="btn btn-primary" name="sub">Confirm</button></a>
        
        <br>
        <label>Biaya Jasa Pengiriman : </label>
        <input type="number" name="shipment" class="form-control" value="<?php echo number_format($price,0,',','.') ;?>" readonly>
        </div>
        
        <?php 
        
        $qu = "SELECT * FROM tender WHERE tender_id=".$tender_id ;
        $result = $conn->query($qu);
        $row = $result->fetch_array();
        $count = $result->num_rows;
        if($count > 0) {
            $total = $row['offered_price'];
            $total2 = $total;
            $c_id = $row['comp_id'];
        }
        $sel = "SELECT * FROM company WHERE comp_id=".$c_id;
        $result = $conn->query($sel);
        $row = $result->fetch_array();
        $count = $result->num_rows;
        if($count > 0) {
            $comp_name = $row['comp_name'];
            $comp_address = $row['comp_address'];
            $ct = $row['comp_city'];
            $phone = $row['comp_phone'];

        }
        ?>
        <div>
        <h4>Rincian Biaya</h4>
        <hr>
        <form method="get">
        <table id="rincian" class="table table-bordered" >
                <tr>
                    <th>Keterangan</th>
                    <th>Biaya</th>
                </tr>
                <tr>
                    <td>Harga Tender</td>
                    <td>Rp &nbsp; <?php echo number_format($total,0,',','.'); ?></td>
                </tr>
                <tr>
                    <td>Biaya Administrasi</td>
                    <td>Rp &nbsp; <?php echo number_format((0.01*$total),0,',','.'); ?></td>
                </tr>
                <tr>
                    <td>Biaya Asuransi</td>
                    <td>Rp &nbsp; <?php echo number_format((0.05*$total),0,',','.'); ?></td>
                </tr>
                <tr>
                    <td>Biaya Pengiriman</td>
                    <?php if (isset($price)): ?>
                        <td>Rp &nbsp; <?php echo number_format($price,0,',','.'); ?></td>
                    <?php else: ?>
                        <td>Price not available</td>
                    <?php endif; ?>
                </tr>
                <tr>
                    <th>Total</th>
                    <?php if (isset($price)): ?>
                        <th id="total">Rp &nbsp; <?php echo number_format($total + (0.01*$total) + (0.05*$total) + $price,0,',','.'); ?></th>
                    <?php else: ?>
                        <th>Price not available</th>
                    <?php endif; ?>
                </tr>
            </table>
        </div>      
        </div>
        <br>
        <br>
        <br>
       
        <h4>Rician Pesanan</h4>
        <hr>
        
        <div id="rincian" style="display:flex;justify-content:space-between">
        <div>
        <h4>Seller Detail</h4>
            <h5><?php echo($comp_name); ?></h5>
            <h5><?php echo "<a href='https://wa.me/".$phone."'>".$phone."</a>"; ?></h5>
            <h5><?php echo($comp_address." ".$ct); ?></h5>
            
        </div>
        <div>
        <h4>Customer Detail</h4>
            <h5><?php echo($name); ?></h5>
            <h5><?php echo "<a href='https://wa.me/".$phone2."'>".$phone2."</a>"; ?></h5>
            <h5><?php echo($adr);echo("\t".$city);  ?></h5>
        </div>

        <div>
       
            <h5 for="payment">Payment Method :</h5>
            <select name="payment" class="form-control" 
            onchange="if(this.options[this.selectedIndex].value=='customOption'){
                toggleField(this,this.nextSibling);
                this.selectedIndex='0';
            }" required> <h4>
            <option default></option>
            <option value="Transfer">Transfer Bank</option>
            
             </h4></select>
            <input name="filter" style="display:none;" disabled="disabled" 
                onblur="if(this.value==''){toggleField(this,this.previousSibling);}">
            <br>
            <a href="#"><button class="btn btn-primary" name="subm">Submit</button></a>
        </div>
        
        </div>
        </form>
   
    </div>
    <br><br>
    
</body>
<script>
    
</script>







<?php include 'footer2.html'; ?>