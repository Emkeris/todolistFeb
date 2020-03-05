<?php 
   function sanitizeFormString($input) {
    $input = strip_tags($input);
    $input = str_replace(' ', '', $input);
    $input = ucfirst(strtolower($input));
    return $input;
    }

    function sanitizeFormUsername($input) {
        $input = strip_tags($input);
        $input = str_replace(' ', '', $input);
        return $input;
    }
    
    function sanitizeFormPassword($input) {
        $input = strip_tags($input);
        return $input;
    }

    // Register Btn pressed
    if(isset($_POST["registerBtn"])) {
        $userName = sanitizeFormUsername($_POST["username"]);
        $firstName = sanitizeFormString($_POST["firstName"]);
        $lastName = sanitizeFormString($_POST["lastName"]);
        $email = sanitizeFormString($_POST["email"]);
        $email2 = sanitizeFormString($_POST["email2"]);
        $password = sanitizeFormPassword($_POST["password"]);
        $password2 = sanitizeFormPassword($_POST["password2"]);
        
        $wasSuccess = $account->register($userName, $firstName, $lastName, $email, $email2, $password, $password2);

        if($wasSuccess) {
            $_SESSION['loggedInUser'] = $userName;
            header("Location: index.php");
        }
    }

?>