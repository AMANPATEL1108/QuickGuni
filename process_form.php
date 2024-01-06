<?php
// Include database connection configuration
include 'db_config.php';

// Check if the form is submitted and the user is an admin
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
    // Retrieve form data
    $name = $_POST['name'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Store the password as plain text
    $address = $_POST['address'];
    $phone = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
    $enrollmentNumber = $_POST['enrollment_number'];
    $accommodation = isset($_POST['accommodation']) ? $_POST['accommodation'] : '';
    $joinDate = isset($_POST['join_date']) ? $_POST['join_date'] : '';
    $classBatch = isset($_POST['class_batch']) ? $_POST['class_batch'] : '';
    $currentDegree = isset($_POST['current_degree']) ? $_POST['current_degree'] : '';
    $currentSemester = $_POST['current_semester'];
    $marksMAD = isset($_POST['marks_mad']) ? $_POST['marks_mad'] : '';
    $marksNodeJs = isset($_POST['marks_nodejs']) ? $_POST['marks_nodejs'] : '';
    $marksCN = isset($_POST['marks_cn']) ? $_POST['marks_cn'] : '';
    $marksSoftwarePackages = isset($_POST['marks_software_packages']) ? $_POST['marks_software_packages'] : '';
    $marksSoftwareEngi = isset($_POST['marks_software_engi']) ? $_POST['marks_software_engi'] : '';
    $labAttendanceMAD = isset($_POST['lab_attendance_mad']) ? $_POST['lab_attendance_mad'] : '';
    $labAttendanceNodeJs = isset($_POST['lab_attendance_nodejs']) ? $_POST['lab_attendance_nodejs'] : '';
    $labAttendanceCN = isset($_POST['lab_attendance_cn']) ? $_POST['lab_attendance_cn'] : '';
    $labAttendanceSoftwarePackages = isset($_POST['lab_attendance_software_packages']) ? $_POST['lab_attendance_software_packages'] : '';
    $labAttendanceSoftwareEngi = isset($_POST['lab_attendance_software_engi']) ? $_POST['lab_attendance_software_engi'] : '';
    $lecAttendanceMAD = isset($_POST['lec_attendance_mad']) ? $_POST['lec_attendance_mad'] : '';
    $lecAttendanceNodeJs = isset($_POST['lec_attendance_nodejs']) ? $_POST['lec_attendance_nodejs'] : '';
    $lecAttendanceCN = isset($_POST['lec_attendance_cn']) ? $_POST['lec_attendance_cn'] : '';
    $lecAttendanceSoftwarePackages = isset($_POST['lec_attendance_software_packages']) ? $_POST['lec_attendance_software_packages'] : '';
    $lecAttendanceSoftwareEngi = isset($_POST['lec_attendance_software_engi']) ? $_POST['lec_attendance_software_engi'] : '';

// Check if the email is already registered
$stmtCheckEmail = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
$stmtCheckEmail->bind_param("s", $email);
$stmtCheckEmail->execute();
$stmtCheckEmail->bind_result($emailCount);
$stmtCheckEmail->fetch();
$stmtCheckEmail->close();

if ($emailCount > 0) {
    // Email is already registered, display an error message
    echo '<script>';
    echo 'alert("Error: Email is already registered.");';
    echo 'window.location.href = "register.php";'; // Redirect back to registration page
    echo '</script>';
    exit;
}


        // Hash the password using bcrypt
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Prepare and execute the SQL statement (replace with your actual database logic)
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name,  name, email, password, address, phone_number, enrollment_number, accommodation, join_date, class_batch, current_degree, current_semester, marks_mad, marks_nodejs, marks_cn, marks_software_packages, marks_software_engi, lab_attendance_mad, lab_attendance_nodejs, lab_attendance_cn, lab_attendance_software_packages, lab_attendance_software_engi, lec_attendance_mad, lec_attendance_nodejs, lec_attendance_cn, lec_attendance_software_packages, lec_attendance_software_engi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)");

        // Update the bind_param based on the number and types of fields in your SQL statement
        $stmt->bind_param("ssssssssssssssssssssssssssss", $first_name, $last_name,  $name, $email, $hashedPassword, $address, $phone, $enrollmentNumber, $accommodation, $joinDate, $classBatch, $currentDegree, $currentSemester, $marksMAD, $marksNodeJs, $marksCN, $marksSoftwarePackages, $marksSoftwareEngi, $labAttendanceMAD, $labAttendanceNodeJs, $labAttendanceCN, $labAttendanceSoftwarePackages, $labAttendanceSoftwareEngi, $lecAttendanceMAD, $lecAttendanceNodeJs, $lecAttendanceCN, $lecAttendanceSoftwarePackages, $lecAttendanceSoftwareEngi);



    if ($stmt->execute()) {
        // Registration successful
        echo '<script>';
        echo 'alert("Registration successful. Admin should provide login details to the user.");';
        echo 'window.location.href = "index.php";'; // Redirect to homepage
        echo '</script>';
        exit;
    } else {
        // Registration failed
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Access denied. Only administrators can register users.";
}

// Close the database connection
$conn->close();
?>
