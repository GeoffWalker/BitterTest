<!DOCTYPE html>
<?php
if (isset($_GET["msg"])){
    echo "<script>alert('" . $_GET["msg"] . "')</script>";
}
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="SignUp for bitter and begin your trolling journey">
    <meta name="author" content="GeoffWalker: geoff-walker@hotmail.com">
    <link rel="icon" href="favicon.ico">

    <title>Reply - Bitter</title>

    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="includes/starter-template.css" rel="stylesheet">
	<!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	
    <script src="includes/bootstrap.min.js"></script>
    
  </head>
  <body>
    <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <a class="navbar-brand" href="index.php"><img src="images/logo.jpg" class="logo"></a>
        </div>
    </nav>
    
    <BR><BR>
    
    <div class="container">
        <div class="row">
            <div class="main-login main-center">
                    <h5>Reply to the Tweet, Troll the Troll!</h5>
                    <?php echo '<form method="post" id="reply" action="Reply_proc.php?tweet_id='. $_GET["tweet_id"] .'">'; ?>
                        <div class="form-group">
                                <textarea required class="form-control" name="myReply" id="myReply" rows="1" maxlength="280"></textarea>
                                <input type="submit" name="button" id="button" value="Reply" class="btn btn-primary btn-lg btn-block login-button"/>
                        </div>                        
                    </form>
            </div>
        </div> <!-- end row -->
    </div><!-- /.container -->
  </body>
</html>

<?php

    

?>
