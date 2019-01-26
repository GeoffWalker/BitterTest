<?php
session_start();
if (isset($_GET["msg"])){
    echo "<script>alert('" . $_GET["msg"] . "')</script>";
}

if (!isset($_SESSION["SESS_MEMBER_ID"])) {
	// Check if the session variable has already been registered
	$msg = "You need to log in before you troll!";
	header("location:login.php?msg=$msg");
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="DESC MISSING">
    <meta name="author" content="Nick Taggart, nick.taggart@nbcc.ca">
    <link rel="icon" href="favicon.ico">

    <title>Bitter - Social Media for Trolls, Narcissists, Bullies and Presidents</title>

    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="includes/starter-template.css" rel="stylesheet">
	<!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-1.10.2.js" ></script>

	<script>
	//just a little jquery to make the textbox appear/disappear like the real Twitter website does
	$(document).ready(function() {
		//hide the submit button on page load
		$("#button").hide();
		$("#tweet_form").submit(function() {

			$("#button").hide();
		});
		$("#myTweet").click( function() {
			this.attributes["rows"].nodeValue = 5;
			$("#button").show();

		});//end of click event
		$("#myTweet").blur( function() {
			//this.attributes["rows"].nodeValue = 1;
                        //$("#button").hide();

		});//end of click event
	});//end of ready event handler

	</script>
  </head>
  <body>

<?php
    include('includes/header.php');
    include('includes/functions.php');
?>

	<BR><BR>
    <div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="mainprofile img-rounded">
                                    <div class="bold">
                                    <?php
                                    user::getProfPic($_SESSION["SESS_MEMBER_ID"]);
                                    echo '<a href="userpage.php?user_id=' . $_SESSION["SESS_MEMBER_ID"] . '">' . $_SESSION["SESS_FIRST_NAME"] . ' ' . $_SESSION["SESS_LAST_NAME"] . '</a><BR></div>';
                                    ?>
				<table>
				<tr><td>
				tweets</td><td>following</td><td>followers</td></tr>
				<?php echo '<tr><td>' . user::getTweetCount($_SESSION["SESS_MEMBER_ID"]) . '</td><td>' . user::getFollowerCount($_SESSION["SESS_MEMBER_ID"]) . '</td><td>' . user::getFollowCount($_SESSION["SESS_MEMBER_ID"]) . '</td>'; ?>
				</tr></table><BR><BR><BR><BR><BR>
				</div><BR><BR>
				<div class="trending img-rounded">
				<div class="bold">Trending</div>
				</div>

			</div>
			<div class="col-md-6">
				<div class="img-rounded">
					<form method="post" id="tweet_form" action="tweet_proc.php">
					<div class="form-group">
						<textarea class="form-control" name="myTweet" id="myTweet" rows="1" placeholder="What are you bitter about today?"></textarea>
						<input type="submit" name="button" id="button" value="Send" class="btn btn-primary btn-lg btn-block login-button"/>
					</div>
					</form>
				</div>
				<div class="img-rounded">
				<!--display list of tweets here-->
                                <?php
                                    tweet::getTweets();
                                ?>
				</div>
			</div>
			<div class="col-md-3">
				<div class="whoToTroll img-rounded">
				<div class="bold">Who to Troll?<BR></div>
				<!-- display people you may know here-->
				<?php
                                    whoToTroll($con);
                                ?>
				</div><BR>
				<!--don't need this div for now
				<div class="trending img-rounded">
				© 2018 Bitter
				</div>-->
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
