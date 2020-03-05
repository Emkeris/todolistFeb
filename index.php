<?php 
    @include 'includes/config.php';
    
    if(!isset($_SESSION['loggedInUser'])) {
        header("Location: register.php");
    }
   
    $resultSQL = mysqli_query($con, "SELECT * FROM list") or die(mysqli_errno($con));
    $resultNr = mysqli_num_rows($resultSQL);
    $i = 1;

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

<div class="container">
    
    
    <div class="container mainContainer">
        <h2 class="text-center my-4">Todo List</h2>
    
        <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Task</th>
            <th scope="col">Is it Done?</th>
            <th scope="col">Buttons X and Y</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($resultSQL)) : ?>
                <tr>
                    <th scope="row"><?php echo $i ?></th>
                    <td><?php echo $row['task'] ?></td>
                    <td><?php echo $row['isDone'] ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id']?>" class="btn btn-primary">Edit</a>
                        <a href="includes/handlers/process.inc.php?delete=<?php echo $row['id']?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endwhile;?>
        </tbody>
    </table>
    </div>
    
    <div class="crudContainer my-5">
        <h2 class="text-center my-4">Add new TODO</h2>
    
        <form method="POST" action="includes/handlers/process.inc.php">
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" name="task" id="task" placeholder="New Todo">
                </div>
                <div class="col">
                    <select id="isDone" class="form-control" name="isDone" placeholder="Is it Done?">
                        <option selected>Yes</option>
                        <option>No</option>
                    </select>
                </div>
                <button class="btn btn-primary" name="addTodoBtn">Add</button>
            </div>
        </form>
    
    
    </div>
</div>

    
</body>
</html>