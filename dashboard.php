<?php
session_start();
include 'db_config.php';

// Check if the user is not logged in, redirect them to the login page
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch user details from the database
$userId = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT first_name, last_name,  name, email, address, phone_number, enrollment_number, accommodation, join_date, class_batch, current_degree, current_semester, marks_mad, marks_nodejs, marks_cn, marks_software_packages, marks_software_engi, lab_attendance_mad, lab_attendance_nodejs, lab_attendance_cn, lab_attendance_software_packages, lab_attendance_software_engi, lec_attendance_mad, lec_attendance_nodejs, lec_attendance_cn, lec_attendance_software_packages, lec_attendance_software_engi FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($first_name, $last_name, $userName, $userEmail, $userAddress, $userPhone, $enrollment_number, $accommodation, $join_date, $class_batch, $current_degree, $current_semester, $marks_mad, $marks_nodejs, $marks_cn, $marks_software_packages, $marks_software_engi, $lab_attendance_mad, $lab_attendance_nodejs, $lab_attendance_cn, $lab_attendance_software_packages, $lab_attendance_software_engi, $lec_attendance_mad, $lec_attendance_nodejs, $lec_attendance_cn, $lec_attendance_software_packages, $lec_attendance_software_engi);
$stmt->fetch();
$stmt->close();
?>
<?php include 'header.php'; ?>

