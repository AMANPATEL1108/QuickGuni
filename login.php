<<<<<<< HEAD
<?php
session_start();
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enteredEmail = strtolower(trim($_POST['email']));
    $enteredPassword = trim($_POST['password']);

    // Debugging: Echo entered email and password
    // echo "Entered Email: $enteredEmail<br>";
    // echo "Entered Password: $enteredPassword<br>";

    // Trim the entered password
    $enteredPassword = trim($_POST['password']);

    // Debugging: Echo trimmed entered password
    // echo "Trimmed Entered Password: $enteredPassword<br>";

    // Prepare SQL statement to retrieve user details
    $stmt = $conn->prepare("SELECT id, email, password, is_admin FROM users WHERE email = ?");
    $stmt->bind_param("s", $enteredEmail);
    $stmt->execute();
    $stmt->bind_result($userId, $storedEmail, $storedPassword, $isAdmin);

    // Fetch the result
    if ($stmt->fetch()) {
        // Debugging: Echo stored email and password
        echo "Stored Email: $storedEmail<br>";
        echo "Stored Password: $storedPassword<br>";

        // Verify the entered password against the stored hashed password
        if (password_verify($enteredPassword, $storedPassword)) {
            // Check if the user is an admin
            if ($isAdmin) {
                // Admin login successful
                $_SESSION['user_id'] = $userId;
                $_SESSION['is_admin'] = true;
                header('Location: index.php'); // Redirect to admin dashboard
                exit;
            } else {
                // Regular user login successful
                $_SESSION['user_id'] = $userId;
                header('Location: dashboard.php'); // Redirect to regular user dashboard
                exit;
            }
        } else {
            // Incorrect password
            $loginError = "Incorrect password";
        }
    } else {
        // Invalid email
        $loginError = "Invalid email";
    }

    $stmt->close();
}

$conn->close();
?>

<!-- Header is here -->
<?php include 'header.php'; ?>

<!-- Main Body is here -->
<main class="site-main">
    <div class="site-content-inner">
        <div class="page-headings" style="background-image:url('assets/images/abt-university.jpg');">
            <div class="container">
                <h2>Login</h2>
            </div>
        </div>

        <div class="page-content-in">
            <div class="container">
                <div class="login-screen-main">
                    <div class="login-screen">
                        <h2>Login</h2>
                        <form method="post">
                            <!-- <label for="email">Email:</label> -->
                            <input type="email" name="email" placeholder="Email" required><br>

                            <!-- <label for="password">Password:</label> -->
                            <input type="password" placeholder="Password" name="password" required><br>

                            <button type="submit">Login</button>
                        </form>
                        <?php if (isset($loginError)) { ?>
                            <p class="error-message"><?php echo $loginError; ?></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Footer is here -->
<?php include 'footer.php'; ?>
=======
<?php
session_start();
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enteredEmail = strtolower(trim($_POST['email']));
    $enteredPassword = trim($_POST['password']);

    // Debugging: Echo entered email and password
    // echo "Entered Email: $enteredEmail<br>";
    // echo "Entered Password: $enteredPassword<br>";

    // Trim the entered password
    $enteredPassword = trim($_POST['password']);

    // Debugging: Echo trimmed entered password
    // echo "Trimmed Entered Password: $enteredPassword<br>";

    // Prepare SQL statement to retrieve user details
    $stmt = $conn->prepare("SELECT id, email, password, is_admin FROM users WHERE email = ?");
    $stmt->bind_param("s", $enteredEmail);
    $stmt->execute();
    $stmt->bind_result($userId, $storedEmail, $storedPassword, $isAdmin);

    // Fetch the result
    if ($stmt->fetch()) {
        // Debugging: Echo stored email and password
        echo "Stored Email: $storedEmail<br>";
        echo "Stored Password: $storedPassword<br>";

        // Verify the entered password against the stored hashed password
        if (password_verify($enteredPassword, $storedPassword)) {
            // Check if the user is an admin
            if ($isAdmin) {
                // Admin login successful
                $_SESSION['user_id'] = $userId;
                $_SESSION['is_admin'] = true;
                header('Location: admin_dashboard.php'); // Redirect to admin dashboard
                exit;
            } else {
                // Regular user login successful
                $_SESSION['user_id'] = $userId;
                header('Location: dashboard.php'); // Redirect to regular user dashboard
                exit;
            }
        } else {
            // Incorrect password
            $loginError = "Incorrect password";
        }
    } else {
        // Invalid email
        $loginError = "Invalid email";
    }

    $stmt->close();
}

$conn->close();
?>

<!-- Header is here -->
<?php include 'header.php'; ?>

<!-- Main Body is here -->
<main class="site-main">
    <div class="site-content-inner">
        <div class="page-headings" style="background-image:url('assets/images/abt-university.jpg');">
            <div class="container">
                <h2>Login</h2>
            </div>
        </div>

        <div class="page-content-in">
            <div class="container">
                <div class="login-screen-main">
                    <div class="login-screen">
                        <h2>Login</h2>
                        <form method="post">
                            <!-- <label for="email">Email:</label> -->
                            <input type="email" name="email" placeholder="Email" required><br>

                            <!-- <label for="password">Password:</label> -->
                            <input type="password" placeholder="Password" name="password" required><br>

                            <button type="submit">Login</button>
                        </form>
                        <?php if (isset($loginError)) { ?>
                            <p class="error-message"><?php echo $loginError; ?></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Footer is here -->
<?php include 'footer.php'; ?>
>>>>>>> e5dca82098161009b1522064f6fa03d9caaf3ef0
