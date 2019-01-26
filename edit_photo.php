<?php
//this page will allow the user to edit their profile photo
session_start();

if (isset($_GET["msg"])){
    echo "<script>alert('" . $_GET["msg"] . "')</script>";
}

include("includes/header.php");
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Contact Bitter for all your trolling needs">
    <meta name="author" content="GeoffWalker: geoff-walker@hotmail.com">
    <link rel="icon" href="favicon.ico">

    <title>Contact Us - Bitter</title>

    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="includes/starter-template.css" rel="stylesheet">
	<!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>

    <script src="includes/bootstrap.min.js"></script>

	<script type="text/javascript">
		//any JS validation you write can go here
	</script>
  </head>

  <body>

	<BR><BR>
    <div class="container">
		<div class="row">

			<div class="main-login main-center">
                            <form action="edit_photo_proc.php" method="post" enctype="multipart/form-data">
                                Select your image:
                                <input type="file" name="pic" accept="image/*" required>
                                <input id="button" type="submit" value="submit">
                            </form>
			</div>
		</div> <!-- end row -->
    </div><!-- /.container -->
  </body>
</html>
