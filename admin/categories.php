<?php

	/*
	================================================
	== Category Page
	================================================
	*/

	ob_start(); // Output Buffering Start

	session_start();

	$pageTitle = 'Categories';

	if (isset($_SESSION['Username'])) {

		include 'init.php';

		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

		if ($do == 'Manage') {

			$sort = 'asc';

			$sort_array = array('asc', 'desc');

			if (isset($_GET['sort']) && in_array($_GET['sort'], $sort_array)) {

				$sort = $_GET['sort'];

			}

			$stmt2 = $con->prepare("SELECT * FROM categories WHERE parent = 0 ORDER BY Ordering $sort");

			$stmt2->execute();

			$cats = $stmt2->fetchAll(); 

			if (! empty($cats)) {

			?>

			<h1 class="text-center">أدارة الأقسام</h1>
			<div class="container categories">
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-edit"></i> أدارة الأقسام
						<div class="option pull-right">
							<i class="fa fa-sort"></i> ترتيب : [
							<a class="<?php if ($sort == 'asc') { echo 'active'; } ?>" href="?sort=asc">تصاعدي</a> | 
							<a class="<?php if ($sort == 'desc') { echo 'active'; } ?>" href="?sort=desc">تنازلي</a> ]
						</div>
					</div>
					<div class="panel-body">
						<?php
							foreach($cats as $cat) {
								echo "<div class='cat'>";
									echo "<div class='hidden-buttons'>";
										echo "<a href='categories.php?do=Edit&catid=" . $cat['ID'] . "' class='btn btn-xs btn-primary'><i class='fa fa-edit'></i> تعديل</a>";
										echo "<a href='categories.php?do=Delete&catid=" . $cat['ID'] . "' class='confirm btn btn-xs btn-danger'><i class='fa fa-close'></i> حذف</a>";
									echo "</div>";
									echo "<h3>" . $cat['Name'] . '</h3>';
									echo "<div class='full-view'>";
										if($cat['Visibility'] == 1) { echo '<span class="visibility cat-span"><i class="fa fa-eye"></i> Hidden</span>'; } 
										if($cat['Allow_Comment'] == 1) { echo '<span class="commenting cat-span"><i class="fa fa-close"></i> Comment Disabled</span>'; }
										if($cat['Allow_Ads'] == 1) { echo '<span class="advertises cat-span"><i class="fa fa-close"></i> Ads Disabled</span>'; }  
									echo "</div>";

									// Get Child Categories
							      	$childCats = getAllFrom("*", "categories", "where parent = {$cat['ID']}", "", "ID", "ASC");
							      	if (! empty($childCats)) {
								      	echo "<h4 class='child-head'>Child Categories</h4>";
								      	echo "<ul class='list-unstyled child-cats'>";
										foreach ($childCats as $c) {
											echo "<li class='child-link'>
												<a href='categories.php?do=Edit&catid=" . $c['ID'] . "'>" . $c['Name'] . "</a>
												<a href='categories.php?do=Delete&catid=" . $c['ID'] . "' class='show-delete confirm'> حذف</a>
											</li>";
										}
										echo "</ul>";
									}

								echo "</div>";
								echo "<hr>";
							}
						?>
					</div>
				</div>
				<a class="add-category btn btn-primary" href="categories.php?do=Add"><i class="fa fa-plus"></i> أضافة قسم جديد</a>
			</div>

			<?php } else {

				echo '<div class="container">';
					echo '<div class="nice-message">لا يوجد أقسام لعرضها</div>';
					echo '<a href="categories.php?do=Add" class="btn btn-primary">
							<i class="fa fa-plus"></i> قسم جديد
						</a>';
				echo '</div>';

			} ?>

			<?php

		} elseif ($do == 'Add') { ?>

			<h1 class="text-center">أضافة قسم جديد</h1>
			<div class="container">
				<form class="form-horizontal form" action="?do=Insert" method="POST" enctype="multipart/form-data">
					<!-- Start Name Field -->
					<div class="form-group-add form-group">
						<div class="col-sm-10 col-md-6">
							<input type="text" name="name" class="form-control" autocomplete="off" required="required" placeholder="أسم القسم" />
						</div>
						<label class="col-sm-1 control-label">الأسم</label>
					</div>
					<!-- End Name Field -->
					<!-- Start Ordering Field -->
					<div class="form-group-add form-group">
						<div class="col-sm-10 col-md-6">
							<input type="text" name="ordering" class="form-control" placeholder="عدد لترتيب الأقسام" />
						</div>
						<label class="col-sm-1 control-label">الترتيب</label>
					</div>
					<!-- End Ordering Field -->
					<!-- Start Visibility Field -->
					<div class="form-group-add form-group">
						<div class="col-sm-10 col-md-6 group-check">
							<div>
								<input id="vis-yes" type="radio" name="visibility" value="0" checked />
								<label for="vis-yes">نعم</label> 
							</div>
							<div>
								<input id="vis-no" type="radio" name="visibility" value="1" />
								<label for="vis-no">لا</label> 
							</div>
						</div>
						<label class="col-sm-1 control-label">الظهور</label>
					</div>
					<!-- End Visibility Field -->
					<!-- Start Commenting Field -->
					<div class="form-group-add form-group">
						<div class="col-sm-10 col-md-6 group-check">
							<div>
								<input id="com-yes" type="radio" name="commenting" value="0" checked />
								<label for="com-yes">نعم</label> 
							</div>
							<div>
								<input id="com-no" type="radio" name="commenting" value="1" />
								<label for="com-no">لا</label> 
							</div>
						</div>
						<label class="col-sm-1 control-label">قبول التعليقات</label>
					</div>
					<!-- End Commenting Field -->
					<!-- Start Image Field -->
					<div class="form-group-add form-group flex-row-reverse">
						<div class="col-sm-10 col-md-6 group-check">
							<input type="file" name="imagecat" class="form-control" required="required" />
						</div>
						<label class="col-sm-1 control-label">الصورة</label>
					</div>
					<!-- End Image Field -->
					<!-- Start Submit Field -->
					<div class="form-group-add form-group">
						<div class="col-sm-5">
							<input type="submit" value="أضافة قسم" class="btn btn-primary btn-sm" />
						</div>
					</div>
					<!-- End Submit Field -->
				</form>
			</div>

			<?php

		} elseif ($do == 'Insert') {

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				echo "<h1 class='text-center'>Insert Category</h1>";
				echo "<div class='container'>";

				// Upload Variables

				$imagecatName = $_FILES['imagecat']['name'];
				$imagecatSize = $_FILES['imagecat']['size'];
				$imagecatTmp	= $_FILES['imagecat']['tmp_name'];
				$imagecatType = $_FILES['imagecat']['type'];

				// Get Variables From The Form

				$name 		= $_POST['name'];
				$order 		= $_POST['ordering'];
				$visible 	= $_POST['visibility'];
				$comment 	= $_POST['commenting'];

				// Check If Category Exist in Database

				$check = checkItem("Name", "categories", $name);

				if ($check == 1) {

					$theMsg = '<div class="alert alert-danger">هذا القسم موجود بالفعل</div>';

					redirectHome($theMsg, 'back');

				} else {

					$imagecat = rand(0, 10000000000) . '_' . $imagecatName;

					move_uploaded_file($imagecatTmp, "uploads\items\\" . $imagecat);


					// Insert Category Info In Database

					$stmt = $con->prepare("INSERT INTO 

						categories(Name,  Ordering, Visibility, Allow_Comment, image)

					VALUES(:zname, :zorder, :zvisible, :zcomment, :zimage)");

					$stmt->execute(array(
						'zname' 	=> $name,
						'zorder' 	=> $order,
						'zvisible' 	=> $visible,
						'zcomment' 	=> $comment,
						'zimage'	=> $imagecat
					));

					// Echo Success Message

					$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' تم ادراج العنصر</div>';

					redirectHome($theMsg, 'back');

				}

			} else {

				echo "<div class='container'>";

				$theMsg = '<div class="alert alert-danger">عذرا لا يمكنك تصفح هذه الصفحة مباشرة</div>';

				redirectHome($theMsg, 'back');

				echo "</div>";

			}

			echo "</div>";

		} elseif ($do == 'Edit') {

			// Check If Get Request catid Is Numeric & Get Its Integer Value

			$catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;

			// Select All Data Depend On This ID

			$stmt = $con->prepare("SELECT * FROM categories WHERE ID = ?");

			// Execute Query

			$stmt->execute(array($catid));

			// Fetch The Data

			$cat = $stmt->fetch();

			// The Row Count

			$count = $stmt->rowCount();

			// If There's Such ID Show The Form

			if ($count > 0) { ?>

				<h1 class="text-center">تعديل القسم</h1>
				<div class="container">
					<form class="form-horizontal width" action="?do=Update" method="POST">
						<input type="hidden" name="catid" value="<?php echo $catid ?>" />
						<!-- Start Name Field -->
						<div class="form-group form-group-lg">
							<div class="col-sm-10 col-md-6">
								<input type="text" name="name" class="form-control" required="required" placeholder="Name Of The Category" value="<?php echo $cat['Name'] ?>" />
							</div>
							<label class="col-sm-1 control-label">الأسم</label>
						</div>
						<!-- End Name Field -->
						<!-- Start Ordering Field -->
						<div class="form-group form-group-lg">
							<div class="col-sm-10 col-md-6">
								<input type="text" name="ordering" class="form-control" placeholder="عدد لترتيب العناصر" value="<?php echo $cat['Ordering'] ?>" />
							</div>
							<label class="col-sm-1 control-label">الترتيب</label>
						</div>
						<!-- End Ordering Field -->
						<!-- Start Visibility Field -->
						<div class="form-group form-group-lg">
							
							<div class="col-sm-10 col-md-6">
								<div>
									<input id="vis-yes" type="radio" name="visibility" value="0" <?php if ($cat['Visibility'] == 0) { echo 'checked'; } ?> />
									<label for="vis-yes">نعم</label> 
								</div>
								<div>
									<input id="vis-no" type="radio" name="visibility" value="1" <?php if ($cat['Visibility'] == 1) { echo 'checked'; } ?> />
									<label for="vis-no">لا</label> 
								</div>
							</div>
							<label class="col-sm-1 control-label">عرض</label>
						</div>
						<!-- End Visibility Field -->
						<!-- Start Commenting Field -->
						<div class="form-group form-group-lg">
							<div class="col-sm-10 col-md-6">
								<div>
									<input id="com-yes" type="radio" name="commenting" value="0" <?php if ($cat['Allow_Comment'] == 0) { echo 'checked'; } ?> />
									<label for="com-yes">نعم</label> 
								</div>
								<div>
									<input id="com-no" type="radio" name="commenting" value="1" <?php if ($cat['Allow_Comment'] == 1) { echo 'checked'; } ?> />
									<label for="com-no">لا</label> 
								</div>
							</div>
							<label class="col-sm-1 control-label">قبول التعليق</label>
						</div>
						<!-- End Commenting Field -->
						<!-- Start Submit Field -->
						<div class="form-group form-group-lg">
							<div class="col-sm-offset-2 col-sm-4">
								<input type="submit" value="حفظ" class="btn btn-primary btn-sm" />
							</div>
						</div>
						<!-- End Submit Field -->
					</form>
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

			echo "<h1 class='text-center'>تحديث الأقسام</h1>";
			echo "<div class='container'>";

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				// Get Variables From The Form

				$id 		= $_POST['catid'];
				$name 		= $_POST['name'];
				$order 		= $_POST['ordering'];
				$visible 	= $_POST['visibility'];
				$comment 	= $_POST['commenting'];

				// Update The Database With This Info

				$stmt = $con->prepare("UPDATE 
											categories 
										SET 
											Name = ?, 
											Ordering = ?,
											Visibility = ?,
											Allow_Comment = ?,
										WHERE 
											ID = ?");

				$stmt->execute(array($name, $order, $visible, $comment, $id));

				// Echo Success Message

				$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' تم تحديث السجل</div>';

				redirectHome($theMsg, 'back');

			} else {

				$theMsg = '<div class="alert alert-danger">لا يمكن الدخول المباشر</div>';

				redirectHome($theMsg);

			}

			echo "</div>";

		} elseif ($do == 'Delete') {

			echo "<h1 class='text-center'>حذف القسم</h1>";
			echo "<div class='container'>";

				// Check If Get Request Catid Is Numeric & Get The Integer Value Of It

				$catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;

				// Select All Data Depend On This ID

				$check = checkItem('ID', 'categories', $catid);

				// If There's Such ID Show The Form

				if ($check > 0) {

					$stmt = $con->prepare("DELETE FROM categories WHERE ID = :zid");

					$stmt->bindParam(":zid", $catid);

					$stmt->execute();

					$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' تم حذف السجل</div>';

					redirectHome($theMsg, 'back');

				} else {

					$theMsg = '<div class="alert alert-danger">لا يوجد هذا العنصر</div>';

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