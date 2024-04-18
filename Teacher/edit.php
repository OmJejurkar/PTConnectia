<?php
session_start();
require_once "../process/db.php";

// Check if the user is logged in
if (!isset($_SESSION['useremail'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newName = $_POST["name"];
    $newPost = $_POST["post"];
    $useremail = $_SESSION['useremail'];

    $query = "UPDATE teacher SET Name = ?, Post = ? WHERE Email = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("sss", $newName, $newPost, $useremail);
        if ($stmt->execute()) {
            // Profile updated successfully
            header("Location: Teacher-First-Page.php");
            exit;
        } else {
            echo "Error updating profile: " . $conn->error;
        }
    } else {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    }
}

// Fetch current user details
$useremail = $_SESSION['useremail'];
$query = "SELECT Name, Post FROM teacher WHERE Email = ?";
$stmt = $conn->prepare($query);

if ($stmt) {
    $stmt->bind_param("s", $useremail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $currentName = $row['Name'];
        $currentPost = $row['Post'];
    } else {
        $currentName = "N/A";
        $currentPost = "N/A";
    }
} else {
    echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/PTC.css">
    <title>Edit Profile</title>
</head>
<body>
    <h2>Edit Profile</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $currentName; ?>"><br><br>
        <label for="post">Post:</label>
        <input type="text" id="post" name="post" value="<?php echo $currentPost; ?>"><br><br>
        <input type="submit" value="Save">
    </form>
</body>
</html>
