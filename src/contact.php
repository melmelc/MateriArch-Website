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
	padding: 40px;
}
</style>
<body>
	<div id="main">
		<h1 class="entry-title">Contact</h1>
		<div class="entry-content">

					<p><script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script>
					<div style='overflow:hidden;height:380px;width:100%;'>
					<div id='gmap_canvas' style='height:380px;width:100%;'></div>
					<div>embed google maps</a></div>
					<style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
					</div>
					<p><script type='text/javascript'>function init_map(){var myOptions = {zoom:15,center:new google.maps.LatLng(-7.339479957246965, 112.73854165928887),mapTypeId: google.maps.MapTypeId.ROADMAP};
					map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
					marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(-7.339479957246965, 112.73854165928887)});
					infowindow = new google.maps.InfoWindow({content:'<strong>Current Location</strong><br />Siwalankerto<br/>'});
					google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});
					infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);
					</script></p>

					<div name="fo" style="display: inline-flex;justify-content: space-evenly;padding-top: 20px; padding-left:20px;">
					<div style="width : 50%">
					<form class="wpcf7" method="post" action="contact.php" id="contactform">
					<h4>Quick Contact</h4>
						<div class="form">
							<p><input style="width : 90%" type="text" name="name" placeholder="Name *"></p>
							<p><input style="width : 90%" type="text" name="email" placeholder="E-mail Address *"></p>
							<p><textarea  style="width : 90%"name="comment" rows="3" placeholder="Message *"></textarea></p>
							<button type="submit" id="submit" class="btn btn-success btn-block" style="width: 90%;" value="Send">Send</button>
						</div>
					</form>
					<div class="done"style="display:none;">								
						Your message has been sent. Thank you!
					</div>
					
					</div>
					
					
					<div>
						<h4>Find Us: (+62) 21 599637</h4>
						<p>
							If you have any feedback or questions about our service in general, please send us a message by completing our enquiry form. It’s best to call though, someone we’ll always be there for you.
						</p>
						<p>
							Monday – Friday: 9am to 5pm<br>
							Saturday: 10am to 2pm<br>
							Sunday: Closed
						</p>
					</div>
					</div>
		</div>
	</div>
</body>
		
<?php include 'footer2.html'; ?>
<a href="#top" class="smoothup" title="Back to top"><span class="genericon genericon-collapse"></span></a>

<!-- #page -->
<script src='js/jquery.js'></script>
<script src='js/plugins.js'></script>
<script src='js/scripts.js'></script>
<script src='js/masonry.pkgd.min.js'></script>
<script src='js/validate.js'></script>

</html>