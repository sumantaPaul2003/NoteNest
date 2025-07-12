<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("dbConnect.php");
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "select * from notenestusers where username='$username'";
    $result = mysqli_query($con, $sql);
    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $encryptedPassword = $row['password'];

        //Key and Initialization Vector (IV)
        $key = "your-secret-key"; // 16/24/32 characters for AES-128/192/256
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        // Decryption function
        function decryptData($encryptedData, $key)
        {
            list($encryptedText, $iv) = explode("::", base64_decode($encryptedData), 2);
            return openssl_decrypt($encryptedText, 'aes-256-cbc', $key, 0, $iv);
        }
        $decryptedPassword = decryptData($encryptedPassword, $key);

        if ($password == $decryptedPassword) {
            session_start();
            $_SESSION["username"] = $username;
            $_SESSION["loggedin"] = true;
            header("location: viewNotes.php");
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='alerts'>
                <strong>Success!!</strong> You have logged in successfully....
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        } else {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert' id='alerts'>
                <strong>Wrong password !!</strong> please try again...
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
    } else {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert' id='alerts'>
                <strong>No such User found !!</strong> please Sign-Up first...
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }

}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
    <title>Login | NoteNest</title>
</head>

<body>

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
                    <a href='signUp.php' class='btn btn-outline-light btn-sm me-2'><i class='fas fa-user-plus'></i> SignUp</a>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="container login-container">
        <h1 class="login-header"><i class="fas fa-sign-in-alt"></i> Login</h1>
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your Username"
                    required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password"
                    placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-login w-100">Login</button>
        </form>
        <p class="signup-link">Don't have an account? <a href="signup.php">Sign up here</a></p>
    </div>

    <!-- Script for alert removal-------------------------------------- -->
    <script>
        setTimeout(() => {
            const alert = document.getElementById('alerts');
            if (alert) {
                alert.classList.remove('show');
                setTimeout(() => alert.remove(), 150);
            }
        }, 2000);
    </script>
    <!-- -------------------------------------------------------- -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>