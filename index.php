<?php include 'header.html';?> 
		<!-- <?php include 'conn.php'; 
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
		?> -->

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
	<?php include 'footer.html'; ?>
</div>
<!-- #page -->
<script src='js/jquery.js'></script>
<script src='js/plugins.js'></script>
<script src='js/scripts.js'></script>
<script src='js/masonry.pkgd.min.js'></script>
</body>
</html>