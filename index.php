<?php
	ob_start();
	session_start();
	$pageTitle = 'Homepage';
	include 'init.php';
?>
	<!-- Start Slider -->
	<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
	<div class="carousel-indicators">
		<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
		<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
		<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
	</div>
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img src="uploads/slider.jpg" class="d-block w-100" alt="...">
		</div>
		<div class="carousel-item">
			<img src="uploads/slider1.jpg" class="d-block w-100" alt="...">
		</div>
		<div class="carousel-item">
			<img src="uploads/slider2.jpg" class="d-block w-100" alt="...">
		</div>
	</div>
	<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Previous</span>
	</button>
	<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Next</span>
	</button>
	</div>
	<!-- End Slider -->
	<div class="container">
		<!-- Start Main Content --> 
				<div class="section-title text-center">
				<div class="custom-hr"></div>
					<h2 class="fw-bold">الأقــســام</h2>
				</div>
			<!-- get all categories from database -->
		<div class="row mt-5 justify-content-lg-start">
		<?php
	      	$allCats = getAllFrom("*", "categories", "where parent = 0", "", "ID", "ASC");
			foreach ($allCats as $cat) {
				echo 
				'
				<div class="col-lg-4 col-md-4 col-sm-6 cat-card main-categories">
					<div class="space">
						<div class="img"><img src="admin/uploads/items/'.$cat['image'].'" class="card-img-top" alt="..."></div>
						<div class="card-body">
							<a href="categories.php?pageid=' . $cat['ID'] . '">
							' . $cat['Name'] . '
						</a>
						</div>
					</div>
				</div>';
			}
	      ?>
		</div>
		<!-- get all categories from database -->
		<!-- Start Brands -->
		<div class="row my-5 flex-wrap">
			<div class="col-md-12"> 
				<div class="section-title text-center">
					<div class="custom-hr"></div>
					<h2 class="fw-bold">العلامات التجارية</h2>
					<div class="brands d-flex justify-content-center mt-5">
						<img src="uploads/Innova.png" alt="">
						<img src="uploads/gemma.jpg" alt="">
						<img src="uploads/Art.png" alt="">
						<img src="uploads/Porcelanosa.png" alt="">
						<img src="uploads/rak.jpg" alt="">
					</div>
				</div>
			</div>
		</div>
		<!-- End Brands -->
		</div>
	</div>
	<!-- End Main Content -->
<?php
	include $tpl . 'footer.php'; 
	ob_end_flush();
?>