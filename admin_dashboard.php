<?php
session_start();
include 'db_config.php';

// Check if the user is not logged in or is not an admin, redirect them to the login page
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: login.php');
    exit;
}

// Process search query
$searchQuery = isset($_GET['search_query']) ? trim($_GET['search_query']) : '';

try {
    // Prepare the SQL query with placeholders for safe binding
    $sql = "SELECT id, name, enrollment_number, current_degree FROM users";
    if ($searchQuery) {
        $sql .= " WHERE name LIKE ? OR enrollment_number LIKE ? OR current_degree LIKE ?";
    }

    $stmt = $conn->prepare($sql);

    // Bind the search query parameters
    if ($searchQuery) {
        $likeQuery = "%$searchQuery%";
        $stmt->bind_param('sss', $likeQuery, $likeQuery, $likeQuery);
    }

    $stmt->execute();
    $stmt->bind_result($id, $name, $enrollment_number, $current_degree);

    // Store the filtered results in an array
    $limitedDetails = [];
    while ($stmt->fetch()) {
        $limitedDetails[] = [
            'id' => $id,
            'name' => htmlspecialchars($name),
            'enrollment_number' => htmlspecialchars($enrollment_number),
            'current_degree' => htmlspecialchars($current_degree),
        ];
    }

    $stmt->close();
} catch (Exception $e) {
    // Handle exceptions, log errors, or display a user-friendly message
    error_log("Error: " . $e->getMessage());
    echo "An error occurred while processing your request. Please try again later.";
}

$conn->close();
?>
<?php include 'header.php'; ?>
<main class="site-main dashboard-page admin-dash">
    <div class="site-content-inner">
        <div class="page-headings" style="background-image:url('assets/images/dashboard.jpg');">
            <div class="container">
                <h2>Dashboard</h2>
                <div class="breadcrumb-list">
                    <ul class="navigation">
                        <li><a href="<?php echo $home_url; ?>/dashboard.php">Admin Dashboard</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <a href="register.php" class="registration-button">Registration</a><br><br>
        <style>
            .registration-button {
                margin-top: 40px;
                margin-left: 18%;
                display: inline-block;
                padding: 10px 20px;
                background-color: #007bff;
                color: #fff;
                text-decoration: none;
                border-radius: 5px;
                transition: background-color 0.3s ease;
            }

            .registration-button:hover {
                background-color: #0056b3;
            }

            /* Style for search input */
            .page-content-in form input[type="text"] {
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                margin-right: 10px;
            }

            /* Style for search button */
            .page-content-in form button[type="submit"] {
                padding: 10px 20px;
                background-color: #007bff;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            /* Style for download button */
            .page-content-in .download-button {
                display: inline-block;
                padding: 10px 20px;
                background-color: #007bff;
                color: #fff;
                text-decoration: none;
                border-radius: 5px;
                margin-top: 10px;
                cursor: pointer;
            }

            /* Hover effect for buttons */
            .page-content-in form button[type="submit"]:hover,
            .page-content-in .download-button:hover {
                background-color: #0056b3;
            }

            /* Additional styles for table */
            .page-content-in .display {
                /* Add your table styles here */
            }
        </style>
        <div class="page-content-in">
            <div class="dashboard-sidebar">
                <div class="container-full" style="overflow-x: auto;">
                    <form method="GET" action="">
                        <input type="text" name="search_query" placeholder="Search..."
                            value="<?php echo htmlspecialchars($searchQuery); ?>">
                        <button type="submit">Search</button>
                    </form>
                    <a href="download_data.php?search_query=<?php echo urlencode($searchQuery); ?>"
                        class="download-button">Download Filtered Data</a><br><br>
                    <table id="example" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Enrollment Number</th>
                                <th>Degree</th>
                                <th>Details</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                <th>Change Password</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($limitedDetails as $user) { ?>
                                <tr>
                                    <td><?php echo $user['id']; ?></td>
                                    <td><?php echo $user['name']; ?></td>
                                    <td><?php echo $user['enrollment_number']; ?></td>
                                    <td><?php echo $user['current_degree']; ?></td>
                                    <td><a href="view_details.php?id=<?php echo $user['id']; ?>">View Details</a></td>
                                    <td><a href="edit_user.php?id=<?php echo $user['id']; ?>">Edit</a></td>
                                    <td><a href="delete_user.php?id=<?php echo $user['id']; ?>">Delete</a></td>
                                    <td><a href="change_password.php?id=<?php echo $user['id']; ?>">Change Password</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Footer is here -->
<?php include 'footer.php'; ?>