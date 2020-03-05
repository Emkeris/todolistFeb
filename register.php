<?php 
    @include 'includes/config.php';
    @include 'includes/classes/Account.php';
    @include 'includes/classes/Constants.php';

    $account = new Account($con);

    @include 'includes/handlers/register.inc.php';
    @include 'includes/handlers/login.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo list feb</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

<div class="container mainContainer" style="width: 400px">
<!-- login Container -->
    <div class="loginContainer">
        <h2 class="text-center my-4">Log In</h2>

        <form method="POST" action="register.php">
            <div class="form-group">
                <?php echo $account->getError(Constants::$usernameOrPasswordWrong) ?>
                <br>
                <label for="usernameLogin">Username</label>
                <input type="text" class="form-control" id="usernameLogin" name="usernameLogin" required>
            </div>
            <div class="form-group">
                <label for="passwordLogin">Password</label>
                <input type="password" class="form-control" id="passwordLogin" name="passwordLogin" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block" name="loginBtn">Log In</button>
        </form>
    </div>
<!-- Register Container -->
    <div class="registerContainer">
        <h2 class="text-center my-4">Register</h2>
        <form method="POST" action="register.php">
            <div class="form-group">
                <?php echo $account->getError(Constants::$usernameShortLong) ?>
                <?php echo $account->getError(Constants::$usernameIsTaken) ?>
                <br>
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <?php echo $account->getError(Constants::$firstNameShortLong) ?>
                <br>
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" required>
            </div>
            <div class="form-group">
                <?php echo $account->getError(Constants::$lastNameShortLong) ?>
                <br>
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" required>
            </div>
            <div class="form-group">
                <?php echo $account->getError(Constants::$emailsNotMatch) ?>
                <?php echo $account->getError(Constants::$emailInvalid) ?>
                <?php echo $account->getError(Constants::$emailIsTaken) ?>
                <br>
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="email2">E-mail Conformance</label>
                <input type="email2" class="form-control" id="email2" name="email2" required>
            </div>
            <div class="form-group">
                <?php echo $account->getError(Constants::$passwordNotMatch); ?>
                <?php echo $account->getError(Constants::$passwordShortLong); ?>
                <?php echo $account->getError(Constants::$passwordAlphanumeric); ?>
                <br>
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password2">Password Conformance</label>
                <input type="password" class="form-control" id="password2" name="password2" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block" name="registerBtn">Register</button>
        </form>
    </div>

</div>

    
</body>
</html>