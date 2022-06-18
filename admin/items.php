<?php

	/*
	================================================
	== Items Page
	================================================
	*/

	ob_start(); // Output Buffering Start

	session_start();

	$pageTitle = 'منتج';

	if (isset($_SESSION['Username'])) {

		include 'init.php';

		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

		if ($do == 'Manage') {


			$stmt = $con->prepare("SELECT 
										items.*, 
										categories.Name AS category_name, 
										users.Username 
									FROM 
										items
									INNER JOIN 
										categories 
									ON 
										categories.ID = items.Cat_ID 
									INNER JOIN 
										users 
									ON 
										users.UserID = items.Member_ID
									ORDER BY 
										Item_ID DESC");

			// Execute The Statement

			$stmt->execute();

			// Assign To Variable 

			$items = $stmt->fetchAll();

			if (! empty($items)) {

			?>

			<h1 class="text-center">أدارة المنتجات</h1>
			<div class="container">
				<div class="table-responsive">
					<table class="main-table text-center table table-bordered">
						<tr>
							<td>#ID</td>
							<td>أسم المنتج</td>
							<td>سعر المنتج</td>
							<td>تاريخ الأضافة</td>
							<td>القسم</td>
							<td>أسم المستخد</td>
							<td>التحكم</td>
						</tr>
						<?php
							foreach($items as $item) {
								echo "<tr>";
									echo "<td>" . $item['Item_ID'] . "</td>";
									echo "<td>" . $item['Name'] . "</td>";
									echo "<td>" . $item['Price'] . "</td>";
									echo "<td>" . $item['Add_Date'] ."</td>";
									echo "<td>" . $item['category_name'] ."</td>";
									echo "<td>" . $item['Username'] ."</td>";
									echo "<td>
										<a href='items.php?do=Edit&itemid=" . $item['Item_ID'] . "' class='btn btn-success'><i class='fa fa-edit'></i>تعديل</a>
										<a href='items.php?do=Delete&itemid=" . $item['Item_ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i>حذف</a>";
										if ($item['Approve'] == 0) {
											echo "<a 
													href='items.php?do=Approve&itemid=" . $item['Item_ID'] . "' 
													class='btn btn-info activate'>
													<i class='fa fa-check'></i>قبول</a>";
										}
									echo "</td>";
								echo "</tr>";
							}
						?>
						<tr>
					</table>
				</div>
				<a href="items.php?do=Add" class="btn btn-sm btn-primary">
					<i class="fa fa-plus"></i> منتج جديد
				</a>
			</div>

			<?php } else {

				echo '<div class="container">';
					echo '<div class="nice-message">There\'s No Items To Show</div>';
					echo '<a href="items.php?do=Add" class="btn btn-sm btn-primary">
							<i class="fa fa-plus"></i> منتج جديد
						</a>';
				echo '</div>';

			} ?>

		<?php 

		} elseif ($do == 'Add') { ?>

			<h1 class="text-center">أضافة عنصر جديد</h1>
			<div class="container">
				<form class="form-horizontal" action="?do=Insert" method="POST" enctype="multipart/form-data">
					<!-- Start Name Field -->
					<div class="form-group form-group-lg width">
						<div class="col-sm-10 col-md-6">
							<input 
								type="text" 
								name="name" 
								class="form-control" 
								required="required"  
								placeholder="Name of The Item" />
						</div>
						<label class="col-sm-1 control-label">الأسم</label>
					</div>
					<!-- End Name Field -->
					<!-- Start Price Field -->
					<div class="form-group form-group-lg width">
								<div class="col-sm-6 col-md-6">
									<input 
										type="text" 
										name="price" 
										class="form-control live" 
										placeholder="سعر المنتج" 
										data-class=".live-price" 
										required />
								</div>
								<label class="col-sm-1 control-label">السعر</label>
							</div>
							<!-- End Price Field -->
					<!-- Start Country Field -->
					<div class="form-group form-group-lg width">
						<div class="col-sm-10 col-md-6">
							<input 
								type="text" 
								name="country" 
								class="form-control" 
								required="required" 
								placeholder="Country of Made" />
						</div>
						<label class="col-sm-1 control-label">البلد</label>
					</div>
					<!-- End Country Field -->
					<!-- Start Members Field -->
					<div class="form-group form-group-lg width">
						<div class="col-sm-10 col-md-6">
							<select name="member">
								<option value="0">...</option>
								<?php
									$allMembers = getAllFrom("*", "users", "", "", "UserID");
									foreach ($allMembers as $user) {
										echo "<option value='" . $user['UserID'] . "'>" . $user['Username'] . "</option>";
									}
								?>
							</select>
						</div>
						<label class="col-sm-1 control-label">العضو</label>
					</div>
					<!-- End Members Field -->
					<!-- Start Categories Field -->
					<div class="form-group form-group-lg width">
						<div class="col-sm-10 col-md-6">
							<select name="category">
								<option value="0">...</option>
								<?php
									$allCats = getAllFrom("*", "categories", "where parent = 0", "", "ID");
									foreach ($allCats as $cat) {
										echo "<option value='" . $cat['ID'] . "'>" . $cat['Name'] . "</option>";
										$childCats = getAllFrom("*", "categories", "where parent = {$cat['ID']}", "", "ID");
										foreach ($childCats as $child) {
											echo "<option value='" . $child['ID'] . "'>--- " . $child['Name'] . "</option>";
										}
									}
								?>
							</select>
						</div>
						<label class="col-sm-1 control-label">القسم</label>
					</div>
					<!-- End Categories Field -->
					<!-- Start Tags Field -->
					<div class="form-group form-group-lg width">
						<div class="col-sm-10 col-md-6">
							<input 
								type="text" 
								name="tags" 
								class="form-control" 
								placeholder="أفصل التاج بـ(,)" />
						</div>
						<label class="col-sm-1 control-label">تاج</label>
					</div>
					<!-- End Tags Field -->
					<!-- Start Image Field -->
					<div class="form-group form-group-lg width">
						<div class="col-sm-10 col-md-6">
							<input type="file" name="image" class="form-control" required="required" />
						</div>
						<label class="col-sm-1 control-label">أستخدم صورة</label>
					</div>
					<!-- End Image Field -->
					<!-- Start Submit Field -->
					<div class="form-group form-group-lg width">
						<div class="col-sm-offset-2 col-sm-4">
							<input type="submit" value="أضافة منتج" class="btn btn-primary btn-sm" />
						</div>
					</div>
					<!-- End Submit Field -->
				</form>
			</div>

			<?php

		} elseif ($do == 'Insert') {

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				echo "<h1 class='text-center'>Insert Item</h1>";
				echo "<div class='container'>";

				// Upload Variables

				$imageName = $_FILES['image']['name'];
				$imageSize = $_FILES['image']['size'];
				$imageTmp	= $_FILES['image']['tmp_name'];
				$imageType = $_FILES['image']['type'];

				// Get Variables From The Form

				$name		= $_POST['name'];
				$price		= $_POST['price'];
				$country 	= $_POST['country'];
				$member 	= $_POST['member'];
				$cat 		= $_POST['category'];
				$tags 		= $_POST['tags'];

				// Validate The Form

				$formErrors = array();

				if (empty($name)) {
					$formErrors[] = 'الأسم لا يمكن أن يكون فارغ';
				}

				if (empty($price)) {
					$formErrors[] = 'السعر لا يمكن أن يكون فارغ';
				}

				if (empty($country)) {
					$formErrors[] = 'البلد لا يمكن أن يكون فارغ';
				}

				if ($member == 0) {
					$formErrors[] = 'العضو لا يمكن أن يكون فارغ';
				}

				if ($cat == 0) {
					$formErrors[] = 'القسم لا يمكن أن يكون فارغ';
				}

				// Loop Into Errors Array And Echo It

				foreach($formErrors as $error) {
					echo '<div class="alert alert-danger">' . $error . '</div>';
				}

				// Check If There's No Error Proceed The Update Operation

				if (empty($formErrors)) {
					
					$image = rand(0, 10000000000) . '_' . $imageName;

					move_uploaded_file($imageTmp, "uploads/items/" . $image);


					// Insert Userinfo In Database

					$stmt = $con->prepare("INSERT INTO 

						items(Name, Price,Country_Made, Add_Date, Cat_ID, Member_ID, tags, image)

						VALUES(:zname, :zprice,:zcountry, now(), :zcat, :zmember, :ztags, :zimage)");

					$stmt->execute(array(

						'zname' 	=> $name,
						'zprice' 	=> $price,
						'zcountry' 	=> $country,
						'zcat'		=> $cat,
						'zmember'	=> $member,
						'ztags'		=> $tags,
						'zimage'		=> $image

					));

					// Echo Success Message

					$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' تم التسجيل </div>';

					redirectHome($theMsg, 'back');

				}

			} else {

				echo "<div class='container'>";

				$theMsg = '<div class="alert alert-danger">لا يمكن الدخول المباشر</div>';

				redirectHome($theMsg);

				echo "</div>";

			}

			echo "</div>";

		} elseif ($do == 'Edit') {

			// Check If Get Request item Is Numeric & Get Its Integer Value

			$itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

			// Select All Data Depend On This ID

			$stmt = $con->prepare("SELECT * FROM items WHERE Item_ID = ?");

			// Execute Query

			$stmt->execute(array($itemid));

			// Fetch The Data

			$item = $stmt->fetch();

			// The Row Count

			$count = $stmt->rowCount();

			// If There's Such ID Show The Form

			if ($count > 0) { ?>

				<h1 class="text-center">تعديل عنصر</h1>
				<div class="container">
					<form class="form-horizontal" action="?do=Update" method="POST">
						<input type="hidden" name="itemid" value="<?php echo $itemid ?>" />
						<!-- Start Name Field -->
						<div class="form-group form-group-lg width">
							<div class="col-sm-6 col-md-6">
								<input 
									type="text" 
									name="name" 
									class="form-control" 
									required="required"  
									placeholder="أسم المنتج"
									value="<?php echo $item['Name'] ?>" />
							</div>
							<label class="col-sm-1 control-label">أسم</label>
						</div>
						<!-- End Name Field -->
						<!-- Start Price Field -->
					<div class="form-group form-group-lg width">
								<div class="col-sm-6 col-md-6">
									<input 
										type="text" 
										name="price" 
										class="form-control live" 
										placeholder="سعر المنتج" 
										data-class=".live-price" 
										required />
								</div>
								<label class="col-sm-1 control-label">السعر</label>
							</div>
							<!-- End Price Field -->
						<!-- Start Country Field -->
						<div class="form-group form-group-lg width">
							<div class="col-sm-10 col-md-6">
								<input 
								type="text" 
								name="country" 
								class="form-control" 
								required="required" 
								placeholder="بلد المنتج"
								value="<?php echo $item['Country_Made'] ?>" />
							</div>
							<label class="col-sm-1 control-label">البلد</label>
						</div>
						<!-- End Country Field -->
						<!-- Start Members Field -->
						<div class="form-group form-group-lg width">
							<div class="col-sm-10 col-md-6">
								<select name="member">
									<?php
										$allMembers = getAllFrom("*", "users", "", "", "UserID");
										foreach ($allMembers as $user) {
											echo "<option value='" . $user['UserID'] . "'"; 
											if ($item['Member_ID'] == $user['UserID']) { echo 'selected'; } 
											echo ">" . $user['Username'] . "</option>";
										}
									?>
								</select>
							</div>
						</div>
						<!-- End Members Field -->
						<!-- Start Categories Field -->
						<div class="form-group form-group-lg width">
							<div class="col-sm-10 col-md-6">
								<select name="category">
									<?php
										$allCats = getAllFrom("*", "categories", "where parent = 0", "", "ID");
										foreach ($allCats as $cat) {
											echo "<option value='" . $cat['ID'] . "'";
											if ($item['Cat_ID'] == $cat['ID']) { echo ' selected'; }
											echo ">" . $cat['Name'] . "</option>";
											$childCats = getAllFrom("*", "categories", "where parent = {$cat['ID']}", "", "ID");
											foreach ($childCats as $child) {
												echo "<option value='" . $child['ID'] . "'";
												if ($item['Cat_ID'] == $child['ID']) { echo ' selected'; }
												echo ">--- " . $child['Name'] . "</option>";
											}
										}
									?>
								</select>
							</div>
							<label class="col-sm-1 control-label">القسم</label>
						</div>
						<!-- End Categories Field -->
						<!-- Start Tags Field -->
						<div class="form-group form-group-lg width">
							<div class="col-sm-10 col-md-6">
								<input 
									type="text" 
									name="tags" 
									class="form-control" 
									placeholder="(,)أستخدم الفاصلة لفصل التاجات" 
									value="<?php echo $item['tags'] ?>" />
							</div>
							<label class="col-sm-1 control-label">تاج</label>
						</div>
						<!-- End Tags Field -->
						<!-- Start Submit Field -->
						<div class="form-group form-group-lg width">
							<div class="col-sm-offset-2 col-sm-4">
								<input type="submit" value="حفظ" class="btn btn-primary btn-sm fw-bold" />
							</div>
						</div>
						<!-- End Submit Field -->
					</form>

					<?php

					// Select All Users Except Admin 

					$stmt = $con->prepare("SELECT 
												comments.*, users.Username AS Member  
											FROM 
												comments
											INNER JOIN 
												users 
											ON 
												users.UserID = comments.user_id
											WHERE item_id = ?");

					// Execute The Statement

					$stmt->execute(array($itemid));

					// Assign To Variable 

					$rows = $stmt->fetchAll();

					if (! empty($rows)) {
						
					?>
					<h1 class="text-center">تحكم [ <?php echo $item['Name'] ?> ] تعليق</h1>
					<div class="table-responsive">
						<table class="main-table text-center table table-bordered">
							<tr>
								<td>تعليق</td>
								<td>أسم المستخدم</td>
								<td>تاريخ التسجيل</td>
								<td>التحكم</td>
							</tr>
							<?php
								foreach($rows as $row) {
									echo "<tr>";
										echo "<td>" . $row['comment'] . "</td>";
										echo "<td>" . $row['Member'] . "</td>";
										echo "<td>" . $row['comment_date'] ."</td>";
										echo "<td>
											<a href='comments.php?do=Edit&comid=" . $row['c_id'] . "' class='btn btn-success'><i class='fa fa-edit'></i>تعديل</a>
											<a href='comments.php?do=Delete&comid=" . $row['c_id'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i>حذف</a>";
											if ($row['status'] == 0) {
												echo "<a href='comments.php?do=Approve&comid="
														 . $row['c_id'] . "' 
														class='btn btn-info activate'>
														<i class='fa fa-check'></i>قبول</a>";
											}
										echo "</td>";
									echo "</tr>";
								}
							?>
							<tr>
						</table>
					</div>
					<?php } ?>
				</div>

			<?php

			// If There's No Such ID Show Error Message

			} else {

				echo "<div class='container'>";

				$theMsg = '<div class="alert alert-danger">لا يوجد هذا ID</div>';

				redirectHome($theMsg);

				echo "</div>";

			}			

		} elseif ($do == 'Update') {

			echo "<h1 class='text-center'>Update Item</h1>";
			echo "<div class='container'>";

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				// Get Variables From The Form

				$id 		= $_POST['itemid'];
				$price 		= $_POST['price'];
				$name 		= $_POST['name'];
				$country	= $_POST['country'];
				$cat 		= $_POST['category'];
				$member 	= $_POST['member'];
				$tags 		= $_POST['tags'];

				// Validate The Form

				$formErrors = array();

				if (empty($name)) {
					$formErrors[] = 'الاسم مطلوب';
				}

				if (empty($name)) {
					$formErrors[] = 'السعر مطلوب';
				}

				if (empty($country)) {
					$formErrors[] = 'الدولة مطلوبة';
				}

				if ($member == 0) {
					$formErrors[] = 'المستخدم مطلوب';
				}

				if ($cat == 0) {
					$formErrors[] = 'القسم مطلوب';
				}

				// Loop Into Errors Array And Echo It

				foreach($formErrors as $error) {
					echo '<div class="alert alert-danger">' . $error . '</div>';
				}

				// Check If There's No Error Proceed The Update Operation

				if (empty($formErrors)) {

					// Update The Database With This Info

					$stmt = $con->prepare("UPDATE 
												items 
											SET 
												Name = ?,
												Price = ?, 
												Country_Made = ?,
												Cat_ID = ?,
												Member_ID = ?,
												tags = ?
											WHERE 
												Item_ID = ?");

					$stmt->execute(array($name, $price,$country, $cat, $member, $tags, $id));

					// Echo Success Message

					$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' تم التسجيل</div>';

					redirectHome($theMsg, 'back');

				}

			} else {

				$theMsg = '<div class="alert alert-danger">لا يمكن الدخول المباشر</div>';

				redirectHome($theMsg);

			}

			echo "</div>";

		} elseif ($do == 'Delete') {

			echo "<h1 class='text-center'>حذف المنتج</h1>";
			echo "<div class='container'>";

				// Check If Get Request Item ID Is Numeric & Get The Integer Value Of It

				$itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

				// Select All Data Depend On This ID

				$check = checkItem('Item_ID', 'items', $itemid);

				// If There's Such ID Show The Form

				if ($check > 0) {

					$stmt = $con->prepare("DELETE FROM items WHERE Item_ID = :zid");

					$stmt->bindParam(":zid", $itemid);

					$stmt->execute();

					$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . 'تم التسجيل</div>';

					redirectHome($theMsg, 'back');

				} else {

					$theMsg = '<div class="alert alert-danger">هذا العنصر غير موجود</div>';

					redirectHome($theMsg);

				}

			echo '</div>';

		} elseif ($do == 'Approve') {

			echo "<h1 class='text-center'>قبول المنتج</h1>";
			echo "<div class='container'>";

				// Check If Get Request Item ID Is Numeric & Get The Integer Value Of It

				$itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

				// Select All Data Depend On This ID

				$check = checkItem('Item_ID', 'items', $itemid);

				// If There's Such ID Show The Form

				if ($check > 0) {

					$stmt = $con->prepare("UPDATE items SET Approve = 1 WHERE Item_ID = ?");

					$stmt->execute(array($itemid));

					$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' تم التسجيل</div>';

					redirectHome($theMsg, 'back');

				} else {

					$theMsg = '<div class="alert alert-danger">هذا العنصر غير موجود</div>';

					redirectHome($theMsg);

				}

			echo '</div>';

		}

		include $tpl . 'footer.php';

	} else {

		header('Location: index.php');

		exit();
	}

	ob_end_flush(); // Release The Output

?>