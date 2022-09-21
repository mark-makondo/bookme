<nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-4 py-lg-2 shadow-sm sticky-top" id="main-navbar">
  <div class="container-fluid p-0">
    <a class="navbar-brand me-5 fw-bold fs-3 h-font site-title" href="index.php"></a>
    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link me-2" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="rooms.php">Rooms</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="facilities.php">Facilities</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="contact-us.php">Contact us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="about.php">About</a>
        </li>
      </ul>
      <div class="d-flex gap-1">
        <?php
          $isLogin = isset($_SESSION['login']) && $_SESSION['login'] == true;
          $path = USERS_IMG_PATH;
        ?>
        <?php if($isLogin):?>
            <div class="btn-group">
                <button type=">button" class="btn btn-outline-dark shadow-none dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                    <img src="<?=$path?><?=$_SESSION['picture']?>" width="25" height="25" class="me-1 rounded">
                    <span><?=$_SESSION['name']?></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li><a class="dropdown-item" href="user/profile.php">Profile</a></li>
                    <li><a class="dropdown-item" href="user/bookings.php">Bookings</a></li>
                    <li><a class="dropdown-item" href="user/logout.php">Logout</a></li>
                </ul>
            </div>
        <?php else:?>
            <button type="button" class="btn btn-outline-dark shadow-none me-lg-2 me-3" data-bs-toggle="modal" data-bs-target="#login-modal">Login</button>
            <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal" data-bs-target="#register-modal">Register</button>
        <?php endif?>
      </div>
    </div>
  </div>
</nav>

<!-- MODAL  -->
<?php include 'auth/login.php' ?>
<?php include 'auth/register.php' ?>
<?php include 'auth/forgot-password.php' ?>