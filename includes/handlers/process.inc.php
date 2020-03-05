<?php 
    @include '../config.php';

    $doneBy = $_SESSION['loggedInUser'];

    function sanitizeFormTask($input) {
        $input = strip_tags($input);
        $input = ucfirst(strtolower($input));
        return $input;
    }

    if(isset($_POST['addTodoBtn'])) {
        // add todo btn was pressed;
        $task = sanitizeFormTask($_POST['task']);
        $isDone = $_POST['isDone'];

        mysqli_query($con, "INSERT INTO list (task, isDone, doneBy) VALUES ('$task', '$isDone', '$doneBy')") or die(mysqli_error($con));
        header("Location: ../../index.php");
    }

?>
