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
            'name' => htmlspecialchars($name),
            'enrollment_number' => htmlspecialchars($enrollment_number),
            'current_degree' => htmlspecialchars($current_degree),
        ];
    }

    $stmt->close();
    $conn->close();

    // Start output buffering
    ob_start();

    // Export only the filtered data to Excel
    header("Content-Disposition: attachment; filename=\"filtered_data.xls\"");
    header("Content-Type: application/vnd.ms-excel");
    header("Pragma: no-cache");
    header("Expires: 0");

    // Print column headers
    echo "Name\tEnrollment Number\tDegree\r\n";

    // Print data rows
    foreach ($limitedDetails as $row) {
        echo $row['name'] . "\t" . $row['enrollment_number'] . "\t" . $row['current_degree'] . "\r\n";
    }

    // Flush the output buffer
    ob_end_flush();
    exit;

} catch (Exception $e) {
    // Handle exceptions, log errors, or display a user-friendly message
    error_log("Error: " . $e->getMessage());
    echo "An error occurred while processing your request. Please try again later.";
}
?>