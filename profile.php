<?php
	ob_start();
	session_start();
	$pageTitle = 'الملف الشخصي';
	include 'init.php';
	if (isset($_SESSION['user'])) {
		$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
		$getUser->execute(array($sessionUser));
		$info = $getUser->fetch();
		$userid = $info['UserID'];
?>
<h1 class="text-center">الملف الشخصي</h1>
<div class="container">
	<table class="table">
		<thead>
			<tr>
			<th scope="row">معلوماتي</th>
			</tr>
		</thead>
			<tbody>
				<tr>
					<th scope="col"><i class="fa fa-unlock-alt fa-fw"></i><span>أسم المستخدم</span> : <?php echo $info['Username'] ?></th>
				</tr>
				<tr>
					<th scope="col"><i class="fas fa-envelope"></i><span>البريد الألكتروني</span> : <?php echo $info['Email'] ?></th>
				</tr>
				<tr>
					<th scope="col"><i class="fa fa-user fa-fw"></i><span>الأسم بالكامل</span> : <?php echo $info['FullName'] ?></th>
				</tr>
				<tr>
					<th scope="col"><i class="fa fa-calendar fa-fw"></i><span>تاريخ التسجيل</span> : <?php echo $info['Date'] ?></th>
				</tr>
		</tbody>
	</table>
</div>
<!-- end info block  -->

<!-- start commet block -->
<div class="my-comments block">
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">اخر التعليقات</div>
			<div class="panel-body">
			<?php
				$myComments = getAllFrom("comment", "comments", "where user_id = $userid", "", "c_id");
				if (! empty($myComments)) {
					foreach ($myComments as $comment) {
						echo '<p>' . $comment['comment'] . '</p>';
					}
				} else {
					echo 'لا يوجد تعليقات لعرضها';
				}
			?>
			</div>
		</div>
	</div>
</div>
<?php
	} else {
		header('Location: login.php');
		exit();
	}
	include $tpl . 'footer.php';
	ob_end_flush();
?>