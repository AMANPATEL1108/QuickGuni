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
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            // Display detailed information about the user
            ?>

            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>User Details</title>
            </head>
            <body>

            <?php include 'header.php'; ?>

            <!-- Main Body is here -->
            <main class="site-main dashboard-page admin-dash">
                <div class="site-content-inner">
                    <div class="page-content-in">
                        <div class="container">
                            <!-- Display detailed user information here -->
                            <h2><?php echo $user['name']; ?>'s Details</h2>

                            <table border="1">
                                <?php
                                // Loop through all columns and display their names and values in a table
                                foreach ($user as $column => $value) {
                                    echo "<tr><td>{$column}</td><td>{$value}</td></tr>";
                                }
                                ?>
                            </table>

                            <a href="<?php echo $home_url; ?>/dashboard.php">Back to Dashboard</a>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Footer is here -->
            <?php include 'footer.php'; ?>

            </body>
            </html>

            <?php
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
