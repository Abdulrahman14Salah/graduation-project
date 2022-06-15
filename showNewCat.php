<?php 
	session_start();
	include 'init.php';
	$pageTitle = 'أحدث المنتجات';
    $allItems = getAllFrom('*', 'items', 'where Approve = 1', '', 'Item_ID');
?>
<div class="container">
	<div class="main-title text-center"><h1 class="text-center">أحدث المنتجات</h1></div>
    <div class="row mt-3 new-item">
		<?php
			foreach ($allItems as $item) {
				echo '
					<div class="col-lg-3 col-md-4 col-sm-6 cont-item"> 
						<div class="card">
							<div class="img"><img src="admin/uploads/items/'. $item['Image'] . '" alt=""></div>
							<div class="card-body text-center">
								<h4 class="card-title"><a href="items.php?itemid='. $item['Item_ID'] .'">' . $item['Name'] . $item['Price'] .'</a></h4>
								<p class="card-text">' . $item['Country_Made'] . '</p>
								<div class="date">' . $item['Add_Date'] . '</div>
							</div>
						</div>
					</div>';
			}
		?>
		</div>
</div>

<?php include $tpl . 'footer.php'; ?>