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
    // Validate and update user details in the database
    // ...

    // Redirect back to the admin dashboard after updating
    header('Location: admin_dashboard.php');
    exit;
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

                        <div class="container">
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
                                        <label for="password">Password:</label>
                                        <input type="password" name="password" required>
                                    </div>
                                    <div class="cols-50">
                                        <label for="address">Address:</label>
                                        <input type="text" name="address" value="<?php echo $user['address']; ?>" required>
                                    </div>
                                </div>

                                <div class="rows">
                                    <div class="cols-50">
                                        <label for="phone_number">Phone Number:</label>
                                        <input type="text" name="phone_number" value="<?php echo $user['phone_number']; ?>">
                                    </div>
                                    <div class="cols-50">
                                        <label for="enrollment_number">Enrollment Number:</label>
                                        <input type="text" name="enrollment_number" value="<?php echo $user['enrollment_number']; ?>" required>
                                    </div>
                                </div>

                                <!-- Add other fields using the same structure -->

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

                                <!-- Add other fields using the same structure -->

                                <div class="rows submt-rows">
                                    <input type="submit" value="Update">
                                </div>

                            </form>

                            <a href="<?php echo $home_url; ?>/admin_dashboard.php">Back to Dashboard</a>
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
