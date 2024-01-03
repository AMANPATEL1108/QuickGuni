<?php
include 'db_config.php';

session_start();

// Check if the user is an admin
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    include 'header.php';
    ?>

    <!-- Access Denied Message -->
    <main class="site-main">
        <div class="site-content-inner">
            <div class="page-headings"  style="background-image:url('assets/images/banner.jpg');">
                <div class="container">
                    <h2>Access Denied</h2>
                </div>
            </div>

            <div class="page-content-in">
                <div class="container">
                    <div class="regi-page-con-in">
                        <p>Access denied. Only administrators can access this page.</p>
                        <a href="<?php echo $home_url; ?>" class="btn btn-default">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php
    include 'footer.php';
    exit; // Stop further execution
}

// The rest of your existing code for the registration form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Admin is filling out the registration form for the user verbally
    // Display form fields for admin to fill
    // ...

} else {
    // Normal user registration form
    include 'header.php';
    ?>


    <!-- Main Body is here -->
    <main class="site-main">
        <div class="site-content-inner">
            <div class="page-headings"  style="background-image:url('assets/images/banner.jpg');">
                <div class="container">
                    <h2>Registration</h2>
                    <div class="breadcrumb-list">
                        <ul>
                            <li><a href="<?php echo $home_url; ?>">Home</a> </li>
                            <li><span> / </span></li>
                            <li><a href="<?php echo $home_url; ?>/register.php">Registration</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="page-content-in regi-page-con">
                <div class="container">
                    <div class="regi-page-con-in">
                        <h2>Join Our Community</h2>
                        <p>Embark on a seamless journey with us by completing the registration form below. By registering, you gain access to a host of exclusive benefits and personalized experiences tailored just for you.</p>
                    </div>

                    <div class="regi-form">
                        <form action="process_form.php" method="post">

                            <!-- Personal Details -->
                            <div class="rows head-rows">
                                <div class="cols-50">
                                   <h3>Personal Details</h3>
                                </div> 
                            </div>

                            <div class="rows">
                                <div class="cols-50">
                                    <label for="name">Name:</label>
                                    <input type="text" name="name" required>
                                </div> 
                                <div class="cols-50">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email"  required>
                                    <div id="email-validation-message"></div>

                                </div> 
                            </div> 
                            <div class="rows">
                                <div class="cols-50">
                                    <label for="password">Password:</label>
                                     <input type="password" name="password" required>
                                </div> 
                                <div class="cols-50">
                                    <label for="address">Address:</label>
                                     <input type="text" name="address" required>
                                </div> 
                            </div>

                            <div class="rows">
                                <div class="cols-50">
                                     <label for="phone_number">Phone Number:</label>
                                     <input type="text" name="phone_number">
                                </div> 
                                <div class="cols-50">
                                     <label for="enrollment_number">Enrollment Number:</label>
                                    <input type="text" name="enrollment_number" required>
                                </div> 
                            </div>

                            <div class="rows">
                                <div class="cols-50">
                                     <label for="join_date">Joining Date:</label>
                                     <input type="date" name="join_date" required>
                                </div> 
                                <div class="cols-50">
                                     <label for="class_batch">Class / Batch: (Ex:- B-B1)</label>
                                    <input type="text" name="class_batch" required>
                                </div> 
                            </div>
                            
                            <div class="rows">
                                <div class="cols-50">
                                     <label for="current_degree">Degree:</label>
                                     <input type="text" name="current_degree">
                                </div> 
                                <div class="cols-50">
                                    
                                </div> 
                            </div>

                            <div class="rows radio-rows"> 
                                <label><strong>Hosteller or Traveller:</strong></label>
                                <label class="radio-label"><input type="radio" name="accommodation" value="hosteller" required> Hosteller</label>
                                <label class="radio-label"><input type="radio" name="accommodation" value="traveller" required> Traveller</label>
                            </div>

                            <div class="rows head-rows">
                                <div class="cols-50">
                                   <h3>Education Details</h3>
                                </div> 
                            </div>

                            <div class="rows">
                                <div class="cols-50">
                                    <label for="current_semester">Current Semester Name:</label>
                                    <input type="text" name="current_semester" required>
                                </div> 
                                <div class="cols-50">
                                    <label for="marks_mad">Marks of MAD:</label>
                                    <input type="number" name="marks_mad" required>
                                </div> 
                            </div>

                            <div class="rows">
                                <div class="cols-50">
                                    <label for="marks_nodejs">Marks of NodeJs:</label>
                                    <input type="number" name="marks_nodejs" required>
                                </div> 
                                <div class="cols-50">
                                    <label for="marks_cn">Marks of CN:</label>
                                    <input type="number" name="marks_cn" required>
                                </div> 
                            </div>


                            <div class="rows">
                                <div class="cols-50">
                                    <label for="marks_software_packages">Marks of Software Packages:</label>
                                    <input type="number" name="marks_software_packages" required>
                                </div> 
                                <div class="cols-50">
                                    <label for="marks_software_engi">Marks of Software Engi.:</label>
                                    <input type="number" name="marks_software_engi" required>
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
                                    <input type="number" name="lab_attendance_mad" required>
                                </div> 
                            </div>

                            <div class="rows">
                                <div class="cols-50">
                                    <label for="lab_attendance_nodejs">Lab Attendance of NodeJs (Percentage):</label>
                                    <input type="number" name="lab_attendance_nodejs" required>
                                </div> 
                                <div class="cols-50">
                                    <label for="lab_attendance_cn">Lab Attendance of CN (Percentage):</label>
                                    <input type="number" name="lab_attendance_cn" required>
                                </div> 
                            </div>

                            <div class="rows">
                                <div class="cols-50">
                                    <label for="lab_attendance_software_packages">Lab Attendance of Software Packages (Percentage):</label>
                                    <input type="number" name="lab_attendance_software_packages" required>
                                </div> 
                                <div class="cols-50">
                                    <label for="lab_attendance_software_engi">Lab Attendance of Software Engi. (Percentage):</label>
                                    <input type="number" name="lab_attendance_software_engi" required>
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
                                    <input type="number" name="lec_attendance_mad" required>
                                </div> 
                            </div>
                
                            <div class="rows">
                                <div class="cols-50">
                                    <label for="lec_attendance_nodejs">Attendance of NodeJs (Percentage):</label>
                                    <input type="number" name="lec_attendance_nodejs" required>
                                </div> 
                                <div class="cols-50">
                                    <label for="lec_attendance_cn">Attendance of CN (Percentage):</label>
                                    <input type="number" name="lec_attendance_cn" required>
                                </div> 
                            </div>
                         
                            <div class="rows">
                                <div class="cols-50">
                                    <label for="lec_attendance_software_packages">Attendance of Software Packages (Percentage):</label>
                                    <input type="number" name="lec_attendance_software_packages" required>
                                </div> 
                                <div class="cols-50">
                                    <label for="lec_attendance_software_engi">Attendance of Software Engi. (Percentage):</label>
                                    <input type="number" name="lec_attendance_software_engi" required>
                                </div> 
                            </div>

                            <div class="rows submt-rows">
                            <input type="hidden" id="email-validation-result" name="email_validation_result" value="">

                                 <input type="submit" value="Submit">
                            </div>
            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php
    include 'footer.php';
}
?>
