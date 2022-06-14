<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title><?php getTitle() ?></title>
    <link rel="stylesheet" href="<?php echo $css ?>bootstrap.rtl.min.css" />
    <link rel="stylesheet" href="<?php echo $css ?>all.min.css" />
		<link rel="stylesheet" href="<?php echo $css ?>front.css" />
	</head>
	<body>
	<div class="upper-bar">
			<?php 
				if (isset($_SESSION['user'])) { 
          
          $stmt = $con->prepare("SELECT 
										avatar
									FROM 
										users 
									WHERE 
										UserID = ?");
			$stmt->execute(array($_SESSION['uid']));
			$get = $stmt->fetch();
          // set image in variable
          if (!empty($get['avatar'] )) {
            $finalImage = $get['avatar'];
          }else {
            $finalImage = 'avatar.png';
          }
          ?>
      <div class="dropdown">
        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        <img class="my-image img-thumbnail img-circle" src="admin/uploads/avatars/<?php echo $finalImage?>" alt="" />
        <?php echo $sessionUser ?> 
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
          <li><a class="dropdown-item" href="profile.php">الملف الشخصي</a></li>
          <li><a class="dropdown-item" href="logout.php">تسجيل الخروج</a></li>
        </ul>
      </div>
      <div class="social-links">
        <ul>
          <li><i class="fa-brands fa-facebook-f"></i></li>
          <li><i class="fa-brands fa-twitter"></i></li>
          <li><i class="fa-brands fa-instagram"></i></li>
          <li><i class="fa-brands fa-whatsapp"></i></li>
        </ul>
      </div>
<?php
				} else {
			?>
			<a class="btn btn-secondary" href="login.php">
        <span>دخول /  تسجيل</span>
			</a>
      <div class="social-links">
        <ul>
          <li><i class="fa-brands fa-facebook-f"></i></li>
          <li><i class="fa-brands fa-twitter"></i></li>
          <li><i class="fa-brands fa-instagram"></i></li>
          <li><i class="fa-brands fa-whatsapp"></i></li>
        </ul>
      </div>
			<?php } ?>
		
	</div>
	<!-- start navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
      <div class="container">
        <a class="navbar-brand" href="index.php">
          <img src="uploads/logo1.png" alt="" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#main"
          aria-controls="main"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <i class="fa-solid fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="main">
          <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link p-2 p-lg-3 active" aria-current="page" href="index.php"
                >الرئيسية</a
              >
            </li>
			<li class="nav-item">
			  <a class="nav-link p-2 p-lg-3" href="showNewCat.php">أحدث المنتجات</a>
			</li>
            <li class="nav-item">
              <a class="nav-link p-2 p-lg-3" href="about-us.php">من نحن</a>
            </li>
            <li class="nav-item">
              <a class="nav-link p-2 p-lg-3" href="contact-us.php">تواصل معنا</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="nav-categories sticky-top">
    <div class="container">
        <ul>
          <?php 
            $allCats = getAllFrom("*", "categories", "where parent = 0", "", "ID", "ASC");
            foreach ($allCats as $cat) {
              echo '
                  <li><a href="categories.php?pageid=' . $cat['ID'] . '">' . $cat['Name'] . '</a></li>
                  ';
                }
              ?>
        </ul>
    </div>
    </div>
    <!-- end navbar -->