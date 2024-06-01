<?php


// Database configuration
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

// Fetch all events from the database
$sql = "SELECT * FROM events";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Events</title>
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

        .event {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .event-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .event-description {
            color: #333;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .event-date {
            color: #888;
            font-size: 14px;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-image: linear-gradient(to right, #007bff, #0056b3);
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-image 0.3s;
        }

        .back-link:hover {
            background-image: linear-gradient(to right, #0056b3, #007bff);
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>All Events</h1>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $event_title = $row["event_title"];
                $event_description = $row["event_description"];
                $event_date = $row["event_date"];
                ?>
                <div class="event">
                    <div class="event-title"><?php echo $event_title; ?></div>
                    <div class="event-description"><?php echo $event_description; ?></div>
                    <div class="event-date">Date: <?php echo $event_date; ?></div>
                </div>
                <?php
            }
        } else {
            echo "<p>No events found.</p>";
        }
        ?>
        <a href="index.php" class="back-link">Back to Home</a>
    </div>
</body>

</html>
<?php
// Close connection
$conn->close();
?>