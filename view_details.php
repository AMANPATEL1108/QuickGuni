<<<<<<< HEAD
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

if ($userID) {
    try {
        // Fetch detailed information for the selected user
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $userID);

        // Debugging SQL error
        if (!$stmt->execute()) {
            die('Error executing the query: ' . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            // Assign user details to individual variables
            $name = $user['name'];
            $first_name = $user['first_name'];
            $last_name = $user['last_name'];
            $email = $user['email'];
            $address = $user['address'];
            $phone = $user['phone_number'];
            $enrollmentNumber = $user['enrollment_number'];
            $accommodation = $user['accommodation'];
            $joinDate = $user['join_date'];
            $classBatch = $user['class_batch'];
            $currentDegree = $user['current_degree'];
            $currentSemester = $user['current_semester'];
            $marksMAD = $user['marks_mad'];
            $marksNodeJs = $user['marks_nodejs'];
            $marksCN = $user['marks_cn'];
            $marksSoftwarePackages = $user['marks_software_packages'];
            $marksSoftwareEngi = $user['marks_software_engi'];
            $labAttendanceMAD = $user['lab_attendance_mad'];
            $labAttendanceNodeJs = $user['lab_attendance_nodejs'];
            $labAttendanceCN = $user['lab_attendance_cn'];
            $labAttendanceSoftwarePackages = $user['lab_attendance_software_packages'];
            $labAttendanceSoftwareEngi = $user['lab_attendance_software_engi'];
            $lecAttendanceMAD = $user['lec_attendance_mad'];
            $lecAttendanceNodeJs = $user['lec_attendance_nodejs'];
            $lecAttendanceCN = $user['lec_attendance_cn'];
            $lecAttendanceSoftwarePackages = $user['lec_attendance_software_packages'];
            $lecAttendanceSoftwareEngi = $user['lec_attendance_software_engi'];

            // Display detailed information about the user
            include 'header.php';

            // Main Body
            echo '<main class="site-main dashboard-page admin-dash">';
            echo '<div class="site-content-inner">';
            echo '<div class="page-content-in">';

            // Page Heading
            echo '<div class="page-headings" style="background-image:url(\'assets/images/banner.jpg\');">';
            echo '    <div class="container">';
            echo '        <h2>' . $name . '</h2>';
            echo '        <div class="breadcrumb-list">';
            echo '            <ul>';

            // Dynamically change breadcrumb based on user role
            if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
                echo '                <li><a href="' . $home_url . '/admin_dashboard.php">Admin Dashboard</a></li>';
            } else {
                echo '                <li><a href="' . $home_url . '/student_dashboard.php">Student Dashboard</a></li>';
            }

            echo '                <li><span> / </span></li>';
            echo '                <li><a href="' . $home_url . '/view_details.php?id=' . $userID . '">Profile</a></li>';
            echo '            </ul>';
            echo '        </div>';
            echo '    </div>';
            echo '</div>';

            echo '<div class="container view-dashs">';

            // Display additional fields from the form using the HTML layout

            echo '<div class="inner-dash-details view-details-top">';
            echo '    <div class="rows heads-in-sub">';
            echo '        <div class="cols-50">';
            echo '            <h3>Student Profile</h3>';
            echo '        </div>';
            echo '    </div>';
            echo '    <div class="rows">';
            echo '        <div class="cols-50">';
            echo '            <div class="info-divs">';
            echo '                <h4>Student First Name</h4>';
            echo "                <p>{$first_name}</p>";
            echo '            </div>';
            echo '        </div>';
            echo '        <div class="cols-50">';
            echo '            <div class="info-divs">';
            echo '                <h4>Student Last Name</h4>';
            echo "                <p>{$last_name}</p>";
            echo '            </div>';
            echo '        </div>';
            echo '        <div class="cols-50">';
            echo '            <div class="info-divs">';
            echo '                <h4>Student Full Name</h4>';
            echo "                <p>{$name}</p>";
            echo '            </div>';
            echo '        </div>';
            echo '        <div class="cols-50">';
            echo '            <div class="info-divs">';
            echo '                <h4>Email</h4>';
            echo "                <p>{$email}</p>";
            echo '            </div>';
            echo '        </div>';
            echo '        <div class="cols-50">';
            echo '            <div class="info-divs">';
            echo '                <h4>Address</h4>';
            echo "                <p>{$address}</p>";
            echo '            </div>';
            echo '        </div>';
            echo '        <div class="cols-50">';
            echo '            <div class="info-divs">';
            echo '                <h4>Phone</h4>';
            echo "                <p>{$phone}</p>";
            echo '            </div>';
            echo '        </div>';
            echo '        <div class="cols-50">';
            echo '            <div class="info-divs">';
            echo '                <h4>Enrollment Number</h4>';
            echo "                <p>{$enrollmentNumber}</p>";
            echo '            </div>';
            echo '        </div>';
            echo '        <div class="cols-50">';
            echo '            <div class="info-divs">';
            echo '                <h4>Accommodation</h4>';
            echo "                <p>{$accommodation}</p>";
            echo '            </div>';
            echo '        </div>';
            echo '        <div class="cols-50">';
            echo '            <div class="info-divs">';
            echo '                <h4>Joining Date </h4>';
            echo "                <p>{$joinDate}</p>";
            echo '            </div>';
            echo '        </div>';
            echo '        <div class="cols-50">';
            echo '            <div class="info-divs">';
            echo '                <h4>Class & Batch</h4>';
            echo "                <p>{$classBatch}</p>";
            echo '            </div>';
            echo '        </div>';
            echo '        <div class="cols-50">';
            echo '            <div class="info-divs">';
            echo '                <h4>Current Semester</h4>';
            echo "                <p>{$currentSemester}</p>";
            echo '            </div>';
            echo '        </div>';
            echo '        <div class="cols-50">';
            echo '            <div class="info-divs">';
            echo '                <h4> Degree</h4>';
            echo "                <p>{$currentDegree}</p>";
            echo '            </div>';
            echo '        </div>';
            echo '    </div>';
            echo '</div>';


            // Display additional fields from the form using the HTML layout
            ?>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <title>Student Results and Attendance</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f5f5f5;
                    }

                    h1 {
                        color: #333;
                        text-align: center;
                        margin-bottom: 20px;
                    }

                    h2 {
                        color: #333;
                        text-align: center;
                        margin-bottom: 10px;
                        font-size: 24px;
                        text-transform: uppercase;
                        letter-spacing: 2px;
                        border-bottom: 2px solid #333;
                        padding-bottom: 5px;
                    }

                    h3 {
                        color: #333;
                        margin-top: 20px;
                        margin-bottom: 10px;
                    }

                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }

                    th,
                    td {
                        border: 1px solid black;
                        padding: 8px;
                        text-align: left;
                    }

                    th {
                        background-color: #f2f2f2;
                    }
                </style>
            </head>

            <body>
                <h2>Student Results and Attendance</h2>
                <h3>Result</h3>
                <table>
                    <tr>
                        <th>Subject</th>
                        <td>MAD</td>
                        <td>NodeJs</td>
                        <td>CN</td>
                        <td>Software Packages</td>
                        <td>Software Engi.</td>
                    </tr>
                    <tr>
                        <th>Result</th>
                        <td>
                            <?php echo $marksMAD; ?>
                        </td>
                        <td>
                            <?php echo $marksNodeJs; ?>
                        </td>
                        <td>
                            <?php echo $marksCN; ?>
                        </td>
                        <td>
                            <?php echo $marksSoftwarePackages; ?>
                        </td>
                        <td>
                            <?php echo $marksSoftwareEngi; ?>
                        </td>
                    </tr>
                </table>
                <h3>Attendance of Lab</h3>
                <table>
                    <tr>
                        <th>Subject</th>
                        <td>MAD</td>
                        <td>NodeJs</td>
                        <td>CN</td>
                        <td>Software Packages</td>
                        <td>Software Engi.</td>
                    </tr>
                    <tr>
                        <th>Attendance (%)</th>
                        <td>
                            <?php echo $labAttendanceMAD; ?>
                        </td>
                        <td>
                            <?php echo $labAttendanceNodeJs; ?>
                        </td>
                        <td>
                            <?php echo $labAttendanceCN; ?>
                        </td>
                        <td>
                            <?php echo $labAttendanceSoftwarePackages; ?>
                        </td>
                        <td>
                            <?php echo $labAttendanceSoftwareEngi; ?>
                        </td>
                    </tr>
                </table>
                <h3>Attendance of Lectures</h3>
                <table>
                    <tr>
                        <th>Subject</th>
                        <td>MAD</td>
                        <td>NodeJs</td>
                        <td>CN</td>
                        <td>Software Packages</td>
                        <td>Software Engi.</td>
                    </tr>
                    <tr>
                        <th>Attendance (%)</th>
                        <td>
                            <?php echo $lecAttendanceMAD; ?>
                        </td>
                        <td>
                            <?php echo $lecAttendanceNodeJs; ?>
                        </td>
                        <td>
                            <?php echo $lecAttendanceCN; ?>
                        </td>
                        <td>
                            <?php echo $lecAttendanceSoftwarePackages; ?>
                        </td>
                        <td>
                            <?php echo $lecAttendanceSoftwareEngi; ?>
                        </td>
                    </tr>
                </table><br><br>
            </body>

            </html>
            <?php
            // echo '<a href="' . $home_url . '/dashboard.php" class="btn btn-default">Back to Dashboard</a>';

            echo '</div></div></div></main>';

            // Footer
            include 'footer.php';

        } else {
            echo "User not found.";
        }

        $stmt->close();
    } catch (Exception $e) {
        // Handle exceptions, log errors, or display a user-friendly message
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid user ID.";
}

