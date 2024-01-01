<?php
    // Include the database connection file
    require_once "../process/db.php";

    session_start(); // Start the session (if not started)

    // Check if the user is logged in (you might have your own logic here)
    if (!isset($_SESSION['useremail'])) {
        header("Location: login.php");
        exit;
    }

    // Fetch user details from the database based on the logged-in user's email
    $useremail = $_SESSION['useremail'];
    $query = "SELECT Name, Post FROM teacher WHERE Email = ?";
    $stmt = $conn->prepare($query);

    // Check if the prepare() call succeeded
    if ($stmt) {
        $stmt->bind_param("s", $useremail); // Bind the parameter correctly
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $username = $row['Name'];
            $post = $row['Post'];
        } else {
            // Handle if user data is not found
            $username = "N/A";
            $post = "N/A";
        }
    } else {
        // Handle prepare() error if any
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/PTC.css">
    <script>
</script>

</head>
<body>
        <div class="tfp-div">
                <button class="big-button" >Time Table</button>
                <button class="big-button" >Add Achivement</button>
                <button class="big-button" >New Meeting</button>
        </div>

        <nav class="tfp-nav">
            <img src="../image/logo.png" alt="img-logo" class="tfp-img">
            <img src="../image/find.png" alt="find" class="tfp-img" onclick = "window.location.href='Teacher-Search-Page.php'" >
            <img src="../image/Teacher-Image.png" alt="teacher-logo"class="tfp-img">
        </nav>

        <div class="in">
            <img src="../image/Teacher-Image.png" alt="teacher-logo"class="tfp-img-pro">
            <label class="half-label">Name:<?php echo $username;?></label>
            <label class="half-label">Post:<?php echo $post;?></label>
            <div class="footer">  
            <button class="small-button">edit</button>
            <button  class="small-button" onclick = "logout()">log out</button>
            </div>
        </div>
        <div class="out ">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed quidem, aspernatur eaque esse illo autem at cupiditate tempora non consequatur eligendi fugiat aperiam voluptatum ea nostrum corrupti provident temporibus doloribus.</p>
        </div>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="../JS/Teacher-First-Pagej.js"></script>
</body>
</html>