<?php 
if (!isset($_SESSION['company_id']) AND !isset($_SESSION['customer_id']))
{   
	include 'header.html';
    echo
    "<script language=javascript>
    alert('You haven't logged in yet !');
    </script>
    ";
}
else{
  if(isset($_SESSION['company_id'])) {
	include 'headerB.html';
	$c_id =$_SESSION['company_id'];
  }

else if(isset($_SESSION['customer_id'])){
	include 'headerA.html';
	$c_id = $_SESSION['customer_id'];

	}
}
?>
<style>
    div#main{
        padding:40px;
    }
</style>
<body>
    <div id="main">
        
    </div>
</body>
<?php include 'footer2.html' ?>