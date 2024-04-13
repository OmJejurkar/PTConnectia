<?php
// Include the database connection file
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["username"];
    $password = $_POST["password"];

    // Prepare and execute a query to check if the user exists
    $query = "SELECT * FROM parent WHERE Email = ? AND Password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Login successful
        $row = $result->fetch_assoc();
        $username = $row["Name"];

        // Set a session variable to store user information
        session_start();
        $_SESSION['useremail'] = $email;

        header("Location:../Parent/Parent-First-Page.html"); // Redirect to the home page
        exit;
    } else {
        // Login failed
        $error_message = "Can't find your account!";
        echo '<script>
         function showPopup() {
           var popup = document.createElement("div");
           popup.classList.add("error-box");

           var header = document.createElement("div");
           header.classList.add("header");
           var heading = document.createElement("h1");
           heading.innerText = "Login Failed";
           header.appendChild(heading);

           var body = document.createElement("div");
           body.classList.add("body");
           var paragraph = document.createElement("p");
           paragraph.innerText = "' . $error_message . '";
           body.appendChild(paragraph);

           var footer = document.createElement("div");
           footer.classList.add("footer");
           var button = document.createElement("button");
           button.classList.add("ok-button");
           button.innerText = "OK";
           button.addEventListener("click", function() {
             window.location.href = "../process/login_teacher.php";
           });
           footer.appendChild(button);

           popup.appendChild(header);
           popup.appendChild(body);
           popup.appendChild(footer);

           document.body.appendChild(popup);
         }

         window.onload = showPopup;
        </script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../CSS/PTC.css">
    <link rel="stylesheet" href="../CSS/error-button.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Sacramento&display=swap" rel="stylesheet">
    
</head>
<body>
    <form action="" method="post" class="form_main">
        <p class="heading">Login</p>
        <div class="inputContainer">
            <img src="../image/user.png" alt="user" class="inputIcon">
            <input type="text" class="inputField" id="username" name="username" placeholder="Username">
        </div>

        <div class="inputContainer">
            <img src="../image/hide.png" alt="key" class="inputIcon">
            <input type="password" class="inputField" id="password" name="password" placeholder="Password">
        </div>
        <button type="submit" class="small-button input-button">Submit</button>
    </form>
</body>
</html>
