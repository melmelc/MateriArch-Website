<?php include 'headerA.html'; ?>
<?php include 'conn.php'; 
session_start();
$cu_id = $_SESSION['customer_id'];

if(isset($_GET['tender'])) {
    $tender_id = $_GET['tender'];
$qu = "SELECT * FROM tender WHERE tender_id=".$tender_id ;
        $result = $conn->query($qu);
        $row = $result->fetch_array();
        $count = $result->num_rows;
        if($count > 0) {
            $total = $row['offered_price'];
            $total2 = $total;
            $c_id = $row['comp_id'];
            $ro = $row['ro_id'];
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

$name = $adr = $city = $phone2 = "";

if(isset($_POST['op'])) {
    $name = trim($_POST['penerima']);
    $phone2 = trim($_POST['telephone']);
    $adr = trim($_POST['alamat']);
    $city = trim($_POST['cityname']);
    $price = $_POST['ship'];
    $payment2 = $_POST['payment'];
    $total_pay = $total + (0.01*$total) + (0.05*$total) + $price;
    

    
        $qPay = "INSERT INTO payment (tender_id,payment_method,payment_total
        ) VALUES	
        ('$tender_id','$payment2','$total_pay')"; 
         $qsel = "INSERT INTO selected_tender (tender_id,buyer_id) VALUES ('$tender_id','$cu_id')"; 
         $conn->query($qsel);
        if($conn->query($qPay) == TRUE) {
            $qUp = "UPDATE request_order SET status = 'Awaiting Payment' WHERE ro_id = $ro";
            $conn->query($qUp);
             $qDel= "INSERT INTO delivery (tender_id,penerima,phone,delivery_address,delivery_city,cost) VALUES 
        ('$tender_id','$name','$phone2','$adr','$city','$price')";
        if($conn->query($qDel) == TRUE) {
            echo
            "<script language=javascript>
            alert('Order Confirmed !');
            document.location.href = 'order_history.php';
            </script>
            ";
        }
       
    }   
}
}
$_POST=array();


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
        <div style="width:35%">
        <h4>Rincian Pengiriman</h4>
        <hr>
        <form method="POST" id="myform">
            <label>Nama Penerima:</label>
            <input type="text" name="penerima" placeholder="penerima" class="form-control" required value="<?php if(isset($_POST["penerima"])){
                echo($name); } else {
                ""; }?>">
            <label>Nomor HP Penerima : </label>
            <input type="text" name="telephone" placeholder="Telephone" class="form-control" required value="<?php if(isset($_POST["telephone"])){
                echo($phone2); } else {
                ""; }?>">
            <h6>Provinsi :</h6>
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
            <h6>Kota :</h6>
            <h6><select id="cityname" name="cityname" class="form-control" required>
            <option value="" default>--Select City--</option>
            </select></h6>
            <label>Alamat Pengiriman:</label>
            <input type="text" name="alamat" placeholder="address" class="form-control" required value="<?php if(isset($_POST["alamat"])){
                echo($adr); } else {
                ""; }?>">
            <label><b>Biaya Jasa Pengiriman : </b></label>
            <input type="number" name="ship" id="shipment" readonly class="form-control">
            <br>
            
            <script>
            $(document).ready(function() {
                $('#state').change(function() {
                    var stateId = $(this).val(); // Get the selected state ID
                    
                    // Clear the city selection
                    $('#cityname').empty().html('<option value="">Select city</option>');
                    
                    // Make an AJAX request to get cities based on the selected state
                    $.ajax({
                    url: 'ajax_getcity.php', // The PHP file to handle the request
                    method: 'POST',
                    data: { stateId: stateId }, // Send the selected state ID
                    success: function(response) {
                        // Populate the city selection with the received cities
                        $('#cityname').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        // Handle any error that occurred during the AJAX request
                    }
                    });
                });
                $('#cityname').change(function() {
                    var selectedCity = $(this).val();
                    var tender = '<?php echo $tender_id ?>';
                    var temp = 0;
                    var tmp = 0;
                    var t = '<?php echo $total ?>';
                    
                    if (selectedCity !== "") {
                        
                    $.ajax({
                        url: 'ajax_getcost.php',
                        type: 'GET',
                        data: { city: selectedCity,
                            tender_id: tender},
                        success: function(response) {
                        $('#shipment').val(response); 
                        tmp = parseInt(response) + parseInt(t) + 0.01*parseInt(t) + 0.05*parseInt(t);
                        temp = response;  
                        $.ajax({
                            url: "ajax_cur.php",
                            method: "GET",
                            data: { number: parseInt(temp)},
                            success: function(response) {
                                $('#ship2').text('Rp   '+response);
                            },
                            error: function(xhr, status, error) {
                            // Handle the error
                            console.log(error);
                            }
                        });
                        $.ajax({
                            url: "ajax_cur.php",
                            method: "GET",
                            data: { number: parseInt(tmp)},
                            success: function(response) {
                              
                                $('#SUBtotal').text('Rp   '+response);

                            },
                            error: function(xhr, status, error) {
                            // Handle the error
                            console.log(error);
                            }
                        });
                        },
                        error: function(xhr, status, error) {
                        console.error(error);
                        }
                    });
                    
                    } else {
                    $('#shipment').val('Not Set');
                    $('#ship2').html('Not Set');
                    }
                });
                
                
            });
            </script>
       
            
            <button class="btn btn-danger" style="width:101px" type="reset">Reset</button>
            <script>
                document.getElementById('myform').addEventListener('reset', function() {
                    // Delay the execution to allow the form to reset first
                    setTimeout(function() {
                        resetFormFields();
                    }, 0);
                });

                function resetFormFields() {
                    var form = document.getElementById('myform');
                    var inputs = form.querySelectorAll('input');
                
                    for (var i = 0; i < inputs.length; i++) {
                        inputs[i].value = '';
                    }
                    var selects = form.querySelectorAll('select');
                    for (var i = 0; i < selects.length; i++) {
                        selects[i].value = '';
                    }
                }
            </script>
        
        </div>
        
        <div>
        <h4>Rincian Biaya</h4>
        <hr>
        
        <table id="rincianB" class="table table-bordered" >
                <tr>
                    <th>Keterangan</th>
                    <th>Biaya</th>
                </tr>
                <tr>
                    <td>Biaya Tender</td>
                    <td>Rp &nbsp;<?php echo number_format($total,0,',','.'); ?></td>
                </tr>
                <tr>
                    <td>Biaya Administrasi</td>
                    <td>Rp &nbsp;<?php echo number_format((0.01*$total),0,',','.'); ?></td>
                </tr>
                <tr>
                    <td>Biaya Asuransi</td>
                    <td>Rp &nbsp;<?php echo number_format((0.05*$total),0,',','.'); ?></td>
                </tr>
                <tr>
                    <td>Biaya Pengiriman</td>
                    <td id='ship2'>UNSET</td>
                    
                    
                </tr>
                <tr>
                    <th>Total</th>
                    <th id='SUBtotal'>UNSET</th>
                </tr>
            </table>
        </div>
        <div style="width: 33%;word-wrap: break-word">
        <h4>Seller Detail</h4>
            <h5><?php echo($comp_name); ?></h5>
            <h5><?php echo "<a href='https://wa.me/".$phone."'>".$phone."</a>"; ?></h5>
            <h5><?php echo($comp_address." ".$ct); ?></h5>
            <br>
            <br>
            <h5 for="payment">Payment Method :</h5>
            <select name="payment" required style="
                width: 100%;
                padding: .375rem .75rem;
                font-size: 1rem;
                line-height: 1.5;
                border: 1px solid #ced4da;
                border-radius: .25rem;
            "> <h4>
            <option default>Select Payment Method</option>
            <option value="VABCA">Transfer Bank BCA</option>
            <option value="VAMDR">Transfer Bank Mandiri</option>
            <option value="VABRI">Transfer Bank BRI</option>
            </h4></select>
            <input name="filter" style="display:none;" disabled="disabled" 
                onblur="if(this.value==''){toggleField(this,this.previousSibling);}">
            <br>
            <br>
            <button class="btn btn-primary" style="width: -webkit-fill-available;" name="op">Submit Order</button>
        </form>
        </div>   
        </div>
        <br>
        <br>
   
    </div>
    <br><br>
    
</body>








<?php include 'footer2.html'; ?>