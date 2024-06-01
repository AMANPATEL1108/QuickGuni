<?php
session_start();
include 'header.php';

$servername = "localhost";
$username = "root";
$password = "";
$database = "quickguni";

$connection = new mysqli($servername, $username, $password, $database);

$name = "";
$email = "";
$phone = "";
$address = "";
$subject = "";
$password = "";
$reenterPassword = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $subject = $_POST['subject'];
    $password = $_POST['password'];
    $reenterPassword = $_POST['reenter_password'];

    try {
        if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($subject) || empty($password) || empty($reenterPassword)) {
            throw new Exception("All fields are required! Please fill in all the fields.");
        }

        if ($password !== $reenterPassword) {
            throw new Exception("Passwords do not match. Please re-enter your password.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format. Please enter a valid email address.");
        }

        // Validate phone number
        if (!preg_match('/^\d{10}$|^\d{12}$/', $phone)) {
            throw new Exception("Phone number must be either 10 or 12 (with +91)digits long.");
        }

        // Check if the email is already registered
        $stmt = $connection->prepare("SELECT COUNT(*) FROM teacher WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            throw new Exception("Email is already registered.");
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new teacher record
        $sql = "INSERT INTO teacher (name, email, phone, address, subject, password) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssssss", $name, $email, $phone, $address, $subject, $hashedPassword);
        $stmt->execute();
        $stmt->close();

        $name = "";
        $email = "";
        $phone = "";
        $address = "";
        $subject = "";
        $successMessage = "Teacher added correctly";
        // Redirect to index.php after successful insertion
        header("location:faculty_dashboard.php");
        exit;
    } catch (Exception $e) {
        $errorMessage = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        /* Your styles here */
    </style>
</head>

<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-container">
                    <h2>New Teacher</h2>
                    <?php
                    if (!empty($errorMessage)) {
                        echo "
                            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                <strong>$errorMessage</strong> 
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                            </div>
                            ";
                    }

                    if (!empty($successMessage)) {
                        echo "
                            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>$successMessage</strong> 
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                            ";
                    }
                    ?>
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $name ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" value="<?php echo $email ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" value="<?php echo $phone ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" value="<?php echo $address ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subject</label>
                            <input type="text" class="form-control" name="subject" value="<?php echo $subject ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Re-enter Password</label>
                            <input type="password" class="form-control" name="reenter_password" value="">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Submit</button><br><br>
                            <a class="btn btn-outline-primary" href="faculty_dashboard.php" role="button">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Required scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php include 'footer.php'; ?>