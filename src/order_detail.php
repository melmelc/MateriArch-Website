<?php include 'conn.php';
include 'headerA.html';
session_start();
$t_id = $_GET['tender'];

?>
<style>
.card-stepper {
z-index: 0
}

#progressbar-2 {
color: #455A64;
}

#progressbar-2 li {
list-style-type: none;
font-size: 13px;
width: 33.33%;
float: left;
position: relative;
}

#progressbar-2 #step1:before {
content: '\f058';
font-family: "Font Awesome 5 Free";
color: #fff;
width: 37px;
margin-left: 0px;
padding-left: 0px;
}

#progressbar-2 #step2:before {
content: '\f058';
font-family: "Font Awesome 5 Free";
color: #fff;
width: 37px;
}

#progressbar-2 #step3:before {
content: '\f058';
font-family: "Font Awesome 5 Free";
color: #fff;
width: 37px;
margin-right: 0;
text-align: center;
}

#progressbar-2 #step4:before {
content: '\f111';
font-family: "Font Awesome 5 Free";
color: #fff;
width: 37px;
margin-right: 0;
text-align: center;
}

#progressbar-2 li:before {
line-height: 37px;
display: block;
font-size: 12px;
background: #c5cae9;
border-radius: 50%;
}

#progressbar-2 li:after {
content: '';
width: 100%;
height: 10px;
background: #c5cae9;
position: absolute;
left: 0%;
right: 0%;
top: 15px;
z-index: -1;
}

#progressbar-2 li:nth-child(1):after {
left: 1%;
width: 100%
}

#progressbar-2 li:nth-child(2):after {
left: 1%;
width: 100%;
}

#progressbar-2 li:nth-child(3):after {
left: 1%;
width: 100%;
background: #c5cae9 !important;
}

#progressbar-2 li:nth-child(4) {
left: 0;
width: 37px;
}

#progressbar-2 li:nth-child(4):after {
left: 0;
width: 0;
}

#progressbar-2 li.active:before,
#progressbar-2 li.active:after {
background: #6520ff;
}
.i {
    font-size: 2em;
}
</style>
<body>
    <div id="main" style="padding: 40px">
        <div id="detail" style="display: inline-flex;width: 100%;justify-content:space-evenly">
            <?php 
            $select = "SELECT * FROM tender t JOIN payment p ON t.tender_id = p.tender_id JOIN request_order ro ON ro.ro_id = t.ro_id JOIN company c ON c.comp_id = t.comp_id 
            JOIN delivery d ON d.tender_id = t.tender_id WHERE t.tender_id=".$t_id;
            if($conn->query($select) == TRUE) {
                $result = $conn->query($select);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $tender = $row['tender_id'];
                        $ph = $row['comp_phone'];
                        echo "<div><img style='width:500px' src='../assets/".$row['ro_design']."' ></div>
                        <div id='content' style='padding-left: 10px;'>
                
                <h4>".$row['ro_title']."</h4><hr>
                <h5> Company Name : ".$row['comp_name']."</h3>
                <h5> Company Address : ".$row['comp_address']."</h5>
                <h5> Company Phone : <a href='https://wa.me/".$ph."'>".$ph."</a></h5>
                <h5> Price paid : Rp ".number_format($row['offered_price'],0,',','.')."</h5>
                <br>"; ?>
                <h6>Order Status</h6>
                <section class="vh-100">
                    <div class="container" style="padding-right:0px;padding-left: 0px;">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12">
                            <div class="card card-stepper text-black" style="border-radius: 16px;">

                            <div class="card-body p-5" style="padding: 1rem!important;">

                                <div class="d-flex justify-content-between align-items-center mb-2" style='margin-bottom: 1.5rem!important'>
                                <div>
                                    <h5 class="mb-0">INVOICE <span class="text-primary font-weight-bold">#Y34XDHR</span></h5>
                                    <h5 class="mb-0">Vehicle <span class="text-primary font-weight-bold"><?php $row['vehicle'] ?></span></h5>
                                </div>
                                <div class="text-end">
                                    <p class="mb-0">Expected Arrival <span>--/--/--</span></p>
                                    <p class="mb-0">MA <span class="font-weight-bold">#</span></p>
                                </div>
                                </div>
                                
                                <ul id="progressbar-2" class="d-flex justify-content-between mx-0 mt-0 px-0 pt-0 pb-2">
                                <li class="step0 active text-center" id="step1"></li>
                                <?php if($row['status'] == 'Paid') {
                                    echo "<li class='step0 active text-center' id='step2'></li>";
                                }else{
                                    echo "<li class='step0 text-muted text-center' id='step2'></li>";
                                }?>
                                <li class="step0 text-muted text-center" id="step3"></li>
                                <li class="step0 text-muted text-end" id="step4"></li>
                                </ul>

                                <div class="d-flex justify-content-between">
                                <div class="d-lg-flex align-items-center">
                                    <i class="fas fa-clipboard-list fa-3x me-lg-4 mb-3 mb-lg-0"></i>
                                    <div>
                                    <p class="fw-bold mb-1">Order</p>
                                    <p class="fw-bold mb-0">Placed</p>
                                    </div>
                                </div>
                                <div class="d-lg-flex align-items-center">
                                    <i class="fa fa-money fa-3x me-lg-4 mb-3 mb-lg-0"></i>
                                    <div>
                                    <p class="fw-bold mb-1">Order</p>
                                    <p class="fw-bold mb-0">Paid</p>
                                    </div>
                                </div>
                                <div class="d-lg-flex align-items-center">
                                    <i class="fas fa-shipping-fast fa-3x me-lg-4 mb-3 mb-lg-0"></i>
                                    <div>
                                    <p class="fw-bold mb-1">Order</p>
                                    <p class="fw-bold mb-0">En Route</p>
                                    </div>
                                </div>
                                <div class="d-lg-flex align-items-center">
                                    <i class="fas fa-home fa-3x me-lg-4 mb-3 mb-lg-0"></i>
                                    <div>
                                    <p class="fw-bold mb-1">Order</p>
                                    <p class="fw-bold mb-0">Arrived</p>
                                    </div>
                                </div>
                                </div>

                            </div>

                            </div>
                        </div>
                        </div>
                    </div>
                </section>

                <?php echo "</div>";}
                    }
                    }
            ?>
        </div>
        <div>
            <br><br>
            <h3>Company Profile</h3>
            <br>
            <div style="display: inline-flex;justify-content: space-evenly;">
            <img src="assets/agra.jpeg" style="width:40%">
                <div id="content" style="padding-left: 30px">
                <?php 
                $qu = "SELECT * FROM tender t JOIN company c ON t.comp_id = c.comp_id WHERE t.tender_id=".$t_id;
                if($conn->query($qu) == TRUE) {
                    $result = $conn->query($qu);
                    $row = $result->fetch_assoc();
                    echo "<h3>".$row['comp_name']."</h3>
                    <hr>
                    <p>".$row['comp_profile']."</p>
                    <h3>Contact Us </h3>
                    <b><p>Address : ".$row['comp_address'].", ".$row['comp_city']."</p>
                    <p>Email : <a href='mailto:".$row['comp_email']."'>".$row['comp_email']."</a></p>
                    <p>Phone Number : <a href='https://wa.me/".$row['comp_phone']."'>".$row['comp_phone']."</a></p></b>
                    <a href='portfolio.php?compid=".urlencode($row['comp_id'])."'><button class='btn btn-primary'>See our portfolios</button></a>";
                }
                ?>
                </div>
            </div>
        </div>
    </div>
</body>


<?php include 'footer2.html';