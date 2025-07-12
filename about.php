<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/about.css">
    <title>About Us</title>
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
            </div>
        </nav>
    </div>

    <div class="container about-container text-center">
        <h1 class="about-header">About NoteNest</h1>
        <p class="about-text">
            Welcome to <b>NoteNest</b>, your go-to platform for managing your notes effectively and efficiently.
            Whether you're a student, a professional, or someone who loves keeping everything organized, NoteNest
            provides an intuitive and easy-to-use interface for storing, editing, and managing your notes.
        </p>
        <p class="about-text">
            Designed with simplicity and functionality in mind, NoteNest ensures your important information is always
            accessible, helping you stay productive and focused. Our features include:
        </p>
        <ul class="about-text text-start" id="points">
            <li>Adding and saving notes with just a few clicks.</li>
            <li>Editing existing notes directly on the platform.</li>
            <li>Deleting unnecessary notes effortlessly.</li>
            <li>A clean, modern interface for an exceptional user experience.</li>
        </ul>
        <p class="about-text">
            We are committed to making your note-taking experience as seamless as possible. Thank you for choosing
            NoteNest!
        </p>
        <a href="index.php" class="btn-back mt-3">Back to Home</a>
    </div>
</body>

</html>