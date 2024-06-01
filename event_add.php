<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event</title>
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

        #add-event {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #add-event:hover {
            background-color: #0056b3;
        }

        .event-list {
            border-top: 2px solid #007bff;
            padding-top: 20px;
        }

        .event-list h2 {
            color: #333;
            margin-bottom: 10px;
        }

        #events-list {
            list-style-type: none;
            padding: 0;
        }

        #events-list li {
            background-color: #f5f5f5;
            padding: 10px;
            margin-bottom: 5px;
            border-radius: 5px;
        }

        .event-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 5px;
        }

        .edit-button,
        .delete-button {
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            border-radius: 3px;
        }

        .edit-button {
            background-color: #007bff;
            color: #fff;
        }

        .delete-button {
            background-color: #dc3545;
            color: #fff;
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
        <h1>College Event Manager</h1>
        <div class="event-form">
            <form method="post" action="">
                <input type="text" name="event-title" id="event-title" placeholder="Event Title" required>
                <input type="text" name="event-description" id="event-description" placeholder="Event Description"
                    required>
                <input type="date" name="event-date" id="event-date" required>
                <button type="submit" name="add-event">Add Event</button>
            </form>
        </div>
        <div class="event-list">
            <h2>Upcoming Events</h2>
            <ul id="events-list">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add-event"])) {
                    // Process form submission to add new event
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

                    // Prepare and bind parameters
                    $stmt = $conn->prepare("INSERT INTO events (event_title, event_description, event_date) VALUES (?, ?, ?)");
                    $stmt->bind_param("sss", $event_title, $event_description, $event_date);

                    // Set parameters and execute
                    $event_title = $_POST["event-title"];
                    $event_description = $_POST["event-description"];
                    $event_date = $_POST["event-date"];

                    $stmt->execute();

                    $stmt->close();
                    $conn->close();

                    header("Location: event_add.php");
                    exit();
                }

                // Display existing events from the database with edit and delete buttons
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

                // Fetch events from the database
                $sql = "SELECT * FROM events ORDER BY event_date DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<li><strong>" . $row["event_title"] . "</strong> - " . $row["event_description"] . " (Date: " . $row["event_date"] . ")";
                        echo "<div class='event-buttons'>";
                        echo "<form style='display: inline-block;' method='post' action='event_edit.php'><input type='hidden' name='event-id' value='" . $row["id"] . "'><button type='submit' class='edit-button'>Edit</button></form>";
                        echo "<form style='display: inline-block;' method='post' action='event_delete.php'><input type='hidden' name='event-id' value='" . $row["id"] . "'><button type='submit' class='delete-button'>Delete</button></form>";
                        echo "</div></li>";
                    }
                } else {
                    echo "<li>No events found</li>";
                }

                $conn->close();
                ?>
            </ul>
        </div>
    </div>
</body>

</html>