<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Homepage</title>

    <link rel="icon" href="images/logo.png" type="image/png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="css/index.css">
</head>

<body>

    <!-- navbar section   -->

    <header class="navbar-section">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <div class="logo-wrapper">
                        <img src="images/logo.png" alt="Student Management System Logo">
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary mx-2" href="login.php?role=student" role="button">Student Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-success mx-2" href="login.php?role=teacher" role="button">Teacher Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-danger mx-2" href="login.php?role=admin" role="button">Admin Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- hero section  -->

    <section id="home" class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 text-content">
                    <h1>Welcome to the Student Management System</h1>
                    <p>Please login as a student or teacher to access the courses.
                    </p>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <img src="images/hero-image.jpeg" alt="" class="img-fluid">
                </div>

            </div>
        </div>
    </section>

    <!-- footer section  -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <img src="images/logo.png" alt="Student Management System Logo" style="width: 100px;">
                </div>

                <div class="col-lg-9 col-md-12 col-sm-12 text-end">
                    <p>Student Management System <br> &copy;2024</p>
                </div>
            </div>

        </div>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>

</html>