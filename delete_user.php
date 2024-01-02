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
    // Delete user from the database
    // ...

    // Redirect back to the admin dashboard after deletion
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
            // Display the delete confirmation form
            include 'header.php';
            ?>

            <!-- Main Body is here -->
            <main class="site-main dashboard-page admin-dash">
                <div class="site-content-inner">
                    <div class="page-content-in">
                        <div class="container">
                            <!-- Display confirmation form for deleting the user -->
                            <h2>Delete User: <?php echo $user['name']; ?></h2>
                            <p>Are you sure you want to delete this user?</p>

                            <!-- Add a confirmation form to delete the user -->
                            <form action="delete_user.php?id=<?php echo $userID; ?>" method="post">
                                <input type="submit" value="Yes, Delete">
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
