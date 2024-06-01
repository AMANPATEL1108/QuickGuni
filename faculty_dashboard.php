<?php
session_start();
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Detail</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <style>
        /* Your existing styles */
        /* Add custom styles for pagination */
        #example_paginate .paginate_button {
            padding: 0.5em 0.75em;
            margin-left: 5px;
            border-radius: 2px;
            cursor: pointer;
        }

        #example_paginate .paginate_button.current {
            background-color: #007bff;
            color: white;
        }

        #example_paginate .paginate_button.current:hover {
            background-color: #0056b3;
        }

        #example_paginate .paginate_button:hover {
            background-color: #f1f1f1;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
            transition: border-color 0.3s ease-out;
            border: 1px solid #ccc;
            min-height: 25px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <h2>List of Faculty</h2>
        <a class="btn btn-primary" href="register_faculty.php" role="button">New Faculty</a><br><br>
        <table id="example" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Subject</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "quickguni";

                $connection = new mysqli($servername, $username, $password, $database);

                if ($connection->connect_error) {
                    die("Connection Fail" . $connection->connect_error);
                }

                $sql = "SELECT * FROM teacher";
                $result = $connection->query($sql);

                if (!$result) {
                    die("invalid Query" . $connection->error);
                }

                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>$row[name]</td>
                        <td>$row[email]</td>
                        <td>$row[phone]</td>
                        <td>$row[address]</td>
                        <td>$row[subject]</td>
                        <td>$row[created_at]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='edit_faculty.php?id=$row[id]'>Edit</a>
                            <a class='btn btn-danger btn-sm' href='delete_faculty.php?id=$row[id]'>Delete</a>
                        </td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Required scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                "pagingType": "full_numbers", // Adds Previous and Next buttons
                "pageLength": 10 // Number of rows to show per page
            });
        });
    </script>
</body>

</html>
<?php include 'footer.php'; ?>