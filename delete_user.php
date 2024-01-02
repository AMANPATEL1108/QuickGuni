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
    // Handle form submission to delete user

    try {
        // Delete user from the database
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $userID);
        $stmt->execute();

        // Check if the deletion was successful
        if ($stmt->affected_rows > 0) {
            // Redirect back to the admin dashboard after deletion
            header('Location: admin_dashboard.php');
            exit;
        } else {
            echo "Deletion failed.";
        }

        $stmt->close();
    } catch (Exception $e) {
        // Handle exceptions, log errors, or display a user-friendly message
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <!-- Add your stylesheets, scripts, or other head elements here -->
</head>
<body>

    <!-- Header is here -->
    <?php include 'header.php'; ?>

    <!-- Main Body is here -->
    <main class="site-main dashboard-page admin-dash">
        <div class="site-content-inner">
            <div class="page-content-in">
                <div class="page-headings" style="background-image:url('assets/images/banner.jpg');">
                    <div class="container">
                        <h2>Delete User</h2>
                        <!-- Add breadcrumb or other navigation elements here -->
                    </div>
                </div>

                <div class="container">
                    <div class="dashin-back">
                        <div class="delete-userbox">
                            
                            <!-- Display confirmation form for deleting the user -->
                            <h2>Delete User</h2>
                            <p>Are you sure you want to delete this user?</p>

                            <!-- Add a confirmation form to delete the user -->
                            <form action="delete_user.php?id=<?php echo $userID; ?>" method="post">
                                <input type="submit" value="Yes, Delete">
                            </form>

                            <a href="admin_dashboard.php"><< No, Back to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer is here -->
    <?php include 'footer.php'; ?>

    <!-- Add your scripts or other body elements here -->
</body>
</html>
