<?php 
    session_start();

    $con = new mysqli("localhost", "root", "", "todolistfeb") or die(mysqli_error($con));
?>