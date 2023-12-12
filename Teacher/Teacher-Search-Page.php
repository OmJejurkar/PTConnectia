<?php
// Include the database connection file
require_once "../process/db.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $search = $_GET['search'];

    // Prepare and execute a query to search for students
    $query = "SELECT * FROM students WHERE Name LIKE ? OR Parent LIKE ?";
    $stmt = $conn->prepare($query);
    $searchTerm = "%$search%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Output student data dynamically
            echo "<button class='big-button' onclick='window.location.href=\"Teacher-Student-Profile-Page.html?id={$row['student_id']}\"'>{$row['Name']}</button>";
        }
    } else {
        echo "No students found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/PTC.css"> 
</head>
<body>
<form action="search_students.php" method="GET">
    <div class="div-group">
        <svg class="icon-tsp" aria-hidden="true" viewBox="0 0 24 24">
            <img src="../image/find.png" alt="find" class="img-tsp">
        </svg>
        <input placeholder="Search Parent || Child" type="search" class="input-tsp" name="search">
        <button type="submit" class="big-button">Search</button>
        <!-- Output student buttons dynamically based on search results -->
        <!-- PHP will generate buttons here based on search results -->
    </div>
</form>

</body>
</html>