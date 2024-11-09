<?php
session_start();

include("../connection.php");
include("upload.php");
include("view_notifications.php");

if (!isset($_SESSION['username'])) {
    header("location:index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Homepage</title>

    <link rel="icon" href="../images/logo.png" type="image/png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../css/styleAdmin.css">
</head>

<body>

    <!-- navbar section   -->

    <?php
    $query = "SELECT COUNT(*) AS pending_count FROM enrollments WHERE status = 'pending'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    $pendingCount = $data['pending_count'];
    ?>


    <header class="navbar-section">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <div class="logo-wrapper">
                        <img src="../images/logo.png" alt="Student Management System Logo" id="logoImg">
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
                        <li class="nav-item">
                            <a class="nav-link" href="#projects">Courses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#reportModal">
                                Report
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);"
                                style="background-color: #f39c12; color: white; border-radius: 5px; padding: 8px 15px;"
                                data-bs-toggle="modal" data-bs-target="#notificationModal">
                                Notifications
                                <?php if ($pendingCount > 0): ?>
                                    <span class="badge bg-danger" style="position: absolute; top: -5px; right: -10px; font-size: 12px; padding: 5px 10px;"><?php echo $pendingCount; ?></span>
                                <?php endif; ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="bi bi-person"></i>
                                </a>
                                <ul class="dropdown-menu mt-2 mr-0" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportModalLabel">Reports and Metrics</h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-primary" id="downloadReportBtn">Download Report</button>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- User table for visualization -->
                    <h6>Students Table</h6>
                    <table class="table table-bordered" id="userTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Student Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody"></tbody>
                    </table><br><br>

                    <h6>Course Enrollments</h6>
                    <canvas id="courseChart"></canvas><br><br>

                    <!-- New Chart for Enrollment Status -->
                    <h6>Enrollment Status</h6>
                    <canvas id="enrollmentStatusChart"></canvas><br><br>

                    <h6>Attendance Distribution</h6>
                    <table class="table table-bordered" id="attendanceTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody id="attendanceTableBody"></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="name">
        <center>Welcome
            <?php

            echo $_SESSION['username'];

            ?>
            !
        </center>
    </div>

    <!-- project section  -->

    <section class="project-section" id="projects">
        <div class="container">
            <div class="row text">
                <div class="col-lg-6 col-md-12">
                    <h1>Manage Courses</h1>
                    <hr>
                </div>
                <div class="col-lg-6 col-md-12">
                    <p>Manage all the courses here.</p>
                    <button id="addCourseBtn" class="btn btn-primary">Add Course</button>
                </div>
            </div>

            <div class="project-container">
                <div class="row project">
                    <?php
                    // Fetch courses from the database
                    $query = "SELECT * FROM courses ORDER BY last_modified DESC";
                    $result = mysqli_query($conn, $query);

                    // Check if there are courses in the database
                    if (mysqli_num_rows($result) > 0) {
                        while ($course = mysqli_fetch_assoc($result)) {
                            // Check if the image path exists and set a default image if not
                            $imagePath = !empty($course['image_path']) ? htmlspecialchars($course['image_path']) : 'images/default_image.jpg';
                    ?>
                            <div class="card">
                                <img src="<?php echo $imagePath; ?>" class="card-img-top" alt="Course Image">
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo htmlspecialchars($course['title']); ?></h4>
                                    <p class="card-text">
                                        <?php echo htmlspecialchars($course['category']); ?>.<br><br>
                                        <?php echo date("M d, Y", strtotime($course['date'])); ?>
                                    </p>
                                    <button onclick="openModal('<?php echo $course['id']; ?>', '<?php echo htmlspecialchars($course['title']); ?>', '<?php echo htmlspecialchars($course['category']); ?>', '<?php echo htmlspecialchars($course['description']); ?>', '<?php echo $course['date']; ?>')">Edit</button>
                                    <button class="deleteBtn" onclick="deleteCourse(<?php echo $course['id']; ?>)">Delete</button>
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

    <!-- Modal for Adding or Editing Course -->
    <div id="courseModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2 id="modalTitle"><?php echo $modalTitle; ?></h2>
            <form id="courseForm" method="POST" action="upload.php" enctype="multipart/form-data">
                <input type="hidden" name="courseId" id="courseId" value="<?php echo htmlspecialchars($courseId); ?>"> <!-- Hidden for edit -->

                <label for="title">Course Title</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>" required>

                <label for="description">Description</label>
                <textarea id="description" name="description" required><?php echo htmlspecialchars($description); ?></textarea>

                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option value="Development" <?php if ($category == 'Development') echo 'selected'; ?>>Development</option>
                    <option value="UI/UX" <?php if ($category == 'UI/UX') echo 'selected'; ?>>UI/UX</option>
                    <option value="Programming" <?php if ($category == 'Programming') echo 'selected'; ?>>Programming</option>
                    <option value="Data Science" <?php if ($category == 'Data Science') echo 'selected'; ?>>Data Science</option>
                    <option value="Web Development" <?php if ($category == 'Web Development') echo 'selected'; ?>>Web Development</option>
                    <option value="Marketing" <?php if ($category == 'Marketing') echo 'selected'; ?>>Marketing</option>
                    <option value="Cloud Computing" <?php if ($category == 'Cloud Computing') echo 'selected'; ?>>Cloud Computing</option>
                    <option value="Design" <?php if ($category == 'Design') echo 'selected'; ?>>Design</option>
                    <option value="Cybersecurity" <?php if ($category == 'Cybersecurity') echo 'selected'; ?>>Cybersecurity</option>
                    <option value="Mobile Development" <?php if ($category == 'Mobile Development') echo 'selected'; ?>>Mobile Development</option>
                </select><br><br>

                <label for="date">Date</label>
                <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($date); ?>" required>

                <label for="image">Upload Image:</label>
                <input type="file" name="image" id="image" accept="image/*"><br><br>

                <button type="submit" id="submitBtn"><?php echo $submitButton; ?></button>
            </form>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="modal">
        <div class="modal-content success-modal">
            <p id="successMessage"></p>
            <button onclick="closeSuccessModal()">Close</button>
        </div>
    </div>

    <!-- footer section  -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <img src="../images/logo.png" alt="Student Management System Logo" style="width: 100px;">
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <ul class="d-flex">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Courses</a></li>
                        <li><a href="#">Notifications</a></li>
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Include jsPDF Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <!-- Include autoTable Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>

    <script src="../js/courseModal.js"></script>
    <script src="../js/successModal.js"></script>
    <script src="../js/adminApproveReject.js"></script>
    <script src="../js/AddEditCourse.js"></script>
    <script src="../js/deleteCourse.js"></script>
    <script src="../js/report.js"></script>
    <script src="../js/downloadReport.js"></script>
</body>

</html>