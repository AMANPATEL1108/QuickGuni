<?php
session_start();

include 'db_config.php';

// Check if the user is not logged in or is not an admin, redirect them to the login page
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: login.php');
    exit;
}

// Check if the user ID is provided in the URL
if (isset($_GET['id'])) {
    $userID = $_GET['id'];
} else {
    // If user ID is not provided, redirect back to admin dashboard
    header('Location: admin_dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission to change password

    // Validate and sanitize input data
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the new password

    // Update user's password in the database
    try {
        $stmt = $conn->prepare("UPDATE users SET password=? WHERE id=?");
        $stmt->bind_param("si", $password, $userID);

        // Execute the statement
        $stmt->execute();

        // Check if the update was successful
        if ($stmt->affected_rows > 0) {
            // Redirect back to the admin dashboard after updating
            header('Location: admin_dashboard.php');
            exit;
        } else {
            echo "Password update failed.";
        }

        $stmt->close();
    } catch (Exception $e) {
        // Handle exceptions, log errors, or display a user-friendly message
        echo "Error: " . $e->getMessage();
    }
}

// Fetch user details for the given ID
try {
    $stmt = $conn->prepare("SELECT name FROM users WHERE id = ?");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        // Display the change password form
        include 'header.php';
        ?>

        <!-- Main Body is here -->
        <main class="site-main change-password-page">
            <div class="site-content-inner">
                <div class="containersss">
                <div class="page-headings" style="background-image:url('assets/images/dashboard.jpg');">
                        <h2>Change Password for <?php echo $user['name']; ?></h2>
                        <div class="breadcrumb-list">
                            <ul>
                                <li><a href="<?php echo $home_url; ?>">Home</a></li>
                                <li><span> / </span></li>
                                <li><a href="<?php echo $home_url; ?>/admin_dashboard.php">Admin Dashboard</a></li>
                                <li><span> / </span></li>
                                <li>Change Password</li>
                            </ul>
                        </div>
                    </div>

                    <div class="container change-password-form">
                        <!-- Add an HTML form with input fields to change the user's password -->
                        <div class="dashin-back">
                             <div class="delete-userbox">
                                <h4>Change Password</h4>
                                <form action="change_password.php?id=<?php echo $userID; ?>" method="post">
                                    <div class="rows">
                                        <div class="cols-50">
                                            <label for="password">New Password:</label>
                                            <input type="password" name="password" required>
                                        </div>
                                    </div>

                                    <div class="rows">
                                        <div class="cols-50">
                                            <label for="confirm_password">Confirm Password:</label>
                                            <input type="password" name="confirm_password" required>
                                        </div>
                                    </div>

                                    <div class="rows submt-rows">
                                        <input type="submit" value="Change Password">
                                    </div>
                                </form>
                            </div>
                        </div>
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
?>
