<?php


$event_title = "";
$event_description = "";
$event_date = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if update button is clicked
    if (isset($_POST["update-event"]) && isset($_POST["event-id"])) {
        $event_id = $_POST["event-id"];
        $event_title = $_POST["event-title"];
        $event_description = $_POST["event-description"];
        $event_date = $_POST["event-date"];

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

        // Update event in the database
        $sql = "UPDATE events SET event_title = ?, event_description = ?, event_date = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $event_title, $event_description, $event_date, $event_id);
        $stmt->execute();

        $stmt->close();
        $conn->close();

        // Redirect back to index.php after updating
        header("Location: event_add.php");
        exit();
    } elseif (isset($_POST["event-id"])) {
        // Fetch event details if form is not submitted
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

        // Fetch event details
        $sql = "SELECT * FROM events WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $event_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $event_title = $row["event_title"];
            $event_description = $row["event_description"];
            $event_date = $row["event_date"];
        } else {
            echo "Event not found";
            exit();
        }

        $stmt->close();
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-image: url('./assets/images/eventbag.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .event-form {
            margin-bottom: 20px;
        }

        .event-form input[type="text"],
        .event-form input[type="date"],
        .event-form button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .event-form input[type="text"]:focus,
        .event-form input[type="date"]:focus,
        .event-form button:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        #update-event {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #update-event:hover {
            background-color: #0056b3;
        }

        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Edit Event</h1>
        <div class="event-form">
            <form method="post" action="">
                <input type="hidden" name="event-id"
                    value="<?php echo isset($_POST["event-id"]) ? $_POST["event-id"] : ''; ?>">
                <input type="text" name="event-title" value="<?php echo $event_title; ?>" placeholder="Event Title"
                    required>
                <input type="text" name="event-description" value="<?php echo $event_description; ?>"
                    placeholder="Event Description" required>
                <input type="date" name="event-date" value="<?php echo $event_date; ?>" required>
                <?php if (isset($_POST["event-id"])): ?>
                    <button type="submit" name="update-event" id="update-event">Update Event</button>
                <?php else: ?>
                    <button type="submit" name="edit-event" id="edit-event">Edit Event</button>
                <?php endif; ?>
            </form>
        </div>
        <a href="register.php">Back to Events</a>
    </div>
</body>

</html>