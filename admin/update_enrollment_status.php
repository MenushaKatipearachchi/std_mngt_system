<?php
include("../connection.php");

if (isset($_POST['enrollment_id']) && isset($_POST['status'])) {
    $enrollmentId = $_POST['enrollment_id'];
    $status = $_POST['status'];

    // Update the enrollment status
    $query = "UPDATE enrollments SET status = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'si', $status, $enrollmentId);

    if (mysqli_stmt_execute($stmt)) {
        echo 'Success';
    } else {
        echo 'Error updating enrollment status';
    }

    mysqli_stmt_close($stmt);
}
