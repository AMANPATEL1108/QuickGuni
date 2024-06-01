<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["event-id"])) {
    $event_id = $_POST["event-id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "quickguni";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Delete the event
    $sql = "DELETE FROM events WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();

    $stmt->close();
    $conn->close();


    header("Location: event_add.php");
    exit();
} else {
    echo "Invalid request";
    exit();
}
?>