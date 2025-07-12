<?php
include("dbConnect.php");
session_start();
$table=$_SESSION["username"];

if (isset($_POST["delete"])) {
    $sno = mysqli_real_escape_string($con, $_POST["delete"]);

    $sql = "DELETE FROM `$table` WHERE `sno` = $sno";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "success";
    } else {
        http_response_code(500); // Send error code for AJAX
        echo "Error: " . mysqli_error($con);
    }
} else {
    http_response_code(400); // Invalid request
    echo "Invalid request";
}
?>


<?php
// include("dbConnect.php");
//     $sno= $_GET["delete"];
//     // Insert query
//     $sql = "DELETE FROM `$table` WHERE .`sno` = $sno";
//     $result = mysqli_query($con, $sql);

//     // Check for success
//     if ($result) {
//         echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
//               <strong>Success!!!</strong> Your Note has beeen deleted sucessfully.
//               <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
//             </div>";
//     } else {
//         echo "Error: " . mysqli_error($con);
//     }
?>


