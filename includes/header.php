<?php
    include('includes/user.php');
?>

<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top">

      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>


      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link active" href="index.php">
			<img class="bannericons" src="images/home.jfif">Home<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
			<img class="bannericons" src="images/lightning.png">Moments</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="notifications.php">
			<img class="bannericons" src="images/bell.png">Notifications</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="nessages.php">
			<img class="bannericons" src="images/messages.png">Messages</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contactUs.php">
			<img class="bannericons" src="images/contactus.png">Contact Us</a>
          </li>
          <li>
		  <a class="navbar-brand" href="#"><img src="images/logo.jpg" class="logo"></a>
		  </li>


        </ul>
		<li class="nav-item dropdown right">
            <a class="nav-link dropdown-toggle" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<?php User::getProfPic($_SESSION["SESS_MEMBER_ID"]); ?>
                        <!--<img class="bannericons" src="images/profilepics/default.jfif">-->
			</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="logout.php">Logout</a>
              <a class="dropdown-item" href="edit_photo.php">Edit Profile Picture</a>

            </div>
          </li>
        <form class="form-inline my-2 my-lg-0" action="search.php" method="get">
          <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
