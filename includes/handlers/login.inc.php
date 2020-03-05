<?php 
    if(isset($_POST["loginBtn"])) {
        // login Btn pressed
        $userName = $_POST["usernameLogin"];
        $password = $_POST["passwordLogin"];

        $successLogin = $account->logIn($userName, $password);
        
        if($successLogin){
            $_SESSION['loggedInUser'] = $userName;
            header("Location: index.php");
        } 
    }
    



?>