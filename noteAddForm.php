<?php session_start();
include("dbConnect.php");
?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css"
    integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">
  <link rel="stylesheet" href="css/noteAddForm.css">
  <!-- for logos -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <title>notes</title>
</head>

<body>


<div>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a href="index.php" class="navbar-brand" style="font-weight: bold;"><i class="fas fa-sticky-note"></i>
                    NoteNest</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="viewNotes.php">Notes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contactUs.php">Contact us</a>
                        </li>
                    </ul>
                </div>
                <div class="d-flex ms-auto align-items-center">
                    <?php
                    session_start();
                    if (isset($_SESSION['username'])) {
                        echo "
                    <div class='d-flex align-items-center text-light me-3'>
                        <i class='fas fa-user-circle me-2'></i> 
                        <span>" . htmlspecialchars($_SESSION['username']) . "</span>
                    </div>
                    <a href='logout.php' class='btn btn-sm btn-light text-success ms-3' style='border-radius: 4px;' 
                    onclick='return confirm(\"Are you sure you want to log out?\");'>
                    <i class='fas fa-sign-out-alt'></i> Logout
                    </a>";
                    } else {
                        echo "
                    <a href='signUp.php' class='btn btn-outline-light btn-sm me-2'><i class='fas fa-user-plus'></i> SignUp</a>
                    <a href='login.php' class='btn btn-light btn-sm'><i class='fas fa-sign-in-alt'></i> Login</a>";
                    }
                    ?>
                </div>
            </div>
        </nav>
    </div>

  <div id="alertContainer" class="my-3"></div>

  <div>
    <div class="container my-5">
      <h2>Add a Note</h2>
      <form id="addNoteForm">
        <!-- <form action="noteAddForm.php" method="post" id="addNote"> -->
        <div class="mb-3 my-3">
          <label for="title" class="form-label"><strong>Note Title</strong></label>
          <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="mb-3">
          <label for="description" class="form-label"><strong>Note Description</strong></label>
          <textarea class="form-control" placeholder="Write note description" id="desc" name="desc"></textarea>
        </div>
        <div class="d-flex justify-content-between">
          <button type="submit" class="btn btn-primary">Add note</button>
          <button type="button" onclick="window.location.href='viewNotes.php'" class="btn btn-secondary">View
            Notes</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script>
    $("#addNoteForm").on("submit", function (e) {
      e.preventDefault();
      const formData = $(this).serialize();

      $.ajax({
        url: "addNote.php",
        type: "POST",
        data: formData,
        success: function (response) {
          $("#alertContainer").html(response); // Show success or error message
          $("#addNoteForm")[0].reset(); // Reset the form
        },
        error: function () {
          $("#alertContainer").html("<div class='alert alert-danger'>Error adding note.</div>");
        }
      });
    });
  </script>


  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</body>

</html>