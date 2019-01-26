<?php
//displays all the details for a particular Bitter user
session_start();
include('includes/Functions.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Bitter - Social Media for Trolls, Narcissists, Bullies and Presidents</title>

    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="includes/starter-template.css" rel="stylesheet">
	<!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-1.10.2.js" ></script>
	
	
  </head>

  <body>
	<?php include('includes/Header.php'); ?>
	<BR><BR>
    <div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="mainprofile img-rounded">
				<div class="bold">
				<?php 
                                User::getProfPic($_GET["user_id"]);
                                echo User::getUserInfo($_GET["user_id"])["first_name"] . ' ' . User::getUserInfo($_GET["user_id"])["last_name"]; 
                                ?>
                                <BR></div>
				<table>
				<tr><td>tweets</td><td>following</td><td>followers</td></tr>
				<?php echo '<tr><td>' . User::getTweetCount($_GET["user_id"]) . '</td><td>' . User::getFollowerCount($_GET["user_id"]) . '</td><td>' . User::getFollowCount($_GET["user_id"]) . '</td>'; ?>
				</tr></table>
                                    <img class="icon" src="images/location_icon.jpg"><?php echo User::getProvince($_GET["user_id"]); ?>
				<div class="bold">Member Since:</div>
				<div>
                                    <?php  
                                        $date = date_create(User::getUserInfo($_GET["user_id"])["date_created"]);
                                        echo date_format($date, "M dS, Y");
                                    ?>
                                </div>
				</div><BR><BR>
				
				<div class="trending img-rounded" style="padding: 5px">
                                    <div class="bold">
                                        <?php echo User::followersYouKnowCount($_GET["user_id"]); ?> &nbsp;Follower(s) you know<BR>
                                    </div>
                                    <div class="bold">
                                        <?php User::followersYouKnow($_GET["user_id"]); ?>
                                    </div>
				</div>
				
			</div>
			<div class="col-md-6">
                            <div class="img-rounded">
                                <?php Tweet::tweetsByUser($_GET["user_id"]); ?>
                            </div>
			</div>
			<div class="col-md-3">
				<div class="whoToTroll img-rounded">
				<div class="bold">Who to Troll?<BR></div>
                                    <?php
                                        whoToTroll($con);
                                    ?>
				</div><BR>
				
			</div>
		</div> <!-- end row -->
    </div><!-- /.container -->

	

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="includes/bootstrap.min.js"></script>
    
  </body>
</html>
