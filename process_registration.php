<?php
include 'db_config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Make sure to hash the password
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    // Hash the password (use a strong hashing algorithm, e.g., bcrypt)
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, address, phone_number) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $hashedPassword, $address, $phone);

    if ($stmt->execute()) {
        // Registration successful
        echo "Registration successful. You can now login.";
        // Redirect to login page or show a login link
    } else {
        // Registration failed
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
