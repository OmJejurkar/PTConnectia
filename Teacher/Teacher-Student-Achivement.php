<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../CSS/PTC.css" />
</head>
<body>
    <h1 class="sub-head">Achievement</h1>
    <form id="achievementForm" method="post" enctype="multipart/form-data">
        <input type="file" name="certificate" accept=".pdf" required />
        <button type="submit" class="small-button">Upload</button>
    </form>

    <?php
    // Database connection parameters
    require_once "../process/db.php";

    // Check if the form is submitted with a file upload
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["certificate"])) {
        // Directory where uploaded certificates will be stored
        $uploadDir = "certificates/";

        // Generate a unique filename for the uploaded certificate
        $filename = uniqid() . "_" . basename($_FILES["certificate"]["name"]);

        // Path to store the uploaded certificate
        $filePath = $uploadDir . $filename;

        // Move the uploaded certificate to the upload directory
        if (move_uploaded_file($_FILES["certificate"]["tmp_name"], $filePath)) {
            // Certificate uploaded successfully
            echo "Certificate uploaded successfully!";

            // Insert data into database
            $sql = "INSERT INTO Achievement (file_path) VALUES ('$filePath')";
            if ($conn->query($sql) === TRUE) {
                echo "Record inserted into database successfully!";
            } else {
                echo "Error inserting record: " . $conn->error;
            }
        } else {
            // Failed to upload certificate
            echo "Failed to upload certificate!";
        }
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
