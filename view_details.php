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
            // Display detailed information about the user
            include 'header.php';

            // Main Body
            echo '<main class="site-main dashboard-page admin-dash">';
            echo '<div class="site-content-inner">';
            echo '<div class="page-content-in">';
            echo '<div class="container">';

            // Display detailed user information here
            echo "<h2>{$user['name']}'s Details</h2>";
            echo "<p>Email: {$user['email']}</p>";
            echo "<p>Address: {$user['address']}</p>";
            // Add more fields as needed

            // Display other relevant information
            echo "<p>Enrollment Number: {$user['enrollment_number']}</p>";
            echo "<p>Accommodation: {$user['accommodation']}</p>";
            // Add more fields as needed

            echo '<a href="' . $home_url . '/dashboard.php">Back to Dashboard</a>';

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
