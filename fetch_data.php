<!DOCTYPE html>
<html>
<head>
    <title>Fetch Student Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Student Data</h2>

    <?php
    $api_url = 'http://localhost:8080/api/students';
    $response = file_get_contents($api_url);

    if ($response === FALSE) {
        echo '<div class="alert alert-danger">Failed to fetch data from API.</div>';
    } else {
        $students = json_decode($response, true);

        if (count($students) > 0) {
            echo '<table class="table table-bordered table-striped">';
            echo '<thead class="table-dark"><tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Number</th>
                    <th>Address</th>
                    <th>Actions</th>
                  </tr></thead>';
            echo '<tbody>';
            foreach ($students as $student) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($student['id']) . '</td>';
                echo '<td>' . htmlspecialchars($student['name']) . '</td>';
                echo '<td>' . htmlspecialchars($student['email']) . '</td>';
                echo '<td>' . htmlspecialchars($student['number']) . '</td>';
                echo '<td>' . htmlspecialchars($student['address']) . '</td>';
                echo '<td>
                        <a href="update_data.php?id=' . $student['id'] . '" class="btn btn-sm btn-primary">Update</a>
                        <a href="delete_data.php?id=' . $student['id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</a>
                      </td>';
                echo '</tr>';
            }
            echo '</tbody></table>';
        } else {
            echo '<div class="alert alert-warning">No student data found.</div>';
        }
    }
    ?>
</div>

</body>
</html>
