<?php
include("dbConnect.php");
session_start();
$table=$_SESSION["username"];

if (empty($_POST["titleEdit"])) {
    $error = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Warning!!</strong> Note title is empty..
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    echo $error;
} else {
    // Sanitize inputs
    $title = mysqli_real_escape_string($con, $_POST["titleEdit"]);
    $desc = mysqli_real_escape_string($con, $_POST["descEdit"]);
    $id = mysqli_real_escape_string($con, $_POST["snoEdit"]);
    // Insert query
    $sql = "UPDATE `$table` SET `title` = '$title', `des` = '$desc' , `tstamp`= current_timestamp() WHERE `sno` = $id";
    $result = mysqli_query($con, $sql);

    // Check for success
    if ($result) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
              <strong>Success!!!</strong> Your Note has beeen updated sucessfully.
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    } else {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
              <strong>Error!!!</strong> Note cannot be inserted!!.
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }
}
?>