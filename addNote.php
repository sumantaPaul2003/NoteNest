<?php
include("dbConnect.php");
session_start();
$table = $_SESSION["username"];
// echo $table;

if (empty($_POST["title"])) {
    $error = "<div class='alert alert-warning alert-dismissible fade show' role='alert' id='alerts'>
            <strong>Warning!!</strong> Please add Note title..
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    echo $error;
} else {
    // Sanitize inputs
    $title = mysqli_real_escape_string($con, $_POST["title"]);
    $desc = mysqli_real_escape_string($con, $_POST["desc"]);

    // Insert query
    $sql = "INSERT INTO `$table` (`title`, `des`, `tstamp`) 
                VALUES ('$title', '$desc', current_timestamp());";
    $result = mysqli_query($con, $sql);

    // Check for success
    if ($result) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='alerts'>
              <strong>Success!!!</strong> Your Note has beeen inserted sucessfully.
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>