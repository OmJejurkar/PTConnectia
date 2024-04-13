<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="../CSS/PTC.css">
</head>
<body>
<div class="relative">
    <input type="text" placeholder="Search..." class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:shadow-outline" />
    <ul class="absolute left-0 right-0 mt-1 bg-white border rounded-lg shadow-md hidden">
        <li class="px-4 py-2 hover:bg-zinc-100 cursor-pointer">Suggestion 1</li>
        <li class="px-4 py-2 hover:bg-zinc-100 cursor-pointer">Suggestion 2</li>
        <li class="px-4 py-2 hover:bg-zinc-100 cursor-pointer">Suggestion 3</li>
    </ul>
</div>
<script>
    const input = document.querySelector('input');
    const suggestions = document.querySelector('ul');

    input.addEventListener('input', () => {
        suggestions.classList.remove('hidden');
        // Implement autocomplete logic here based on input value
    });

    document.addEventListener('click', (e) => {
        if (!suggestions.contains(e.target)) {
            suggestions.classList.add('hidden');
        }
    });
</script>
<?php
require_once "../process/db.php";

// Check if search query is set
if (isset($_GET['query'])) {
    $query = $_GET['query'];

    // Search the database
    $sql = "SELECT * FROM student WHERE Name LIKE '%$query%' ";
    $result = mysqli_query($sql);

    // Check if there are results
    if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo "<div class='search-result'>";
            echo "<h2>" . $row["title"] . "</h2>";
            echo "</div>";
        }
    } else {
        echo "No results found.";
    }

    // Close connection
    mysqli_close($conn);
} else {
    echo "No search query provided.";
}
?>

</body>
</html>
