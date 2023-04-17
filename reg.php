<?php include 'header.html';?>
<?php include "conn.php"; ?>


<script>
$(document).ready(function(){
    $('input[type="radio"]').click(function(){
    	var rolevalue = $(this).val(); 
        $("div.myDiv").hide();
        $("#Form"+rolevalue).show();
    });
});
</script>
<script>
    function toggleField(hideObj,showObj){
  hideObj.disabled=true;        
  hideObj.style.display='none';
  showObj.disabled=false;   
  showObj.style.display='inline';
  showObj.focus();}
</script>


<h2> Register As :</h2>
<form action="#">  
  <input type="radio" id="buyer" name="role" value="B">
  <label for="buyer" style="color :darkgreen"><h3>Buyer</h3></label>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="radio" id="craftmen" name="role" value="C">
  <label for="craftmen" style="color :darkblue"><h3>Craftmen</h3></label><br>
</form>
<br>
<br>

<div id="FormB" class="myDiv" style="display: none;">
    <h2>Customer Registration Form</h2>
    <form id="f1" action="#" method="post">
        <h4>Customer Name :</h4>
        <input type="text" id="custname" name="custname" placeholder="Enter name" style="width: 50%"><br><br>
        <h4>Address :</h4>
        <input type="text" id="addr" name="addr" placeholder="Enter address"><br><br>
        <h4>City :</h4>
        <input type="text" name="city" list="cityname1"/>
        <h4>City :</h4>
        <h4><select name="cityname" 
          onchange="if(this.options[this.selectedIndex].value=='customOption'){
              toggleField(this,this.nextSibling);
              this.selectedIndex='0';
          }">
          <?php 
                $sql = mysqli_query($conn, "SELECT city_name FROM cities");
                while ($row = $sql->fetch_assoc()){
                echo "<option>" . $row['city_name'] . "</option>";
                }
                ?>
        </select></h4>
        <input name="cityname" style="display:none;" disabled="disabled" 
            onblur="if(this.value==''){toggleField(this,this.previousSibling);}">
        <br>
        <h4>Email :</h4>
        <input type="text" id="email" name="email" placeholder="Enter email"><br>
        <h5><label for="pass">Password :</label><br></h5>
        <input type="password" id="pass" name="pass" placeholder="Enter Password"><br><br>
        <button type="button" class="btn btn-primary">Sign Up</button>
    </form>
    <br>
        <br>
        <br>
        <br>
</div>

<div id="FormC" class="myDiv" style="display: none;">
    <h2>Craftmen / Company Registration Form</h2>
    <br>
    <br>
    <form id="f2" action="#" method="post">
        <h4>Craftmen / Company Name :</h4>
        <input type="text" id="cname" name="cname" placeholder="Enter name" style="width: 50%"><br><br>
        <h4>Address :</h4>
        <input type="text" id="addr2" name="addr2" placeholder="Enter address"><br><br>
        <h4>City :</h4>
        <h4><select name="cityname" 
          onchange="if(this.options[this.selectedIndex].value=='customOption'){
              toggleField(this,this.nextSibling);
              this.selectedIndex='0';
          }">
          <?php 
                $sql = mysqli_query($conn, "SELECT city_name FROM cities");
                while ($row = $sql->fetch_assoc()){
                echo "<option>" . $row['city_name'] . "</option>";
                }
                ?>
        </select></h4>
        <input name="cityname" style="display:none;" disabled="disabled" 
            onblur="if(this.value==''){toggleField(this,this.previousSibling);}">
        <br>
        <h4>Email :</h4>
        <input type="text" id="email2" name="email2" placeholder="Enter email"><br><br>
        <h4>Password :</h4>
        <input type="password" id="pass2" name="pass2" placeholder="Enter password"><br><br>
        <button type="button" class="btn btn-primary">Sign Up</button>
    </form>
    <br>
        <br>
        <br>
        <br>
</div>
<h5>Already have an account ? <a href="account.php">Sign In</a></h5> 
</div>
<?php include 'footer.html'; ?>
</div>
</body>