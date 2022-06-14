<nav class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="app-nav">
      <ul class="nav navbar-nav">
        <li><a href="dashboard.php"><?php echo lang('HOME_ADMIN') ?></a></li>
        <li><a href="categories.php"><?php echo lang('CATEGORIES') ?></a></li>
        <li><a href="items.php"><?php echo lang('ITEMS') ?></a></li>
        <li><a href="members.php"><?php echo lang('MEMBERS') ?></a></li>
        <li><a href="comments.php"><?php echo lang('COMMENTS') ?></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="caret mx-3"></span><?php echo $_SESSION['Username']; ?></a>
          <ul class="dropdown-menu">
            <li><a href="../index.php">زيارة الموقع</a></li>
            <li><a href="members.php?do=Edit&userid=<?php echo $_SESSION['ID'] ?>">تعديل الملف الشخصي</a></li>
            <li><a href="logout.php">تسجيل الخروج</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>