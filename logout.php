<?php
    session_start();
    session_unset();
    session_destroy();
    // echo"You have loggedOut...";
    header("location: index.php");
?>