<!-- Main Body is here -->
<main class="site-main dashboard-page">
    <div class="site-content-inner">
        <div class="page-headings" style="background-image:url('assets/images/dashboard.jpg');">
            <div class="container">
                <h2>Dashboard</h2>
                <div class="breadcrumb-list">
                    <ul>
                        <li><a href="<?php echo $home_url; ?>">Home</a></li>
                        <li><span> / </span></li>
                        <li><a href="<?php echo $home_url; ?>/dashboard.php">Dashboard</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="page-content-in">
            <div class="dashboard-sidebar">
                <!-- Sidebar List -->
                <div class="sidebar-main">
                    <div class="side-inner">
                        <ul class="tabing-list">
                            <li class="tab-items" onclick="toggleTab('myprofile')"><img src="assets/images/user.png"><span>My Profile</span></li>
                            <li class="tab-items" onclick="toggleTab('results_data')"><img src="assets/images/results.png"><span>Results</span></li>
                            <li class="tab-items" onclick="toggleTab('attendance_data')"><img src="assets/images/attendance.png"><span>Attendance Details</span></li>
                            <li class="tab-items" onclick="toggleTab('teachers_data')"><img src="assets/images/training.png"><span>Teacher Details</span></li>
                            <li class="tab-items" onclick="toggleTab('materials_data')"><img src="assets/images/books.png"><span>Study Materials</span></li>
                            <li class="tab-items" id="logouts-links"><img src="assets/images/turn-off.png"><a href="<?php echo $home_url; ?>/logout.php"><span>Log Out</span></a></li>
                        </ul>
                    </div>
                </div>

                <!-- Sidebar Content -->
                <div class="site-content">
                    <div class="site-con-inner">
                        <div class="student-infos">
                            
                            <div class="tab-contents" id="myprofile">

                                <div class="subs-heads">
                                    <h2>My Profile</h2>
                                </div>

                                <div class="inner-dash-details">
                                    <div class="rows">
                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>First Name</h4>
                                                <p><?php echo $first_name; ?></p>
                                            </div>
                                        </div>
                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>Last Name</h4>
                                                <p><?php echo $last_name; ?></p>
                                            </div>
                                        </div>
                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>Full Name</h4>
                                                <p><?php echo $userName; ?></p>
                                            </div>
                                        </div>
                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>Email</h4>
                                                <p><?php echo $userEmail; ?></p>
                                            </div>
                                        </div>
                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>Address</h4>
                                                <p><?php echo $userAddress; ?></p>
                                            </div>
                                        </div>
                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>Phone Number</h4>
                                                <p><?php echo $userPhone; ?></p>
                                            </div>
                                        </div>
                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>Enrollment Number</h4>
                                                <p><?php echo $enrollment_number; ?></p>
                                            </div>
                                        </div>

                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>Accommodation</h4>
                                                <p><?php echo $accommodation; ?></p>
                                            </div>
                                        </div>

                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>Joining Date</h4>
                                                <p><?php echo $join_date; ?></p>
                                            </div>
                                        </div>

                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>Class & Batch</h4>
                                                <p><?php echo $class_batch; ?></p>
                                            </div>
                                        </div>

                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>Degree</h4>
                                                <p><?php echo $current_degree; ?></p>
                                            </div>
                                        </div>

                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>Current Semester</h4>
                                                <p><?php echo $current_semester; ?></p>
                                            </div>
                                        </div>
                                   
                                        
                                    </div>
                                </div>

                            </div>
                            
                            <div class="tab-contents" id="results_data">

                                <div class="subs-heads">
                                    <h2>Results</h2>
                                </div>

                                <div class="inner-dash-details">
                                    <div class="rows">
                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>MAD</h4>
                                                <p><?php echo $marks_mad; ?></p>
                                            </div>
                                        </div>

                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>NodeJs</h4>
                                                <p><?php echo $marks_nodejs; ?></p>
                                            </div>
                                        </div>
                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>Computer Network</h4>
                                                <p><?php echo $marks_cn; ?></p>
                                            </div>
                                        </div>
                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>Software Packages</h4>
                                                <p><?php echo $marks_software_packages; ?></p>
                                            </div>
                                        </div>
                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>Software Engi.</h4>
                                                <p><?php echo $marks_software_engi; ?></p>
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                                
                            </div>

                            <div class="tab-contents" id="attendance_data">

                                <div class="subs-heads">
                                    <h2>Attendance Details</h2>
                                </div>

                                <div class="inner-dash-details">
                                    <div class="rows heads-in-sub">                        
                                        <div class="cols-50">
                                            <h3>Attendance of Lab</h3>
                                        </div>
                                    </div>
                                    <div class="rows">

                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>MAD</h4>
                                                <p><?php echo $lab_attendance_mad; ?></p>
                                            </div>
                                        </div>

                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>NodeJs</h4>
                                                <p><?php echo $lab_attendance_nodejs; ?></p>
                                            </div>
                                        </div>

                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>CN</h4>
                                                <p><?php echo $lab_attendance_cn; ?></p>
                                            </div>
                                        </div>

                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>Software Packages</h4>
                                                <p><?php echo $lab_attendance_software_packages; ?></p>
                                            </div>
                                        </div>

                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>Software Engi.</h4>
                                                <p><?php echo $lab_attendance_software_engi; ?></p>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <div class="inner-dash-details">
                                    <div class="rows heads-in-sub">                        
                                        <div class="cols-50">
                                            <h3>Attendance of Lectures</h3>
                                        </div>
                                    </div>
                                    <div class="rows">                        
                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>MAD</h4>
                                                <p><?php echo $lec_attendance_mad; ?></p>
                                            </div>
                                        </div>

                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>NodeJs</h4>
                                                <p><?php echo $lec_attendance_nodejs; ?></p>
                                            </div>
                                        </div>

                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>CN</h4>
                                                <p><?php echo $lec_attendance_cn; ?></p>
                                            </div>
                                        </div>

                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>Software Packages</h4>
                                                <p><?php echo $lec_attendance_software_packages; ?></p>
                                            </div>
                                        </div>

                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>Software Engi.</h4>
                                                <p><?php echo $lec_attendance_software_engi; ?></p>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                            </div>

                            <div class="tab-contents" id="teachers_data">

                                <div class="subs-heads">
                                    <h2>Teachers Details</h2>
                                </div>

                                <div class="inner-dash-details">
                                    <div class="rows heads-in-sub">                        
                                        <div class="cols-50">
                                            <h3>Teacher - Rio Roy</h3>
                                        </div>
                                    </div>
                                    <div class="rows">

                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>Full Name</h4>
                                                <p>Rio Roykumar Patel</p>
                                            </div>
                                        </div>
                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>Subject</h4>
                                                <p>Computer Networks</p>
                                            </div>
                                        </div>

                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>Phone</h4>
                                                <p>097812878</p>
                                            </div>
                                        </div>

                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>Email</h4>
                                                <p>xyz@gmail.com</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="inner-dash-details">
                                    <div class="rows heads-in-sub">                        
                                        <div class="cols-50">
                                            <h3>Teacher - Pankaj Trivedi</h3>
                                        </div>
                                    </div>
                                    <div class="rows">

                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>Full Name</h4>
                                                <p>Pankaj Praksh Patel</p>
                                            </div>
                                        </div>
                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>Subject</h4>
                                                <p>Computer Networks</p>
                                            </div>
                                        </div>

                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>Phone</h4>
                                                <p>02356745878</p>
                                            </div>
                                        </div>

                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>Email</h4>
                                                <p>dy@gmail.com</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="tab-contents" id="materials_data">

                                <div class="subs-heads">
                                    <h2>Study Materials</h2>
                                </div>

                                <div class="inner-dash-details">
                                    <div class="rows heads-in-sub">                        
                                        <div class="cols-50">
                                            <h3>Access - Materials</h3>
                                        </div>
                                    </div>
                                    <div class="rows">

                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>MAD</h4>
                                                <p><a href="https://drive.google.com/file/d/1IaPfIUBPVuPMZwIAWtHy4RTGcxiyZbPi/view?usp=drive_link" target="_blank">Click Here</a></p>
                                            </div>
                                        </div>
                                       
                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>NodeJs</h4>
                                                <p><a href="https://drive.google.com/file/d/1IaPfIUBPVuPMZwIAWtHy4RTGcxiyZbPi/view?usp=drive_link" target="_blank">Click Here</a></p>
                                            </div>
                                        </div>

                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>Software Engi.</h4>
                                                <p><a href="https://drive.google.com/file/d/1IaPfIUBPVuPMZwIAWtHy4RTGcxiyZbPi/view?usp=drive_link" target="_blank">Click Here</a></p>
                                            </div>
                                        </div>

                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>Software Packages</h4>
                                                <p><a href="https://drive.google.com/file/d/1IaPfIUBPVuPMZwIAWtHy4RTGcxiyZbPi/view?usp=drive_link" target="_blank">Click Here</a></p>
                                            </div>
                                        </div>

                                        <div class="cols-50">
                                            <div class="info-divs">
                                                <h4>Computer Networks</h4>
                                                <p><a href="https://drive.google.com/file/d/1IaPfIUBPVuPMZwIAWtHy4RTGcxiyZbPi/view?usp=drive_link" target="_blank">Click Here</a></p>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Footer is here -->
<?php include 'footer.php'; ?>
