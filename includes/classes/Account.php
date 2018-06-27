<?php 
    class Account {
        private $con;
        private $errorArray;

        public function __construct($con) {
            //this is called as soon as the variable for this class is created
            $this->con = $con;
            $this->errorArray = array();
        }

        public function login($un, $pw) {
            //Encrypt password first
            $pw = md5($pw);
            

            $query = mysqli_query($this->con, "SELECT * FROM users WHERE username='$un' AND password='$pw'");

            if(mysqli_num_rows($query) == 1) {
                return true;
            } else {
                array_push($this->errorArray, Constants::$loginFailed);
                return false;
            }
        }

        public function register($un, $fn, $ln, $em, $em2, $pw, $pw2) {
            //Check to see if the variables are valid forms
            $this->validateUsername($un);
            $this->validateFirstName($fn);
            $this->validateLastName($ln);
            $this->validateEmails($em, $em2);
            $this->validatePasswords($pw, $pw2);

            if(empty($this->errorArray)) {
                //insert into db if no errors
                return $this->insertUserDetails($un, $fn, $ln, $em, $pw);

            } else {
                return false;
            }

        }

        public function getError($error) {
            //check the error array to see if msg exists

            if(!in_array($error, $this->errorArray)) {
                $error = "";
            }
            return "<span class='errorMessage'>$error</span>";
        }
        // These functions are private because they can only be called from within this class 

        private function insertUserDetails($un, $fn, $ln, $em, $pw) {
            // Takes the password and encrypts it using md5
            $encryptedPw = md5($pw); 
            $profilePic = "assets/images/profile-pics/yoda-image.jpg"; //126 by 126
            
            $date = date("Y-m-d");
            
            $result = mysqli_query($this->con, "INSERT INTO users VALUES ('', '$un', '$fn', '$ln', '$em', '$encryptedPw', '$date', '$profilePic')");

            return $result;
        }

        private function validateUsername($un) {
            
            if(strlen($un) > 25 || strlen($un) < 5) {
                array_push($this->errorArray, Constants::$usernameCharacters);
                return;
            }

            //TODO: check if username exists in username table
            $checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username='$un'");
            if(mysqli_num_rows($checkUsernameQuery) != 0) {
                arry_push($this->errorArray, Constants::$usernameTaken);
                return;
            }
        }
        
        private function validateFirstName($fn) {

            if(strlen($fn) > 25 || strlen($fn) < 2) {
                array_push($this->errorArray, Constants::$firstNameCharacters);
                return;
            }
        }
        
        private function validateLastName($ln) {

            if(strlen($ln) > 25 || strlen($ln) < 2) {
                array_push($this->errorArray, Constants::$lastNameCharacters);
                return;
            }
            
        }
        
        private function validateEmails($em, $em2) {
            if($em != $em2) {
                array_push($this->errarArray, Constants::$emailsDoNotMatch);
                return;
            }

            if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
                //checks whether email is in the correct format

                array_push($this->errorArray, Constants::$emailInvalid);
                return;
            }

            //TODO: Check that email hasn't already been used.
            $checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email='$em'");
            if(mysqli_num_rows($checkEmailQuery) != 0) {
                arry_push($this->errorArray, Constants::$emailTaken);
                return;
            }

        }
        
        private function validatePasswords($pw, $pw2) {

            if($pw != $pw2) {
                array_push($this->errorArray, Constants::$passwordsDoNotMatch);
                return;

            }

            if(preg_match('/[^A-Za-z0-9]/',$pw)) {
                array_push($this->errorArray, Constants::$passwordsNotAlphanumeric);
                return;

            }

            if(strlen($pw) > 30 || strlen($pw) < 7) {
                array_push($this->errorArray, Constants::$passwordCharacters);
                return;
            }
            
            //TODO: Check if password has already been used.
        }

    }
    
    
?>