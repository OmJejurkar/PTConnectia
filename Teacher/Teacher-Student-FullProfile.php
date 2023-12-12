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
    $query = "SELECT * FROM student WHERE Email = 'student1@gmail.com'";
    $stmt = $conn->prepare($query);

    // Check if the prepare() call succeeded
    if ($stmt) {
        //$stmt->bind_param("s", $useremail); // Bind the parameter correctly
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $username = $row['Name'];
            $rollno = $row['Rollno'];
            $div = $row['Div'];
            $enrollment = $row['Enrolment'];
            $email = $row['Email'];
            $dob = $row['DOB'];
            $gender = $row['Gender'];
            $blood = $row['Blood'];
            $cast = $row['Cast'];
            $subcast = $row['Subcast'];
            $address = $row['Address'];

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
</head>
<body>
  <h1 class="sub-head">Full Profile</h1> 
  <fieldset>
  <legend><img src="../image/Teacher-Image.png" alt="Student-Profile" class="Profile-tssp"></legend>
    <label for="Name" class="full-label"><?php echo $username;?></label>
    <label for="Roll No" class="half-label"> <?php echo $rollno;?></label>
    <label for="Div" class="half-label"><?php echo $div;?></label>
    <label for="Enrollment" class="full-label"><?php echo $enrollment;?></label>
    <label for="Email" class="full-label"><?php echo $email;?></label>
    <label for="DOB" class="full-label"><?php echo $dob;?></label>
    <label for="Gender"class="half-label"><?php echo $gender;?></label>
    <label for="Blood" class="half-label"><?php echo $blood;?></label>
    <label for="Cast"class="half-label"><?php echo $cast;?></label>
    <label for="Subcast" class="half-label"><?php echo $subcast;?></label>
    <label for="Address" class="full-label"><?php echo $address;?></label>
  </fieldset>
  <button type="button" class="small-button">Edit</button>
</body>
</html>