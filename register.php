<?php
    include("includes/config.php");
    include("includes/classes/Account.php");
    include("includes/classes/Constants.php");
    
    $account = new Account($con);

    include("includes/handlers/register-handler.php");
    include("includes/handlers/login-handler.php");

    function getInputValue($name) {
        if(isset($_POST[$name])) {
            echo $_POST[$name];
        }
    }
    
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Welcome to Geckofy!</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="assets/css/register.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>
    <!--[if lt IE 7]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

        <?php

    if(isset($_POST['registerButton'])) {
        echo '<script>
                $(document).ready(function() {
                    $("#loginForm").hide();
                    $("#registerForm").show();
                });
            </script>';
    }
    else {
        echo '<script>
                $(document).ready(function() {
                    $("#loginForm").show();
                    $("#registerForm").hide();
                });
            </script>';
    }

    ?>

    <div id="background">

        <div id="loginContainer">

            <div id="inputContainer">

                <!--- Login -->

                <form id="loginForm" action="register.php" method="POST">
                    <h2>Login to your account</h2>
                    <p>
                    <?php echo $account->getError(Constants::$loginFailed); ?>
                        <label for="loginUsername">Username:</label>
                        <input id="loginUsername" name="loginUsername" type="text" placeholder="e.g. Kaneki" required>
                    </p>

                    <p>
                        <label for="loginPassword">Password:</label>
                        <input id="loginPassword" name="loginPassword" type="password" placeholder="Your Password" required>
                    </p>

                    <button type="submit" name="loginButton">LOG IN</button>

                    <div class="hasAccountText">
						<span id="hideLogin">Don't have an Geckofy account yet? Signup here.</span>
					</div>

                </form>

                <!-- Registration --> 

                <form id="registerForm" action="register.php" method="POST">
                    <h2>Create your free Slotify account</h2>
                    <p>
                        <?php echo $account->getError(Constants::$usernameCharacters); ?>
                        <?php echo $account->getError(Constants::$usernameTaken); ?>
                        <label for="username">Username:</label>
                        <input id="username" name="username" type="text" placeholder="e.g. Kaneki" value="<?php getInputValue('username') ?>" required>
                    </p>

                    <p>
                        <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                        <label for="firstName">First Name:</label>
                        <input id="firstName" name="firstName" type="text" placeholder="e.g. Ken" value="<?php getInputValue('firstName') ?>" required>
                    </p>

                    <p>
                        <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                        <label for="lastName">Last Name:</label>
                        <input id="lastName" name="lastName" type="text" placeholder="e.g. Kaneki" value="<?php getInputValue('lastName') ?>" required>
                    </p>

                    <p>
                        <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
                        <?php echo $account->getError(Constants::$emailInvalid); ?>
                        <?php echo $account->getError(Constants::$emailTaken); ?>
                        <label for="email">Email:</label>
                        <input id="email" name="email" type="email" placeholder="e.g. kaneki@email.com" value="<?php getInputValue('email') ?>" required>
                    </p>

                    <p>
                        <label for="confirmEmail">Confirm Email:</label>
                        <input id="confirmEmail" name="confirmEmail" type="email" placeholder="e.g. kaneki@email.com" value="<?php getInputValue('confirmEmail') ?>" required>
                    </p>

                    <p>
                        <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                        <?php echo $account->getError(Constants::$passwordsNotAlphanumeric); ?>
                        <?php echo $account->getError(Constants::$passwordCharacters); ?>
                        <label for="password">Password:</label>
                        <input id="password" name="password" type="password" placeholder="Your Password" required>
                    </p>

                    <p>
                        <label for="confirmPassword">Confirm Password:</label>
                        <input id="confirmPassword" name="confirmPassword" type="password" placeholder="Your Password" required>
                    </p>

                    <button type="submit" name="registerButton">SIGN UP</button>

                    <div class="hasAccountText">
						<span id="hideRegister">Already have an account? Log in here.</span>
					</div>

                </form>

            </div>

            <div id="loginText">
				<h1>Get great music, right now</h1>
				<h2>Listen to loads of songs for free</h2>
				<ul>
					<li>Discover music you'll fall in love with</li>
					<li>Create your own playlists</li>
					<li>Follow artists to keep up to date</li>
                    <li>Book Airbnb for your fav concert</li>
				</ul>
			</div> 

        </div>
        
    </div>

</body>
</html>