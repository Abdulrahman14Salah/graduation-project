<?php 
	ob_start();
	session_start();
	include 'init.php';
	$pagetitle = 'الأقسام';
	$test = "test";
?>

<div class="container main-categories-section">
	<div class="main-title text-center"><h1 class="text-center">عرض منتجات القسم</h1></div>
	<div class="row new-item">
		<?php
		if (isset($_GET['pageid']) && is_numeric($_GET['pageid'])) {
			$category = intval($_GET['pageid']);
			$allItems = getAllFrom("*", "items", "where Cat_ID = {$category}", "AND Approve = 1", "Item_ID");
			foreach ($allItems as $item) {
				echo '
				<div class="col-lg-3 col-md-4 col-sm-6 cont-item"> 
						<div class="card">
							<div class="img"><img src="admin/uploads/items/'. $item['Image'] . '" alt=""></div>
							<div class="card-body text-center">
								<h4 class="card-title"><a href="items.php?itemid='. $item['Item_ID'] .'">' . $item['Name'] .'</a></h4>
								<div class="card-price"><span>' . $item['Price'] . '</span><span class="bound">ج</span></span></div>
								<div class="sub-title d-flex justify-content-between">
									<p class="card-text">' . $item['Country_Made'] . '</p>
									<div class="date">' . $item['Add_Date'] . '</div>
								</div>
							</div>
						</div>
					</div>
				
				';
			}
		} else {
			echo 'You Must Add Page ID';
		}
		?>
	</div>
</div>
<?php 
include $tpl . 'footer.php'; 
ob_end_flush();
?>
