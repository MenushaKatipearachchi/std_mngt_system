<?php
session_start();

include("connection.php");

if (!isset($_SESSION['username'])) {
    header("location:index.php");
}

?>

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

    <link rel="stylesheet" href="css/style.css">
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
                            <a class="nav-link" aria-current="page" href="#home">Home</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#services">Activities</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="#projects">Courses</a>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="bi bi-person"></i>
                                </a>
                                <ul class="dropdown-menu mt-2 mr-0" aria-labelledby="dropdownMenuLink">
                                    <li>
                                        <?php

                                        $id = $_SESSION['id'];
                                        $query = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");

                                        while ($result = mysqli_fetch_assoc($query)) {
                                            $res_username = $result['username'];
                                            $res_email = $result['email'];
                                            $res_id = $result['id'];
                                        }


                                        echo "<a class='dropdown-item' href='edit.php?id=$res_id'>Change Profile</a>";


                                        ?>

                                    </li>
                                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="name">
        <center>Welcome
            <?php
            echo $_SESSION['username']; // Display username

            // Check if the session has a role set, and display it in parentheses if it does
            if (isset($_SESSION['role']) && ($_SESSION['role'] === 'student' || $_SESSION['role'] === 'teacher')) {
                echo " (" . $_SESSION['role'] . ")"; // Display role
            }
            ?>
            !
        </center>
    </div>

    <!-- hero section  -->

    <section id="home" class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 text-content">
                    <h1>this is where you find all the courses</h1>
                    <p>Please enroll in the courses to get the best experience of learning.
                    </p>
                    <a href="#projects" style="color: azure;"><button class="btn">Go to Courses</button></a>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <img src="images/hero-image.jpeg" alt="" class="img-fluid">
                </div>

            </div>
        </div>
    </section>

    <!-- project section  -->
     
    <section class="project-section" id="projects">
        <div class="container">
            <div class="row text">
                <div class="col-lg-6 col-md-12">
                    <h1>Available Courses</h1>
                    <hr>
                </div>
                <div class="col-lg-6 col-md-12">
                    <p>Choose the courses you wish to enroll in.</p>
                </div>
            </div>

            <!-- Category Filter Dropdown -->
            <div class="row filter-row justify-content-center">
                <div class="col-lg-6 col-md-8 text-center">
                    <label for="categoryFilter" class="filter-label">Filter by Category:</label>
                    <select id="categoryFilter" class="category-filter" onchange="filterCourses()">
                        <option value="all">All Categories</option>
                        <?php
                        $category_query = "SELECT DISTINCT category FROM courses";
                        $category_result = mysqli_query($conn, $category_query);
                        while ($category = mysqli_fetch_assoc($category_result)) {
                            echo '<option value="' . htmlspecialchars($category['category']) . '">' . htmlspecialchars($category['category']) . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-- Scroll Buttons -->
            <button class="carousel-control left-arrow" onclick="scrollCardsLeft()">&#10094;</button>
            <button class="carousel-control right-arrow" onclick="scrollCardsRight()">&#10095;</button>

            <div class="project-container">
                <div class="row project">
                    <?php
                    $query = "SELECT * FROM courses ORDER BY last_modified DESC";
                    $result = mysqli_query($conn, $query);
                    $user_id = $_SESSION['id'];
                    $user_role = $_SESSION['role'];

                    if (mysqli_num_rows($result) > 0) {
                        while ($course = mysqli_fetch_assoc($result)) {
                            $enrollment_check_query = "SELECT status FROM enrollments WHERE user_id = $user_id AND course_id = " . $course['id'];
                            $enrollment_check_result = mysqli_query($conn, $enrollment_check_query);
                            $enrollment_status = mysqli_fetch_assoc($enrollment_check_result);

                            $status_class = 'enroll-btn';
                            $status_text = 'Enroll';
                            $button_disabled = false;

                            if ($enrollment_status) {
                                if ($enrollment_status['status'] === 'pending') {
                                    $status_class = 'enroll-btn--pending';
                                    $status_text = 'Enrollment Pending';
                                    $button_disabled = true;
                                } elseif ($enrollment_status['status'] === 'approved') {
                                    $status_class = 'enroll-btn--approved';
                                    $status_text = 'Enrolled';
                                    $button_disabled = true;
                                } elseif ($enrollment_status['status'] === 'rejected') {
                                    $status_class = 'enroll-btn--rejected';
                                    $status_text = 'Enrollment Rejected';
                                    $button_disabled = true;
                                }
                            }

                            $imagePath = !empty($course['image_path']) ? 'admin/' . htmlspecialchars($course['image_path']) : 'images/default_image.jpg';
                    ?>
                            <div class="card course-card" data-category="<?php echo htmlspecialchars($course['category']); ?>" onclick="openModal(<?php echo htmlspecialchars(json_encode(array_merge($course, ['status' => $enrollment_status['status']]))); ?>)">
                                <img src="<?php echo $imagePath; ?>" class="card-img-top" alt="Course Image">
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo htmlspecialchars($course['title']); ?></h4>
                                    <p class="card-text">
                                        <?php echo htmlspecialchars($course['category']); ?><br><br>
                                        <?php echo date("M d, Y", strtotime($course['date'])); ?>
                                    </p>

                                    <!-- Enroll Button: Show only if user role is not Teacher -->
                                    <?php if ($user_role !== 'teacher') : ?>
                                        <button class="<?php echo $status_class; ?>"
                                            data-course='<?php echo json_encode($course); ?>'
                                            onclick="showConfirmationModal(event)"
                                            <?php echo $button_disabled ? 'disabled' : ''; ?>>
                                            <?php echo $status_text; ?>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<p>No courses available at the moment.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Enroll Confirmation Modal -->
    <?php if ($user_role !== 'teacher') : ?>
        <div id="confirmationModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeConfirmationModal()">&times;</span>
                <h3>Are you sure you want to enroll in this course?</h3>
                <div class="modal-footer">
                    <button id="confirmEnroll" class="enroll-btn" onclick="confirmEnrollment()">Yes, Enroll</button>
                    <button class="cancel-btn" onclick="closeConfirmationModal()">Cancel</button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div id="courseModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="modal-header">
                <img id="modalImage" src="" alt="Course Image" class="modal-img">
                <h2 id="modalTitle"></h2>
            </div>
            <div class="modal-body">
                <p id="modalCategory"></p>
                <p id="modalDate"></p>
                <p id="modalDescription"></p>
            </div>
            <!-- Enroll Button in Modal: Show only if user role is not Teacher -->
            <?php if ($user_role !== 'teacher') : ?>
                <div class="modal-footer">
                    <button id="enrollButton" class="enroll-btn" onclick="showConfirmationModal(event)">Enroll Now</button>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- footer section  -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <img src="images/logo.png" alt="Student Management System Logo" style="width: 100px;">
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <ul class="d-flex">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Courses</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-12 col-sm-12">
                    <p>&copy;2024</p>
                </div>

                <div class="col-lg-1 col-md-12 col-sm-12">
                    <!-- back to top  -->

                    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                            class="bi bi-arrow-up-short"></i></a>
                </div>

            </div>

        </div>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>

    <script src="js/courseCarousel.js"></script>
    <script src="js/courseDetailsModal.js"></script>

    <script>
        // JavaScript function to filter courses by category
        function filterCourses() {
            const selectedCategory = document.getElementById('categoryFilter').value;
            const courses = document.querySelectorAll('.course-card');

            courses.forEach(course => {
                const courseCategory = course.getAttribute('data-category');
                if (selectedCategory === 'all' || courseCategory === selectedCategory) {
                    course.style.display = 'block';
                } else {
                    course.style.display = 'none';
                }
            });
        }
    </script>
</body>

</html>