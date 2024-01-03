<?php
session_start();

include 'db_config.php';

// Check if the user is not logged in or is not an admin, redirect them to the login page
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: login.php');
    exit;
}

// Get the user ID from the query string
$userID = isset($_GET['id']) ? $_GET['id'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission to update user information

    // Validate and sanitize input data
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    $phone_number = filter_input(INPUT_POST, 'phone_number', FILTER_SANITIZE_STRING);
    $enrollment_number = filter_input(INPUT_POST, 'enrollment_number', FILTER_SANITIZE_STRING);
    $join_date = $_POST['join_date'];
    $class_batch = filter_input(INPUT_POST, 'class_batch', FILTER_SANITIZE_STRING);
    $current_degree = filter_input(INPUT_POST, 'current_degree', FILTER_SANITIZE_STRING);
    $accommodation = filter_input(INPUT_POST, 'accommodation', FILTER_SANITIZE_STRING);
    $current_semester = filter_input(INPUT_POST, 'current_semester', FILTER_SANITIZE_STRING);
    $marks_mad = filter_input(INPUT_POST, 'marks_mad', FILTER_VALIDATE_INT);
    $marks_nodejs = filter_input(INPUT_POST, 'marks_nodejs', FILTER_VALIDATE_INT);
    $marks_cn = filter_input(INPUT_POST, 'marks_cn', FILTER_VALIDATE_INT);
    $marks_software_packages = filter_input(INPUT_POST, 'marks_software_packages', FILTER_VALIDATE_INT);
    $marks_software_engi = filter_input(INPUT_POST, 'marks_software_engi', FILTER_VALIDATE_INT);
    $lab_attendance_mad = filter_input(INPUT_POST, 'lab_attendance_mad', FILTER_VALIDATE_INT);
    $labAttendanceNodeJs = filter_input(INPUT_POST, 'lab_attendance_nodejs', FILTER_VALIDATE_INT);
    $labAttendanceCN = filter_input(INPUT_POST, 'lab_attendance_cn', FILTER_VALIDATE_INT);
    $labAttendanceSoftwarePackages = filter_input(INPUT_POST, 'lab_attendance_software_packages', FILTER_VALIDATE_INT);
    $labAttendanceSoftwareEngi = filter_input(INPUT_POST, 'lab_attendance_software_engi', FILTER_VALIDATE_INT);
    $lecAttendanceMAD = filter_input(INPUT_POST, 'lec_attendance_mad', FILTER_VALIDATE_INT);
    $lecAttendanceNodeJs = filter_input(INPUT_POST, 'lec_attendance_nodejs', FILTER_VALIDATE_INT);
    $lecAttendanceCN = filter_input(INPUT_POST, 'lec_attendance_cn', FILTER_VALIDATE_INT);
    $lecAttendanceSoftwarePackages = filter_input(INPUT_POST, 'lec_attendance_software_packages', FILTER_VALIDATE_INT);
    $lecAttendanceSoftwareEngi = filter_input(INPUT_POST, 'lec_attendance_software_engi', FILTER_VALIDATE_INT);

// Update user details in the database
// Update user details in the database
try {
    $stmt = $conn->prepare("UPDATE users SET name=?, email=?, address=?, phone_number=?, enrollment_number=?, join_date=?, class_batch=?, current_degree=?, accommodation=?, current_semester=?, marks_mad=?, marks_nodejs=?, marks_cn=?, marks_software_packages=?, marks_software_engi=?, lab_attendance_mad=?, lab_attendance_nodejs=?, lab_attendance_cn=?, lab_attendance_software_packages=?, lab_attendance_software_engi=?, lec_attendance_mad=?, lec_attendance_nodejs=?, lec_attendance_cn=?, lec_attendance_software_packages=?, lec_attendance_software_engi=? WHERE id=?");
    if (!$stmt) {
        die("Error in SQL query: " . $conn->error);
    }

    $stmt->bind_param("sssssssssiiiiiiiiiiiiiiiii", $name, $email, $address, $phone_number, $enrollment_number, $join_date, $class_batch, $current_degree, $accommodation, $current_semester, $marks_mad, $marks_nodejs, $marks_cn, $marks_software_packages, $marks_software_engi, $lab_attendance_mad, $labAttendanceNodeJs, $labAttendanceCN, $labAttendanceSoftwarePackages, $labAttendanceSoftwareEngi, $lecAttendanceMAD, $lecAttendanceNodeJs, $lecAttendanceCN, $lecAttendanceSoftwarePackages, $lecAttendanceSoftwareEngi, $userID);

    // Execute the statement
    $stmt->execute();

    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
        // Redirect back to the admin dashboard after updating
        header('Location: admin_dashboard.php');
        exit;
    } else {
        echo "Update failed: " . $stmt->error;
    }
    

    $stmt->close();
} catch (Exception $e) {
    // Handle exceptions, log errors, or display a user-friendly message
    echo "Error: " . $e->getMessage();
}


} else {
    // Fetch user details for the given ID
    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            // Display the edit form
            include 'header.php';
            ?>

            <!-- Main Body is here -->
            <main class="site-main dashboard-page admin-dash">
                <div class="site-content-inner">
                    <div class="page-content-in">
                        <div class="page-headings" style="background-image:url('assets/images/banner.jpg');">
                            <div class="container">
                                <h2>Edit User: <?php echo $user['name']; ?></h2>
                                <div class="breadcrumb-list">
                                    <ul>
                                        <li><a href="<?php echo $home_url; ?>">Home</a></li>
                                        <li><span> / </span></li>
                                        <li><a href="<?php echo $home_url; ?>/admin_dashboard.php">Admin Dashboard</a></li>
                                        <li><span> / </span></li>
                                        <li>Edit User</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="container edit-dash">
                            <!-- Display edit form for the user -->
                            <h2></h2>

                            <!-- Add an HTML form with input fields to edit user details -->
                            <form action="edit_user.php?id=<?php echo $userID; ?>" method="post">

                           
                                <!-- Personal Details -->
                            <div class="rows head-rows">
                                <div class="cols-50">
                                   <h3>Personal Details</h3>
                                </div> 
                            </div>

                            <div class="rows">
                                <div class="cols-50">
                                    <label for="name">Name:</label>
                                    <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
                                </div> 
                                <div class="cols-50">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
                                </div> 
                            </div> 
                            <div class="rows">
                                
                                <div class="cols-50">
                                    <label for="address">Address:</label>
                                     <input type="text" name="address" value="<?php echo $user['address']; ?>" required>
                                </div> 
                                <div class="cols-50">
                                 
                                </div> 
                            </div>

                            <div class="rows">
                                <div class="cols-50">
                                     <label for="phone_number">Phone Number:</label>
                                     <input type="text" name="phone_number" value="<?php echo $user['phone_number']; ?>" required>
                                </div> 
                                <div class="cols-50">
                                     <label for="enrollment_number">Enrollment Number:</label>
                                    <input type="text" name="enrollment_number" value="<?php echo $user['enrollment_number']; ?>" required>
                                </div> 
                            </div>

                            <div class="rows">
                                <div class="cols-50">
                                     <label for="join_date">Joining Date:</label>
                                     <input type="date" name="join_date"  value="<?php echo $user['join_date']; ?>">
                                </div> 
                                <div class="cols-50">
                                     <label for="class_batch">Class / Batch: (Ex:- B-B1)</label>
                                    <input type="text" name="class_batch" value="<?php echo $user['class_batch']; ?>" required>
                                </div> 
                            </div>
                            
                            <div class="rows">
                                <div class="cols-50">
                                     <label for="current_degree">Degree:</label>
                                     <input type="text" name="current_degree" value="<?php echo $user['current_degree']; ?>" required>
                                </div> 
                                <div class="cols-50">
                                    
                                </div> 
                            </div>

                            <div class="rows radio-rows"> 
                                <label><strong>Hosteller or Traveller:</strong></label>
                                <label class="radio-label"><input type="radio" name="accommodation" value="hosteller" <?php if ($user['accommodation'] === 'hosteller') echo 'checked'; ?> required> Hosteller</label>
                                <label class="radio-label"><input type="radio" name="accommodation" value="traveller" <?php if ($user['accommodation'] === 'traveller') echo 'checked'; ?> required> Traveller</label>
                            </div>


                            <div class="rows head-rows">
                                <div class="cols-50">
                                   <h3>Education Details</h3>
                                </div> 
                            </div>

                            <div class="rows">
                                <div class="cols-50">
                                    <label for="current_semester">Current Semester Name:</label>
                                    <input type="text" name="current_semester" value="<?php echo $user['current_semester']; ?>" required>
                                </div> 
                                <div class="cols-50">
                                    <label for="marks_mad">Marks of MAD:</label>
                                    <input type="number" name="marks_mad" value="<?php echo $user['marks_mad']; ?>" required>
                                </div> 
                            </div>

                            <div class="rows">
                                <div class="cols-50">
                                    <label for="marks_nodejs">Marks of NodeJs:</label>
                                    <input type="number" name="marks_nodejs" value="<?php echo $user['marks_nodejs']; ?>" required>
                                </div> 
                                <div class="cols-50">
                                    <label for="marks_cn">Marks of CN:</label>
                                    <input type="number" name="marks_cn" value="<?php echo $user['marks_cn']; ?>" required>
                                </div> 
                            </div>


                            <div class="rows">
                                <div class="cols-50">
                                    <label for="marks_software_packages">Marks of Software Packages:</label>
                                    <input type="number" name="marks_software_packages" value="<?php echo $user['marks_software_packages']; ?>" required>
                                </div> 
                                <div class="cols-50">
                                    <label for="marks_software_engi">Marks of Software Engi.:</label>
                                    <input type="number" name="marks_software_engi" value="<?php echo $user['marks_software_engi']; ?>" required>
                                </div> 
                            </div>

                            <div class="rows head-rows">
                                <div class="cols-50">
                                <h3>Lab Attendance Details</h3>
                                </div> 
                            </div>

                            <div class="rows">
                                <div class="cols-50">
                                    <label for="lab_attendance_mad">Lab Attendance of MAD (Percentage):</label>
                                    <input type="number" name="lab_attendance_mad" value="<?php echo $user['lab_attendance_mad']; ?>" required>
                                </div> 
                            </div>

                            <div class="rows">
                                <div class="cols-50">
                                    <label for="lab_attendance_nodejs">Lab Attendance of NodeJs (Percentage):</label>
                                    <input type="number" name="lab_attendance_nodejs" value="<?php echo $user['lab_attendance_nodejs']; ?>" required>
                                </div> 
                                <div class="cols-50">
                                    <label for="lab_attendance_cn">Lab Attendance of CN (Percentage):</label>
                                    <input type="number" name="lab_attendance_cn" value="<?php echo $user['lab_attendance_cn']; ?>" required>
                                </div> 
                            </div>

                            <div class="rows">
                                <div class="cols-50">
                                    <label for="lab_attendance_software_packages">Lab Attendance of Software Packages (Percentage):</label>
                                    <input type="number" name="lab_attendance_software_packages" value="<?php echo $user['lab_attendance_software_packages']; ?>" required>
                                </div> 
                                <div class="cols-50">
                                    <label for="lab_attendance_software_engi">Lab Attendance of Software Engi. (Percentage):</label>
                                    <input type="number" name="lab_attendance_software_engi" value="<?php echo $user['lab_attendance_software_engi']; ?>" required>
                                </div> 
                            </div>

                            <div class="rows head-rows">
                                <div class="cols-50">
                                <h3>Lectures Attendance Details</h3>
                                </div> 
                            </div>

                            <div class="rows">
                                <div class="cols-50">
                                    <label for="lec_attendance_mad">Attendance of MAD (Percentage):</label>
                                    <input type="number" name="lec_attendance_mad" value="<?php echo $user['lec_attendance_mad']; ?>" required>
                                </div> 
                            </div>
                
                            <div class="rows">
                                <div class="cols-50">
                                    <label for="lec_attendance_nodejs">Attendance of NodeJs (Percentage):</label>
                                    <input type="number" name="lec_attendance_nodejs" value="<?php echo $user['lec_attendance_nodejs']; ?>" required>
                                </div> 
                                <div class="cols-50">
                                    <label for="lec_attendance_cn">Attendance of CN (Percentage):</label>
                                    <input type="number" name="lec_attendance_cn" value="<?php echo $user['lec_attendance_cn']; ?>" required>
                                </div> 
                            </div>
                         
                            <div class="rows">
                                <div class="cols-50">
                                    <label for="lec_attendance_software_packages">Attendance of Software Packages (Percentage):</label>
                                    <input type="number" name="lec_attendance_software_packages" value="<?php echo $user['lec_attendance_software_packages']; ?>" required>
                                </div> 
                                <div class="cols-50">
                                    <label for="lec_attendance_software_engi">Attendance of Software Engi. (Percentage):</label>
                                    <input type="number" name="lec_attendance_software_engi" value="<?php echo $user['lec_attendance_software_engi']; ?>" required>
                                </div> 
                            </div>

                                <div class="rows submt-rows">
                                    <input type="submit" value="Update">
                                </div>

                            </form>

                            <a href="<?php echo $home_url; ?>/admin_dashboard.php"> ←  Back to Dashboard</a>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Footer is here -->
            <?php include 'footer.php'; ?>

            <?php
        } else {
            echo "User not found.";
        }

        $stmt->close();
    } catch (Exception $e) {
        // Handle exceptions, log errors, or display a user-friendly message
        echo "Error: " . $e->getMessage();
    }

    $conn->close();
}
?>
