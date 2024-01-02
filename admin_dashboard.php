<?php
session_start();

include 'db_config.php';

// Check if the user is not logged in or is not an admin, redirect them to the login page
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: login.php');
    exit;
}

try {
    // Fetch limited registration details from the database
    $stmt = $conn->prepare("SELECT id, name, enrollment_number, current_degree FROM users");
    $stmt->execute();
    $stmt->bind_result($id, $name, $enrollment_number, $current_degree);

    // Store the results in an array
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
    echo "Error: " . $e->getMessage();
}

$conn->close();
?>

<?php include 'header.php'; ?>

<!-- Main Body is here -->
<main class="site-main dashboard-page admin-dash">
    <div class="site-content-inner">
        <div class="page-headings" style="background-image:url('assets/images/dashboard.jpg');">
            <div class="container">
                <h2>Dashboard</h2>
                <div class="breadcrumb-list">
                    <ul>
                        <li><a href="<?php echo $home_url; ?>">Home</a></li>
                        <li><span> / </span></li>
                        <li><a href="<?php echo $home_url; ?>/dashboard.php">Admin Dashboard</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="page-content-in">
            <div class="dashboard-sidebar">
                <div class="container-full" style="overflow-x: auto;">
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
