<?php
include 'db_config.php';

// Check if the email is already registered
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];

    $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        echo '<span style="color: red;">Email is already registered.</span>';
    } else {
        echo '<span style="color: green;">Email is valid.</span>';
    }
}

$conn->close();
?>
