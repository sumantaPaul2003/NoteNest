<?php
include("dbConnect.php");
session_start();
$table = $_SESSION["username"];
?>

<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">

    <link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/viewNotes.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>View Notes</title>
</head>

<body>

    <!-- navbar--------------------------------------------------------------------------------- -->
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
    <!-- ------------------------------------------------------------------------------------------------- -->

    <?php
    session_start();
    if (session_status() !== PHP_SESSION_ACTIVE || !isset($_SESSION['username'])) {
        echo "<div style='display: flex; justify-content: center; align-items: center; height: 100vh; font-family: Arial, sans-serif;'>
            <div style='text-align: center; padding: 20px; border: 2px solid #28a772; border-radius: 10px; background-color: #f9f9f9;'>
                <h2 style='color: #28a772; font-weight: bold;'>You aren't currently logged-in</h2>
                <p style='color: #555;'>Please <a href='login.php' style='color: #28a772;'>login</a> to continue.</p>
            </div>
          </div>";
        exit();
    }
    ?>

    <!-- empty container for alert------------------------->
    <div class="container mt-3">
        <div id="alertBox" class="alert d-none" role="alert"></div>
    </div>
    <!-- ------------------------------------------------ -->


    <!-- Modal ----------------------------------------------------------------------------------------- -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit Note</h1>
                </div>
                <div class="modal-body">
                    <form action="updateNote.php" method="post" id="addNote">
                        <!-- <form action="ViewNotes.php" method="post" id="addNote"> -->
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="mb-3 my-3">
                            <label for="title" class="form-label"><strong>Note Title</strong></label>
                            <input type="text" class="form-control" id="titleEdit" name="titleEdit" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label"><strong>Note Description</strong></label>
                            <textarea class="form-control" placeholder="Write note description" id="descEdit"
                                name="descEdit"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update note</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
    <!-- --------------------------------------------------------------------------------------------------------- -->



    <div class="container" id="yn"><strong>
            <h1><u>Your Notes</u></h1>
        </strong></div>

    <div class="container my-4">
        <button type="button" onclick="window.location.href='noteAddForm.php'" style="background-color: #28a745; color: white; border: none; padding: 10px 20px; font-size: 16px; 
               border-radius: 8px; cursor: pointer; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            Add a note
        </button>
    </div>

    <div class="container">
        <table class="table" id="table" border="4">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Date-Time</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "select * from $table;";
                $result = mysqli_query($con, $sql);
                $i = 1;
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>
                    <td>{$i}</td>
                    <td>{$row['title']}</td>
                    <td>{$row['des']}</td>
                    <td>{$row['tstamp']}</td>
                    <td>
                        <button class='edit btn btn-sm btn-primary' id='{$row['sno']}'><i class='fas fa-edit'></i> Edit</button> 
                        <button class='delete btn btn-sm btn-primary' id='d{$row['sno']}'><i class='fas fa-trash'></i> Delete</button>
                    </td>
                    </tr>";
                    $i++;
                }
                ?>

            </tbody>
        </table>
    </div>

    <div class="container my-4"></div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- ------------------------------------------- -->

    <!-- jquery for dataTable --------------------------------------------------------->
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#table').DataTable();
        });
    </script>
    <!-- ----------------------------------------------------------------------------------- -->

    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit: ",);
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[1].innerText;
                desc = tr.getElementsByTagName("td")[2].innerText;
                console.log(title, desc);
                titleEdit.value = title;
                descEdit.value = desc;
                snoEdit.value = e.target.id;
                console.log(document.getElementById("snoEdit").value);
                $('#editModal').modal('toggle');
            })
        })


        // deletes = document.getElementsByClassName('delete');
        // Array.from(deletes).forEach((element) => {
        //     element.addEventListener("click", (e) => {
        //         console.log("delete: ",);
        //         sno = e.target.id.substr(1,);
        //         if (confirm("Delete this note?")) {
        //             console.log("yes");
        //             window.location = `deleteNote.php?delete=${sno}`;
        //         } else {
        //             console.log("no");
        //         }
        //     })
        // })


        // code for deleting note without redirecting to deleteNote.php--------------------------------

        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("delete: ");
                sno = e.target.id.substr(1,);
                if (confirm("Are you sure you want to delete this note?")) {
                    console.log("yes");
                    // AJAX request to deleteNote.php
                    $.ajax({
                        url: 'deleteNote.php',
                        type: 'POST',
                        data: { delete: sno },
                        success: function (response) {
                            // Display success alert
                            let alertDiv = document.createElement("div");
                            alertDiv.className = "alert alert-success alert-dismissible fade show";
                            alertDiv.role = "alert";
                            alertDiv.id= "alerts";
                            alertDiv.innerHTML = `
                        <strong>Success!!</strong> Note deleted successfully...
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    `;
                            // document.body.insertBefore(alertDiv, document.body.firstChild);

                            // Insert alert after the navbar
                            let navbar = document.querySelector(".navbar");
                            navbar.insertAdjacentElement("afterend", alertDiv);

                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                        },
                        error: function () {
                            // Display error alert
                            let alertDiv = document.createElement("div");
                            alertDiv.className = "alert alert-danger alert-dismissible fade show";
                            alertDiv.role = "alert";
                            alertDiv.id= "alerts";
                            alertDiv.innerHTML = `
                        <strong>Error!</strong> Unable to delete the note. Please try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    `;
                            let navbar = document.querySelector(".navbar");
                            navbar.insertAdjacentElement("afterend", alertDiv);
                        }
                    });
                } else {
                    console.log("no");
                }
            });
        });

        // ---------------------------------------------------------------------------------------------------




        // code for updating note without redirecting to updateNote.php-----------------------------

        document.getElementById("addNote").addEventListener("submit", function (e) {
            e.preventDefault(); // Prevent form redirection

            const formData = new FormData(this);

            fetch("updateNote.php", {
                method: "POST",
                body: formData,
            })
                .then((response) => response.text())
                .then((data) => {
                    // Display success alert
                    let alertDiv = document.createElement("div");
                    alertDiv.className = "alert alert-success alert-dismissible fade show";
                    alertDiv.role = "alert";
                    alertDiv.id= "alerts";
                    alertDiv.innerHTML = `
                <strong>Success!!</strong> Note updated successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;
                    let navbar = document.querySelector(".navbar");
                    navbar.insertAdjacentElement("afterend", alertDiv);
                    // Close modal and reload table
                    $('#editModal').modal('hide');
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                })
                .catch((error) => {
                    // Display error alert
                    let alertDiv = document.createElement("div");
                    alertDiv.className = "alert alert-danger alert-dismissible fade show";
                    alertDiv.role = "alert";
                    alertDiv.id= "alerts";
                    alertDiv.innerHTML = `
                <strong>Error!!</strong> Failed to update the note. Please try again.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;
                    let navbar = document.querySelector(".navbar");
                    navbar.insertAdjacentElement("afterend", alertDiv);
                    console.error("Error:", error);
                });
        });

        // -------------------------------------------------------------------------------------------------------
    </script>
</body>

</html>