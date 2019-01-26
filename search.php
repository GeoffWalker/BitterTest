<!DOCTYPE html>
<?php 
    session_start();
    include('includes/Header.php');
    include('includes/Functions.php');
?>

<?php
if (!isset($_SESSION["SESS_MEMBER_ID"])) {
	// Check if the session variable has already been registered
	$msg = "You need to log in before you troll!";
	header("location:login.php?msg=$msg");
}
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
            <h4>Users Found</h4><hr width="100%"><br>
            <div class="col-md-6">  
                <?php
                    User::SearchUser($_GET["search"]);
                ?>
            </div>
        </div>
        
        <div class="row">
            <h4>Tweets Found</h4><hr width="100%"><br>
            <div class="col-md-6">    
                <?php
                    Tweet::SearchTweets($_GET["search"]);
                ?>
            </div>
        </div> <!-- end row -->
    </div><!-- /.container -->
    
  </body>
</html>