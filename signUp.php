<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("dbConnect.php");
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    // Key and Initialization Vector (IV)
    $key = "your-secret-key"; // 16/24/32 characters for AES-128/192/256
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    // Encryption function
    function encryptData($data, $key, $iv)
    {
        return base64_encode(openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv) . "::" . $iv);
    }
    $encryptedPassword = encryptData($password, $key, $iv);
    $userExists = false;
    $emailExists = false;
    $sql = "select * from notenestusers;";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
        if ($row['username'] == $username) {
            $userExists = true;
        }
        if ($row['email'] == $email) {
            $emailExists = true;
        }
    }
    if ($userExists == false and $emailExists == false) {
        $sql = "INSERT INTO `notenestusers` (`username`, `email`, `password`, `date`) 
                VALUES ('$username', '$email', '$encryptedPassword', current_timestamp())";
        $result = mysqli_query($con, $sql);
        $createUserTable = "CREATE TABLE `$username` (
                    `sno` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    `title` varchar(50) NOT NULL,
                    `des` text NOT NULL,
                    `tstamp` datetime NOT NULL DEFAULT current_timestamp()
                    ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci AUTO_INCREMENT=99;";
        $userTableCreated = mysqli_query($con, $createUserTable);
        if ($userTableCreated) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='alerts'>
            <strong>Success!!</strong> Your NoteNest account is create. Now,login and enjoy....
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
        }
    } else if ($userExists) {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert' id='alerts'>
            <strong>A user already exixts by this Username!!</strong> Try another one....
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    } else if ($emailExists) {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert' id='alerts'>
            <strong>An account already exists by this Email !!</strong> Use another Email....
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
    <link rel="stylesheet" href="css/signUp.css">
    <title>Sign-Up | NoteNest</title>
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
                    <a href='login.php' class='btn btn-light btn-sm'><i class='fas fa-sign-in-alt'></i> Login</a>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="container signup-container">
        <h1 class="signup-header"><i class="fas fa-user-plus"></i> Sign Up</h1>
        <form action="signUp.php" method="POST" id="signup">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username"
                    required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email"
                    required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password"
                    placeholder="Enter your password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword"
                    placeholder="Confirm your password" required>
            </div>
            <button type="submit" class="btn btn-signup w-100">Sign Up</button>
        </form>
        <p class="login-link">Already have an account? <a href="login.php">Login here</a></p>
    </div>

    <!-- Script for alert removal-------------------------------------- -->
    <script>
        setTimeout(() => {
            const alert = document.getElementById('alerts');
            if (alert) {
                alert.classList.remove('show');
                setTimeout(() => alert.remove(), 150);
            }
        }, 2500);
    </script>
    <!-- -------------------------------------------------------- -->


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>


    <script>

        // Function to validate email format
        function validateEmail(email) {
            const validEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return validEmail.test(email);
        }

        // Function to validate the signup form
        function validateSignupForm(event) {
            let isValid = true;

            // Getting form input fields
            const username = document.getElementById("username");
            const email = document.getElementById("email");
            const password = document.getElementById("password");
            const cpassword = document.getElementById("cpassword");

            // Reset previous error messages
            const errorMessages = document.querySelectorAll(".error-message");
            errorMessages.forEach(msg => msg.remove());

            // Check for empty spaces in each field
            if (username.value.trim() === "") {
                isValid = false;
                showError(username, "Username should not be empty or contain only spaces.");
            }

            if (email.value.trim() === "") {
                isValid = false;
                showError(email, "Email should not be empty or contain only spaces.");
            } else if (!validateEmail(email.value.trim())) {
                isValid = false;
                showError(email, "Please enter a valid email address.");
            }

            if (password.value.trim() === "") {
                isValid = false;
                showError(password, "Password should not be empty or contain only spaces.");
            } else if (password.value.trim().length < 8) {
                isValid = false;
                showError(password, "Password must be at least 8 characters long.");
            }

            if (cpassword.value.trim() === "") {
                isValid = false;
                showError(cpassword, "Confirm Password should not be empty or contain only spaces.");
            }

            if (cpassword.value.trim() !== password.value.trim()) {
                isValid = false;
                showError(cpassword, "Confirmed Password isn't matching with initial password.");
            }

            // Prevent form submission if validation fails
            if (!isValid) {
                event.preventDefault();
            }
        }

        // Function to show error messages under the input field
        function showError(inputElement, message) {
            const errorElement = document.createElement("div");
            errorElement.classList.add("error-message");
            errorElement.style.color = "red";
            errorElement.textContent = message;
            inputElement.parentElement.appendChild(errorElement);
        }

        // Add event listener to form submission
        document.getElementById("signup").addEventListener("submit", validateSignupForm);
    </script>

</body>

</html>