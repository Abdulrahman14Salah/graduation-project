<?php
	ob_start();
	session_start();
	$pageTitle = 'بيانات المنتج';
	include 'init.php';

	// Check If Get Request item Is Numeric & Get Its Integer Value
	$itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

	// Select All Data Depend On This ID
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
							WHERE 
								Item_ID = ?
							AND 
								Approve = 1");

	// Execute Query
	$stmt->execute(array($itemid));

	$count = $stmt->rowCount();

	if ($count > 0) {

	// Fetch The Data
	$item = $stmt->fetch();
?>
<div class="container">
	<h1 class="text-center main-title-item">تفاصيل المنتج</h1>
	<div class="row section-single-item">
		<div class="col-md-3">
			<img class="img-responsive img-thumbnail center-block mt-4" src="admin/uploads/items/<?php echo $item['Image']?>" alt="" />
		</div>
		<div class="col-md-9 item-info">
			<h2><span>أسم المنتج : </span> <?php echo $item['Name'] ?></h2>
			<ul class="list-unstyled">
				<li>
					<i class="fa fa-calendar fa-fw"></i>
					<span>تاريخ الأضافة</span> : <?php echo $item['Add_Date'] ?>
				</li>
				<li>
					<i class="fa fa-building fa-fw"></i>
					<span>صنع في : </span><?php echo $item['Country_Made'] ?>
				</li>
				<li>
					<i class="fa fa-tags fa-fw"></i>
					<span>قسم : </span><a href="categories.php?pageid=<?php echo $item['Cat_ID'] ?>"><?php echo $item['category_name'] ?></a>
				</li>
				<li>
					<i class="fa fa-user fa-fw"></i>
					<span>أضاف بواسطة : </span><a href="profile.php"><?php echo $item['Username'] ?></a>
				</li>
				<li class="tags-items">
					<i class="fa fa-user fa-fw"></i>
					<span>Tags</span> : 
					<?php 
						$allTags = explode(",", $item['tags']);
						foreach ($allTags as $tag) {
							$tag = str_replace(' ', '', $tag);
							$lowertag = strtolower($tag);
							if (! empty($tag)) {
								echo "<a href='tags.php?name={$lowertag}'>" . $tag . '</a>';
							}
						}
					?>
				</li>
			</ul>
		</div>
	</div>
	<hr class="custom-hr">
	<?php if (isset($_SESSION['user'])) { ?>
	<!-- Start Add Comment -->
	<div class="row">
		<div class="col-md-offset-3">
			<div class="add-comment d-flex">
				<h2>أضف تعليقك</h2>
				<form action="<?php echo $_SERVER['PHP_SELF'] . '?itemid=' . $item['Item_ID'] ?>" method="POST">
					<textarea name="comment" required></textarea>
					<input class="btn btn-secondary" type="submit" value="أضف تعليق">
				</form>
				<?php 
					if ($_SERVER['REQUEST_METHOD'] == 'POST') {

						$comment 	= filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
						$itemid 	= $item['Item_ID'];
						$userid 	= $_SESSION['uid'];

						if (! empty($comment)) {

							$stmt = $con->prepare("INSERT INTO 
								comments(comment, status, comment_date, item_id, user_id)
								VALUES(:zcomment, 0, NOW(), :zitemid, :zuserid)");

							$stmt->execute(array(

								'zcomment' => $comment,
								'zitemid' => $itemid,
								'zuserid' => $userid

							));

							if ($stmt) {

								echo '<div class="alert alert-success mt-5">تم أضافة التعليق</div>';

							}

						} else {

							echo '<div class="alert alert-danger">يجب أضافة تعليق</div>';

						}

					}
				?>
			</div>
		</div>
	</div>
	<!-- End Add Comment -->
	<?php } else {
		echo '<a href="login.php">Login</a> or <a href="login.php">تسجيل</a>';
	} ?>
	<hr class="custom-hr">
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
									WHERE 
										item_id = ?
									AND 
										status = 1
									ORDER BY 
										c_id DESC");

			// Execute The Statement

			$stmt->execute(array($item['Item_ID']));

			// Assign To Variable 

			$comments = $stmt->fetchAll();

		?>
	
	<?php foreach ($comments as $comment) { ?>
		<div class="comment-box">
			<div class="row">
				<div class="col-sm-2 text-center">
					<img class="img-responsive img-thumbnail img-circle center-block" src="img.png" alt="" />
					<?php echo $comment['Member'] ?>
				</div>
				<div class="col-sm-10">
					<p class="lead"><?php echo $comment['comment'] ?></p>
				</div>
			</div>
		</div>
		<hr class="custom-hr">
	<?php } ?>
</div>
<?php
	} else {
		echo '<div class="container">';
			echo '<div class="alert alert-danger">خطأ</div>';
		echo '</div>';
	}
	include $tpl . 'footer.php';
	ob_end_flush();
?>