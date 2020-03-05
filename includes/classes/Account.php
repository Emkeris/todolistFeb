<?php 
    class Account {

        private $con;
        private $errorArray;

        public function __construct($con) {
            $this->errorArray = array();
            $this->con = $con;
        }

        // LOGIN SIDE!!
        public function logIn($un, $pw) {
            $pw = md5($pw);
            $this->loginCheck($un, $pw);

            if(!empty($this->errorArray)) {
                return false;
            } else {
                return true;
            }
        }

        private function loginCheck($input, $input2){ 
            $loginResult = mysqli_query($this->con, "SELECT * FROM users WHERE userName = '$input' AND password = '$input2'") or die(mysqli_error($this->con));
            if(mysqli_num_rows($loginResult) != 1) {
                array_push($this->errorArray, Constants::$usernameOrPasswordWrong);
                return;
            } 
        }


        // REGISTER SIDE
        public function register($un, $fn, $ln, $em, $em2, $pw, $pw2) {
            $this->validateUsername($un);
            $this->validateFirstName($fn);
            $this->validateLastName($ln);
            $this->validateEmails($em, $em2);
            $this->validatePasswords($pw, $pw2);

            if(!empty($this->errorArray)) {
                return false;
            } else {
                $date = date("Y-m-d");
                $pw = md5($pw);

                // INSERTING DATA TO DB
                mysqli_query($this->con, "INSERT INTO users (userName, firstName, lastName, email, password, dateCreated) VALUES ('$un', '$fn', '$ln', '$em', '$pw', '$date')") or die(mysqli_error($this->con));
                return true;
            }
        }

        public function getError($error) {
            if(!in_array($error, $this->errorArray)) {
                $error = "";
            } 
            return "<span>$error</span>";
        }

        private function validateUsername($input) {
            if(strlen($input) < 5 || strlen($input) > 25) {
                array_push($this->errorArray, Constants::$usernameShortLong);
                return;
            }

            //check if username is not in use!
            $usernameSQL = mysqli_query($this->con, "SELECT * FROM users WHERE username = '$input'") or die(mysqli_error($this->con));
            if(mysqli_num_rows($usernameSQL) == 1) {
                array_push($this->errorArray, Constants::$usernameIsTaken);
                return;
            }
        }
        private function validateFirstName($input) {
            if(strlen($input) < 3 || strlen($input) > 25) {
                array_push($this->errorArray, Constants::$firstNameShortLong);
                return;
            }
        }
        private function validateLastName($input) {
            if(strlen($input) < 3 || strlen($input) > 25) {
                array_push($this->errorArray, Constants::$lastNameShortLong);
                return;
            }
        }
        private function validateEmails($input, $input2) {
            if($input != $input2) {
                array_push($this->errorArray, Constants::$emailsNotMatch);
                return;
            }

            if(!filter_var($input, FILTER_VALIDATE_EMAIL)) {
                array_push($this->errorArray, Constants::$emailInvalid);
                return;
            }

            //check  if email is not taken!
            $emailSQL = mysqli_query($this->con, "SELECT * FROM users WHERE email = '$input'") or die(mysqli_error($this->con));
            if(mysqli_num_rows($emailSQL) == 1) {
                array_push($this->errorArray, Constants::$emailIsTaken);
            }
        }
        private function validatePasswords($input, $input2) {
            if($input != $input2) {
                array_push($this->errorArray, Constants::$passwordNotMatch);
                return;
            }

            if(!preg_match("/^[a-z0-9.]+$/i", $input)) {
                array_push($this->errorArray, Constants::$passwordAlphanumeric);
                return;
            }

            if(strlen($input) < 5 || strlen($input) > 25) {
                array_push($this->errorArray, Constants::$passwordShortLong);
                return;
            }
        }


    }
?>