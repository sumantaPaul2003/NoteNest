<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Home | NoteNest</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #28a772;">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><i class="fas fa-sticky-note"></i> NoteNest</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="viewNotes.php">Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contactUs.php">Contact Us</a>
                    </li>
                </ul>
                <div class="d-flex ms-auto">
                    <?php
                    session_start();
                    if (isset($_SESSION['username'])) {
                        echo "
                    <div class='d-flex align-items-center text-light me-3'>
                        <i class='fas fa-user-circle me-2'></i>
                        <span>" . htmlspecialchars($_SESSION['username']) . "</span>
                    </div>
                    <a href='logout.php' class='btn btn-sm btn-light text-success ms-auto' style='border-radius: 4px;' 
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
        </div>
    </nav>


    <!-- Hero Section -->
    <div class="container">
        <div class="hero">
            <h1>Welcome to NoteNest</h1>
            <p>Organize your thoughts, manage your notes, and boost your productivity.</p>
            <a href="viewNotes.php" class="btn btn-primary btn-lg">Get Started</a>
        </div>

        <!-- Features Section -->
        <div class="row features text-center mt-5">
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="fas fa-plus-circle fa-3x text-success mb-3"></i>
                    <h5>Create Notes</h5>
                    <p>Quickly add new notes to stay organized and productive.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="fas fa-edit fa-3x text-success mb-3"></i>
                    <h5>Edit Notes</h5>
                    <p>Update or modify your notes easily with our intuitive interface.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="fas fa-trash-alt fa-3x text-success mb-3"></i>
                    <h5>Delete Notes</h5>
                    <p>Remove unnecessary notes with just one click.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center mt-5 py-4" style="background-color: #28a772; color: #fff;">
        <p>&copy; 2024 NoteNest. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>