<?php
include '../../db/db_conn.php';
if (isset($_POST["submit"])) {
    $menu_name = $_POST['menu_name'];

    $sql = "INSERT INTO `menus` (`ID`, `Name`, `DateCreated`, `DateUpdated`, `DateDeleted`) VALUES (NULL, '$menu_name', current_timestamp(), current_timestamp(), '')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: index.php?msg=New menu created successfully");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="text-start mt-3 p-3 bg-success text-white">The Sandwich Club</h1>
            <div class="btn-group gx-2 mt-3 p-3" role="group" aria-label="Basic example">
                <a href="index.php"> <button type="button btn-secondary" class="btn">Return</button></a>
            </div>
        </div>
        <div class="container">
            <div class="text-center mb-4">
                <h3>Add New Menu</h3>
                <p class="text-muted">Ready to spice things up? Add a new menu to the club!</p>
            </div>

            <div class="container d-flex justify-content-center">
                <form action="" method="post" style="width:50vw; min-width:300px;">
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Menu Name:</label>
                            <input type="text" class="form-control" name="menu_name" placeholder='The "Good Sandwiches"' required>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success" name="submit">Save</button>
                        <a href="index.php" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
</body>

</html>