$conn->close();
?>
=======
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

if ($userID) {
    try {
        // Fetch detailed information for the selected user
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $userID);

        // Debugging SQL error
        if (!$stmt->execute()) {
            die('Error executing the query: ' . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            // Assign user details to individual variables
            $name = $user['name'];
            $first_name = $user['first_name'];
            $last_name = $user['last_name'];
            $email = $user['email'];
            $address = $user['address'];
            $phone = $user['phone_number'];
            $enrollmentNumber = $user['enrollment_number'];
            $accommodation = $user['accommodation'];
            $joinDate = $user['join_date'];
            $classBatch = $user['class_batch'];
            $currentDegree = $user['current_degree'];
            $currentSemester = $user['current_semester'];
            $marksMAD = $user['marks_mad'];
            $marksNodeJs = $user['marks_nodejs'];
            $marksCN = $user['marks_cn'];
            $marksSoftwarePackages = $user['marks_software_packages'];
            $marksSoftwareEngi = $user['marks_software_engi'];
            $labAttendanceMAD = $user['lab_attendance_mad'];
            $labAttendanceNodeJs = $user['lab_attendance_nodejs'];
            $labAttendanceCN = $user['lab_attendance_cn'];
            $labAttendanceSoftwarePackages = $user['lab_attendance_software_packages'];
            $labAttendanceSoftwareEngi = $user['lab_attendance_software_engi'];
            $lecAttendanceMAD = $user['lec_attendance_mad'];
            $lecAttendanceNodeJs = $user['lec_attendance_nodejs'];
            $lecAttendanceCN = $user['lec_attendance_cn'];
            $lecAttendanceSoftwarePackages = $user['lec_attendance_software_packages'];
            $lecAttendanceSoftwareEngi = $user['lec_attendance_software_engi'];

            // Display detailed information about the user
            include 'header.php';

            // Main Body
            echo '<main class="site-main dashboard-page admin-dash">';
            echo '<div class="site-content-inner">';
            echo '<div class="page-content-in">';

             // Page Heading
             echo '<div class="page-headings" style="background-image:url(\'assets/images/banner.jpg\');">';
             echo '    <div class="container">';
             echo '        <h2>'.$name.'</h2>';
             echo '        <div class="breadcrumb-list">';
             echo '            <ul>';
             
             // Dynamically change breadcrumb based on user role
             if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
                 echo '                <li><a href="' . $home_url . '/admin_dashboard.php">Admin Dashboard</a></li>';
             } else {
                 echo '                <li><a href="' . $home_url . '/student_dashboard.php">Student Dashboard</a></li>';
             }
 
             echo '                <li><span> / </span></li>';
             echo '                <li><a href="' . $home_url . '/view_details.php?id=' . $userID . '">Profile</a></li>';
             echo '            </ul>';
             echo '        </div>';
             echo '    </div>';
             echo '</div>';

            echo '<div class="container view-dashs">';

            // Display additional fields from the form using the HTML layout
            
            echo '<div class="inner-dash-details view-details-top">';
            echo '    <div class="rows heads-in-sub">';
            echo '        <div class="cols-50">';
            echo '            <h3>Student Profile</h3>';
            echo '        </div>';
            echo '    </div>';
            echo '    <div class="rows">';
            echo '        <div class="cols-50">';
            echo '            <div class="info-divs">';
            echo '                <h4>Student First Name</h4>';
            echo "                <p>{$first_name}</p>";
            echo '            </div>';
            echo '        </div>';
            echo '        <div class="cols-50">';
            echo '            <div class="info-divs">';
            echo '                <h4>Student Last Name</h4>';
            echo "                <p>{$last_name}</p>";
            echo '            </div>';
            echo '        </div>';
            echo '        <div class="cols-50">';
            echo '            <div class="info-divs">';
            echo '                <h4>Student Full Name</h4>';
            echo "                <p>{$name}</p>";
            echo '            </div>';
            echo '        </div>';
            echo '        <div class="cols-50">';
            echo '            <div class="info-divs">';
            echo '                <h4>Email</h4>';
            echo "                <p>{$email}</p>";
            echo '            </div>';
            echo '        </div>';
            echo '        <div class="cols-50">';
            echo '            <div class="info-divs">';
            echo '                <h4>Address</h4>';
            echo "                <p>{$address}</p>";
            echo '            </div>';
            echo '        </div>';
            echo '        <div class="cols-50">';
            echo '            <div class="info-divs">';
            echo '                <h4>Phone</h4>';
            echo "                <p>{$phone}</p>";
            echo '            </div>';
            echo '        </div>';
            echo '        <div class="cols-50">';
            echo '            <div class="info-divs">';
            echo '                <h4>Enrollment Number</h4>';
            echo "                <p>{$enrollmentNumber}</p>";
            echo '            </div>';
            echo '        </div>';
            echo '        <div class="cols-50">';
            echo '            <div class="info-divs">';
            echo '                <h4>Accommodation</h4>';
            echo "                <p>{$accommodation}</p>";
            echo '            </div>';
            echo '        </div>';
            echo '        <div class="cols-50">';
            echo '            <div class="info-divs">';
            echo '                <h4>Joining Date </h4>';
            echo "                <p>{$joinDate}</p>";
            echo '            </div>';
            echo '        </div>';
            echo '        <div class="cols-50">';
            echo '            <div class="info-divs">';
            echo '                <h4>Class & Batch</h4>';
            echo "                <p>{$classBatch}</p>";
            echo '            </div>';
            echo '        </div>';
            echo '        <div class="cols-50">';
            echo '            <div class="info-divs">';
            echo '                <h4>Current Semester</h4>';
            echo "                <p>{$currentSemester}</p>";
            echo '            </div>';
            echo '        </div>';
            echo '        <div class="cols-50">';
            echo '            <div class="info-divs">';
            echo '                <h4> Degree</h4>';
            echo "                <p>{$currentDegree}</p>";
            echo '            </div>';
            echo '        </div>';
            echo '    </div>';
            echo '</div>';
        

              // Display additional fields from the form using the HTML layout
              echo '<div class="inner-dash-details">';
              echo '    <div class="rows heads-in-sub">';
              echo '        <div class="cols-50">';
              echo '            <h3>Results</h3>';
              echo '        </div>';
              echo '    </div>';
              echo '    <div class="rows">';
              echo '        <div class="cols-50">';
              echo '            <div class="info-divs">';
              echo '                <h4>MAD</h4>';
              echo "                <p>{$marksMAD}</p>";
              echo '            </div>';
              echo '        </div>';
              echo '        <div class="cols-50">';
              echo '            <div class="info-divs">';
              echo '                <h4>NodeJs</h4>';
              echo "                <p>{$marksNodeJs}</p>";
              echo '            </div>';
              echo '        </div>';
              echo '        <div class="cols-50">';
              echo '            <div class="info-divs">';
              echo '                <h4>CN</h4>';
              echo "                <p>{$marksCN}</p>";
              echo '            </div>';
              echo '        </div>';
              echo '        <div class="cols-50">';
              echo '            <div class="info-divs">';
              echo '                <h4>Software Packages</h4>';
              echo "                <p>{$marksSoftwarePackages}</p>";
              echo '            </div>';
              echo '        </div>';
              echo '        <div class="cols-50">';
              echo '            <div class="info-divs">';
              echo '                <h4>Software Engi.</h4>';
              echo "                <p>{$marksSoftwareEngi}</p>";
              echo '            </div>';
              echo '        </div>';
              echo '    </div>';
              echo '</div>';

            // Display additional fields from the form using the HTML layout
            echo '<div class="inner-dash-details">';
            echo '    <div class="rows heads-in-sub">';
            echo '        <div class="cols-50">';
            echo '            <h3>Attendance of Lab</h3>';
            echo '        </div>';
            echo '    </div>';
            echo '    <div class="rows">';
            echo '        <div class="cols-50">';
            echo '            <div class="info-divs">';
            echo '                <h4>MAD</h4>';
            echo "                <p>{$labAttendanceMAD}</p>";
            echo '            </div>';
            echo '        </div>';
            echo '        <div class="cols-50">';
            echo '            <div class="info-divs">';
            echo '                <h4>NodeJs</h4>';
            echo "                <p>{$labAttendanceNodeJs}</p>";
            echo '            </div>';
            echo '        </div>';
            echo '        <div class="cols-50">';
            echo '            <div class="info-divs">';
            echo '                <h4>CN</h4>';
            echo "                <p>{$labAttendanceCN}</p>";
            echo '            </div>';
            echo '        </div>';
            echo '        <div class="cols-50">';
            echo '            <div class="info-divs">';
            echo '                <h4>Software Packages</h4>';
            echo "                <p>{$labAttendanceSoftwarePackages}</p>";
            echo '            </div>';
            echo '        </div>';
            echo '        <div class="cols-50">';
            echo '            <div class="info-divs">';
            echo '                <h4>Software Engi.</h4>';
            echo "                <p>{$labAttendanceSoftwareEngi}</p>";
            echo '            </div>';
            echo '        </div>';
            echo '    </div>';
            echo '</div>';

             // Display additional fields from the form using the HTML layout
             echo '<div class="inner-dash-details">';
             echo '    <div class="rows heads-in-sub">';
             echo '        <div class="cols-50">';
             echo '            <h3>Attendance of Lectures</h3>';
             echo '        </div>';
             echo '    </div>';
             echo '    <div class="rows">';
             echo '        <div class="cols-50">';
             echo '            <div class="info-divs">';
             echo '                <h4>MAD</h4>';
             echo "                <p>{$lecAttendanceMAD}</p>";
             echo '            </div>';
             echo '        </div>';
             echo '        <div class="cols-50">';
             echo '            <div class="info-divs">';
             echo '                <h4>NodeJs</h4>';
             echo "                <p>{$lecAttendanceNodeJs}</p>";
             echo '            </div>';
             echo '        </div>';
             echo '        <div class="cols-50">';
             echo '            <div class="info-divs">';
             echo '                <h4>CN</h4>';
             echo "                <p>{$lecAttendanceCN}</p>";
             echo '            </div>';
             echo '        </div>';
             echo '        <div class="cols-50">';
             echo '            <div class="info-divs">';
             echo '                <h4>Software Packages</h4>';
             echo "                <p>{$lecAttendanceSoftwarePackages}</p>";
             echo '            </div>';
             echo '        </div>';
             echo '        <div class="cols-50">';
             echo '            <div class="info-divs">';
             echo '                <h4>Software Engi.</h4>';
             echo "                <p>{$lecAttendanceSoftwareEngi}</p>";
             echo '            </div>';
             echo '        </div>';
             echo '    </div>';
             echo '</div>';

            // echo '<a href="' . $home_url . '/dashboard.php" class="btn btn-default">Back to Dashboard</a>';

            echo '</div></div></div></main>';

            // Footer
            include 'footer.php';

        } else {
            echo "User not found.";
        }

        $stmt->close();
    } catch (Exception $e) {
        // Handle exceptions, log errors, or display a user-friendly message
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid user ID.";
}

$conn->close();
?>
>>>>>>> e5dca82098161009b1522064f6fa03d9caaf3ef0
