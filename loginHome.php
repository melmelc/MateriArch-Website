<?php include 'conn.php'; 
		$qkategori = "SELECT * FROM kategori"; // string query
		$stmt = $conn->query($qkategori);
		if ($stmt->num_rows > 0) {
            while($row = $stmt->fetch_assoc()) {
               printf("Id: %s, Title: %s <br />",
                  $row["id_k"], 
                  $row["nama_k"]);             
            }
         } else {
            printf('No record found.<br />');
         }
         mysqli_free_result($stmt);
		?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Customized Building Material</title>
<link rel='stylesheet' href='css/woocommerce-layout.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/woocommerce-smallscreen.css' type='text/css' media='only screen and (max-width: 768px)'/>
<link rel='stylesheet' href='css/woocommerce.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/font-awesome.min.css' type='text/css' media='all'/>
<link rel='stylesheet' href='style.css' type='text/css' media='all'/>
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Oswald:400,500,700%7CRoboto:400,500,700%7CHerr+Von+Muellerhoff:400,500,700%7CQuattrocento+Sans:400,500,700' type='text/css' media='all'/>
<link rel='stylesheet' href='css/easy-responsive-shortcodes.css' type='text/css' media='all'/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>


<body class="home page page-template page-template-template-portfolio page-template-template-portfolio-php">
<div id="page">
	<div class="container">
		<header id="masthead" class="site-header">
		<div class="site-branding">
			<h1 class="site-title"><a href="index.php" rel="home">E-Marketplace for Building Material</a></h1>
			<h2 class="site-description">Custom Design - Made by Craftmen</h2>
		</div>
		<nav id="site-navigation" class="main-navigation">
		<button class="menu-toggle" style="display: flexbox;">Menu</button>
		<a class="skip-link screen-reader-text" href="#content">Skip to content</a>
		<div class="menu-menu-1-container">
			<ul id="menu-menu-1" class="menu">
				<li><a href="index.php">Home</a></li>
				<li><a href="shop.php">Shop</a></li>
				<li><a href="#">Pages</a>
				<ul class="sub-menu">
					<li><a href="blog.php">Blog</a></li>
					<li><a href="about.php">About Us</a></li>
					<li><a href="contact.php">Contact Us</a></li>
				</ul>
				</li>
				<li><a href="#">My Account</a>
				<ul class="sub-menu">
					<li><a href="orderH.php">Order History</a></li>
					<li><a href="Settings.php">Account Settings</a></li>
					<li><a href="account.php">Log Out</a></li>
				</ul>
				</li>
			</ul>
		</div>
		</nav>
		</header>

		<div id="content" class="site-content">
			<div id="primary" class="content-area column full">
				<main id="main" class="site-main">
				<div class="grid portfoliogrid">
				
					<article class="hentry">
					<header class="entry-header">
					<div class="entry-thumbnail">
						<a href="portfolio-item.html"><img src="http://s3.amazonaws.com/caymandemo/wp-content/uploads/sites/15/2015/09/30162427/p1.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="p1"/></a>
					</div>
					<h2 class="entry-title"><a href="portfolio-item.html" rel="bookmark">Sunset Beach</a></h2>
					<a class='portfoliotype' href='portfolio-category.html'>summer</a>
					<a class='portfoliotype' href='portfolio-category.html'>woman</a>
					<a class='portfoliotype' href='portfolio-category.html'>yellow</a>
					</header>
					</article>
					
					<article class="hentry">
					<header class="entry-header">
					<div class="entry-thumbnail">
						<a href="portfolio-item.html"><img src="http://s3.amazonaws.com/caymandemo/wp-content/uploads/sites/15/2015/09/30160348/p5.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="p1"/></a>
					</div>
					<h2 class="entry-title"><a href="portfolio-item.html" rel="bookmark">Earl of Moreland</a></h2>
					<a class='portfoliotype' href='portfolio-category.html'>hat</a>
					<a class='portfoliotype' href='portfolio-category.html'>woman</a>
					<a class='portfoliotype' href='portfolio-category.html'>yellow</a>
					</header>
					</article>
					
					<article class="hentry">
					<header class="entry-header">
					<div class="entry-thumbnail">
						<a href="portfolio-item.html"><img src="http://s3.amazonaws.com/caymandemo/wp-content/uploads/sites/15/2015/09/30160151/p3.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="p1"/></a>
					</div>
					<h2 class="entry-title"><a href="portfolio-item.html" rel="bookmark">Eliza and John</a></h2>
					<a class='portfoliotype' href='portfolio-category.html'>summer</a>
					<a class='portfoliotype' href='portfolio-category.html'>woman</a>
					<a class='portfoliotype' href='portfolio-category.html'>yellow</a>
					</header>
					</article>
					
					<article class="hentry">
					<header class="entry-header">
					<div class="entry-thumbnail">
						<a href="portfolio-item.html"><img src="http://s3.amazonaws.com/caymandemo/wp-content/uploads/sites/15/2015/09/18160911/p6.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="p1"/></a>
					</div>
					<h2 class="entry-title"><a href="portfolio-item.html" rel="bookmark">Hot Afternoon</a></h2>
					<a class='portfoliotype' href='portfolio-category.html'>pink</a>
					<a class='portfoliotype' href='portfolio-category.html'>woman</a>
					<a class='portfoliotype' href='portfolio-category.html'>yellow</a>
					</header>
					</article>
					
					<article class="hentry">
					<header class="entry-header">
					<div class="entry-thumbnail">
						<a href="portfolio-item.html"><img src="http://s3.amazonaws.com/caymandemo/wp-content/uploads/sites/15/2015/09/15223245/p2.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="p1"/></a>
					</div>
					<h2 class="entry-title"><a href="portfolio-item.html" rel="bookmark">Long Walks</a></h2>
					<a class='portfoliotype' href='portfolio-category.html'>hat</a>
					<a class='portfoliotype' href='portfolio-category.html'>summer</a>
					<a class='portfoliotype' href='portfolio-category.html'>yellow</a>
					</header>
					</article>
					
					<article class="hentry">
					<header class="entry-header">
					<div class="entry-thumbnail">
						<a href="portfolio-item.html"><img src="http://s3.amazonaws.com/caymandemo/wp-content/uploads/sites/15/2015/09/15222855/p7.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="p1"/></a>
					</div>
					<h2 class="entry-title"><a href="portfolio-item.html" rel="bookmark">Twilight</a></h2>
					<a class='portfoliotype' href='portfolio-category.html'>hat</a>
					<a class='portfoliotype' href='portfolio-category.html'>woman</a>
					<a class='portfoliotype' href='portfolio-category.html'>summer</a>
					</header>
					</article>
					
				</div>
				<!-- .grid -->
				
				<nav class="pagination">
				<span class="page-numbers current">1</span>
				<a class="page-numbers" href="#">2</a>
				<a class="next page-numbers" href="#">Next »</a>
				</nav>
				<br/>
				
				</main>
				<!-- #main -->
			</div>
			<!-- #primary -->
		</div>
		<!-- #content -->
	</div>
	<!-- .container -->
	<?php include 'footer.html'; ?>s
	<a href="#top" class="smoothup" title="Back to top"><span class="genericon genericon-collapse"></span></a>
</div>
<!-- #page -->
<script src='js/jquery.js'></script>
<script src='js/plugins.js'></script>
<script src='js/scripts.js'></script>
<script src='js/masonry.pkgd.min.js'></script>
</body>
</html>