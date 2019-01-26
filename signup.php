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

    <title>Signup - Bitter</title>

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
  <script>
        var $ = function(id){return document.getElementById(id);};
      
        var validate = function(){
            if (!isPhoneNum()){
                alert("Please enter a valid phone number");
                return false;
            }
            if (!isPostal()){
                alert("Please enter a valid postal code");
                return false;
            }
            if (!isPassMatch()){
                alert("Your password doesn't match the confirmation password");
                return false;
            }
            return true;
        };
        var isPhoneNum = function() {
            var text = $("phone").value;
            var pattern = /^\D*([2-9]\d{2})(\D*)([2-9]\d{2})(\D*)(\d{4})\D*$/;
            return pattern.test(text);
        };
        var isPostal = function(){
            var text = $("postalCode").value;
            var pattern = /^[ABCEGHJKLMNPRSTVXY][0-9][ABCEGHJKLMNPRSTVWXYZ] ?[0-9][ABCEGHJKLMNPRSTVWXYZ][0-9]$/;
            return pattern.test(text);
        };
        var isPassMatch = function(){
            if($("password").value === $("confirm").value){
                return true;
            }
            else{
                return false;
            }
        };       
  </script>
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
				<h5>Sign up once and troll as many people as you like!</h5>
                                <form onsubmit="return validate();" id="registration_form" action="signup_proc.php"  method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">First Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" required name="firstname" id="firstname" maxlength="50" placeholder="Enter your First Name"/>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Last Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" required name="lastname" id="lastname" maxlength="50" placeholder="Enter your Last Name"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Your Email</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="email" class="form-control" required name="email" id="email" maxlength="100" placeholder="Enter your Email"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="username" class="cols-sm-2 control-label">Screen Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" required name="username" id="username" maxlength="50" placeholder="Enter your Screen Name"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="password" class="form-control" required name="password" id="password" maxlength="250" placeholder="Enter your Password"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="password" class="form-control" required name="confirm" id="confirm" maxlength="250" placeholder="Confirm your Password"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Phone Number</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" required name="phone" id="phone"  placeholder="Enter your Phone Number"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Address</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" required name="address" id="address" maxlength="200" placeholder="Enter your Address"/>
								</div>
							</div>
						</div>
						
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Province</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<select name="province" id="province" class="textfield1" required><?php echo $vprovince; ?> 
										<option> </option>
										<option value="BC">British Columbia</option>
										<option value="AB">Alberta</option>
										<option value="SK">Saskatchewan</option>
										<option value="MB">Manitoba</option>
										<option value="ON">Ontario</option>
										<option value="QC">Quebec</option>
										<option value="NB">New Brunswick</option>
										<option value="PE">Prince Edward Island</option>
										<option value="NS">Nova Scotia</option>
										<option value="NF">Newfoundland and Labrador</option>
										<option value="NT">Northwest Territories</option>
										<option value="NU">Nunavut</option>
										<option value="YT">Yukon</option>
									  </select>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Postal Code</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" required name="postalCode" id="postalCode"  placeholder="Enter your Postal Code"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Url</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" name="url" id="url" maxlength="50" placeholder="Enter your URL"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Description</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" required name="desc" id="desc" maxlength="160" placeholder="Description of your profile"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Location</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" name="location" id="location" maxlength="50" placeholder="Enter your Location"/>
								</div>
							</div>
						</div>
						
						
						<div class="form-group ">
							<input type="submit" name="button" id="button" value="Register" class="btn btn-primary btn-lg btn-block login-button"/>
							
						</div>
						
					</form>
				</div>
			
		</div> <!-- end row -->
    </div><!-- /.container -->
  </body>
</html>