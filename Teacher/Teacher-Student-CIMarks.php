<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../CSS/PTC.css" />
    <script src="https://kit.fontawesome.com/d578a1af5b.js" crossorigin="anonymous"></script>
</head>
<body>
    <h1 class="sub-head">End Sem Result</h1>
    <div class="marks-container">
        <?php
        // Database connection parameters
        require_once "../process/db.php";

        // Query to retrieve marks for each semester subject
        $query = "SELECT semester, subject, marks FROM subject_marks WHERE enrollment_number = '123456'";
        $result = $conn->query($query);

        // Check if there are any results
        if ($result && $result->num_rows > 0) {
            // Output data for each row
            while($row = $result->fetch_assoc()) {
                echo '<div class="marks-item">';
                echo '<h2 class="semester-heading">Semester ' . $row["semester"] . '</h2>';
                echo '<p><strong>Subject:</strong> ' . $row["subject"] . '</p>';
                echo '<p><strong>Marks:</strong> ' . $row["marks"] . '</p>';
                echo '</div>';
            }
        } else {
            echo "No results found";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>
</html>
