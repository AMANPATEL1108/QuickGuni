<<<<<<< HEAD
<?php
// Check if a session is not already active
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
$script = $_SERVER['SCRIPT_NAME'];
$home_url = $protocol . '://' . $host . dirname($script) . '/';

// Include your database connection configuration
include 'db_config.php';

// Assuming you have a function to get user data based on the user_id
function getUserData($userId, $conn)
{
    // Replace this with your actual database query
    $stmt = $conn->prepare("SELECT first_name, is_admin FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($userName, $isAdmin);

    if ($stmt->fetch()) {
        return ['first_name' => $userName, 'is_admin' => $isAdmin];
    } else {
        return false;
    }
}
$userData = isset($_SESSION['user_id']) ? getUserData($_SESSION['user_id'], $conn) : false;
$userName = $userData ? $userData['first_name'] : false;
$isUserAdmin = $userData ? $userData['is_admin'] : false;


// Query to get counts from the database
$studentCountQuery = "SELECT COUNT(*) AS student_count FROM users";
$teacherCountQuery = "SELECT COUNT(*) AS teacher_count FROM teacher";
$eventCountQuery = "SELECT COUNT(*) AS event_count FROM events";

// Execute queries
$studentCountResult = $conn->query($studentCountQuery);
$teacherCountResult = $conn->query($teacherCountQuery);
$eventCountResult = $conn->query($eventCountQuery);

// Fetch counts
$studentCount = $studentCountResult->fetch_assoc()['student_count'];
$teacherCount = $teacherCountResult->fetch_assoc()['teacher_count'];
$eventCount = $eventCountResult->fetch_assoc()['event_count'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="robots" content="noindex, nofollow">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css">
    <!-- Your custom CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body>
    <div class="preloader">
        <div class="loader"></div>
    </div>
    <header>
        <div class="container">
            <div class="header-inner">
                <div class="header-logo">
                    <a href="<?php echo $home_url; ?>"><img src="assets/images/logo.png"></a>
                </div>
                <div class="profile-mobiles">
                    <?php if ($userName) { ?>
                        <div class="profile-name-head">
                            <a
                                href="<?php echo $isUserAdmin ? $home_url . '/admin_dashboard.php' : $home_url . '/dashboard.php'; ?>">
                                <img src="assets/images/man.png">
                                <span>
                                    <?php echo $userName; ?>
                                </span>
                            </a>
                        </div>
                    <?php } ?>
                </div>
                <div class="header-menu">
                    <input type="checkbox" class="menu-toggle" id="menu-toggle">
                    <label class="hamburger-menu" for="menu-toggle">
                        <div></div>
                        <div></div>
                        <div></div>
                    </label>
                    <nav>
                        <ul>
                            <li><a href="<?php echo $home_url; ?>">Home</a></li>
                            <li><a href="<?php echo $home_url; ?>/about.php">About</a></li>
                            <?php if (isset($_SESSION['user_id'])) { ?>
                                <?php if ($isUserAdmin) { ?>
                                    <li><a href="<?php echo $home_url; ?>/faculty_dashboard.php">Faculty Dashboard</a></li>
                                    <li><a href="<?php echo $home_url; ?>/admin_dashboard.php">Admin Dashboard</a></li>
                                    <li><a href="<?php echo $home_url; ?>/student_dash.php">Student</a></li>
                                    <li><a href="<?php echo $home_url; ?>/event_add.php">Event</a></li>
                                <?php } else { ?>
                                    <li><a href="<?php echo $home_url; ?>/dashboard.php">Dashboard</a></li>
                                    <li><a href="<?php echo $home_url; ?>/event_detail.php">Event</a></li>
                                <?php } ?>
                                <li><a href="<?php echo $home_url; ?>/logout.php">Logout</a></li>
                                <?php if ($userName) { ?>
                                    <li class="profile-name-head">
                                        <a
                                            href="<?php echo $isUserAdmin ? $home_url . '/admin_dashboard.php' : $home_url . '/dashboard.php'; ?>">
                                            <img src="assets/images/man.png">
                                            <span>
                                                <?php echo $userName; ?>
                                            </span>
                                        </a>
                                    </li>
                                <?php } ?>
                            <?php } else { ?>
                                <li><a href="<?php echo $home_url; ?>/login.php">Login</a></li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Display counts -->
</body>

</html>
=======
<?php
// Check if a session is not already active
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
$script = $_SERVER['SCRIPT_NAME'];
$home_url = $protocol . '://' . $host . dirname($script) . '/';

// Include your database connection configuration
include 'db_config.php';

// Assuming you have a function to get user data based on the user_id
function getUserData($userId, $conn) {
    // Replace this with your actual database query
    $stmt = $conn->prepare("SELECT first_name, is_admin FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($userName, $isAdmin);

    if ($stmt->fetch()) {
        return ['first_name' => $userName, 'is_admin' => $isAdmin];
    } else {
        return false;
    }
}

$userData = isset($_SESSION['user_id']) ? getUserData($_SESSION['user_id'], $conn) : false;
$userName = $userData ? $userData['first_name'] : false;
$isUserAdmin = $userData ? $userData['is_admin'] : false;
?>

<!DOCTYPE html>
<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="robots" content="noindex, nofollow">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css">

    <!-- Your custom CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/responsive.css">

</head>

<body>
    <div class="preloader">
        <div class="loader"></div>
    </div>
    <header>
        <div class="container">
            <div class="header-inner">
                <div class="header-logo">
                    <a href="<?php echo $home_url; ?>"><img src="assets/images/logo.png"></a>
                </div>
                <div class="profile-mobiles">
                    <?php if ($userName) { ?>
                        <div class="profile-name-head">
                            <a href="<?php echo $isUserAdmin ? $home_url.'/admin_dashboard.php' : $home_url.'/dashboard.php'; ?>">
                                <img src="assets/images/man.png">
                                <span><?php echo $userName; ?></span>
                            </a>
                    </div>
                    <?php } ?>
                </div>
                <div class="header-menu">
                    <input type="checkbox" class="menu-toggle" id="menu-toggle">
                    <label class="hamburger-menu" for="menu-toggle">
                        <div></div>
                        <div></div>
                        <div></div>
                    </label>
                    <nav>
                        <ul>
                            <li><a href="<?php echo $home_url; ?>">Home</a></li>
                            <li><a href="<?php echo $home_url; ?>/about.php">About</a></li>
                            <?php if (isset($_SESSION['user_id'])) { ?>
                                <?php if ($isUserAdmin) { ?>
                                    <li><a href="<?php echo $home_url; ?>/admin_dashboard.php">Admin Dashboard</a></li>
                                    <li><a href="<?php echo $home_url; ?>/register.php">Registration</a></li>
                                <?php } else { ?>
                                    <li><a href="<?php echo $home_url; ?>/dashboard.php">Dashboard</a></li>
                                <?php } ?>
                                <li><a href="<?php echo $home_url; ?>/logout.php">Logout</a></li>
                                <?php if ($userName) { ?>
                                    <li class="profile-name-head">
                                        <a href="<?php echo $isUserAdmin ? $home_url.'/admin_dashboard.php' : $home_url.'/dashboard.php'; ?>">
                                            <img src="assets/images/man.png">
                                            <span><?php echo $userName; ?></span>
                                        </a>
                                    </li>
                                <?php } ?>
                            <?php } else { ?>
                                <li><a href="<?php echo $home_url; ?>/register.php">Registration</a></li>
                                <li><a href="<?php echo $home_url; ?>/login.php">Login</a></li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
</body>
</html>
>>>>>>> e5dca82098161009b1522064f6fa03d9caaf3ef0
