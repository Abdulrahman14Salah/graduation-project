<?php
	ob_start();
	session_start();
	include 'init.php';
	$pageTitle = 'أحدث المنتجات';
    $allItems = getAllFrom('*', 'items', 'where Approve = 1', '', 'Item_ID');
?>
<div class="container">
	<div class="main-title text-center"><h1 class="text-center"><?php echo $pageTitle ?></h1></div>
    <div class="row mt-3 new-item">
		<?php
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
					</div>';
			}
		?>
		</div>
</div>

<?php 
include $tpl . 'footer.php'; 
ob_end_flush();
?>
