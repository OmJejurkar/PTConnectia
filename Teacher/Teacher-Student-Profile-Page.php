<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/PTC.css">
    <title>Student Profile</title>
</head>
<body>
    <div>
        <fieldset>
            <legend><img src="../image/Teacher-Image.png" alt="Student-Profile" class="Profile-tssp"></legend>
            <label for="Name" class="full-label"><?php echo $student_name; ?></label>
            <label for="Roll no" class="half-label"><?php echo $student_rollno; ?></label>
            <label for="Div" class="half-label"><?php echo $student_div; ?></label>
            <!-- Other student details you want to display -->
            <button type="button" class="big-button" onclick="window.location.href='Teacher-Student-FullProfile.html'">Full Profile</button><br>
            <button type="button" class="big-button" onclick="window.location.href='Teacher-Student-CIMarks.html'">CI Marks</button><br>
            <button type="button" class="big-button" onclick="window.location.href='Teacher-Student-EndMark.html'">End Marks</button><br>
            <button type="button" class="big-button" onclick="window.location.href='Teacher-Student-Achivement.html'">Achievement</button>
        </fieldset>
        <button type="button" class="small-button" onclick="window.location.href='Teacher-Student-Parent.html'">Parent</button>
    </div>
</body>
</html>
