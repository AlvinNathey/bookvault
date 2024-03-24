<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Book Collection</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .book-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px; /* Adjust the gap between books */
        }
        .book {
            width: calc(50% - 10px); /* Adjust the width of each book container */
            padding: 10px;
            border: 1px solid #ccc; /* Add border for visualization */
        }
        @media (max-width: 768px) {
            .book {
                width: 100%; /* Change to full width on smaller screens */
            }
        }
    </style>
</head>
<body>
<?php include("body/header.php"); ?>

<div class="max-w-xl mx-auto">
<h1 class="text-3xl font-bold mt-8 mb-4 text-center">My Book Collection</h1>


    <!-- Display Favorite Books -->
    <h3 class="text-2xl font-bold mt-8 mb-4"></h3>
    <div class="book-container">
        <?php
        // Include the database connection file
        include_once 'connection.php';

        // Select all records from the favorite_books table
        $sql = "SELECT * FROM `favorite_books`";
        $result = $conn->query($sql);

        // Check if there are any records
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                displayBook($row);
            }
        } else {
            echo '<p class="text-gray-600">No favorite books added yet.</p>';
        }
        ?>
    </div>

    <!-- Display Books You Want to Read -->
    <h3 class="text-2xl font-bold mt-8 mb-4">Books I Want to Read</h3>
    <div class="book-container">
        <?php
        // Select all records from the want-to-read table
        $sql = "SELECT * FROM `want-to-read`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                displayBook($row);
            }
        } else {
            echo '<p class="text-gray-600">No books added to read list yet.</p>';
        }
        ?>
    </div>

    <!-- Display Books You Have Read -->
    <h3 class="text-2xl font-bold mt-8 mb-4">Books I Have Read</h3>
    <div class="book-container">
        <?php
        // Select all records from the haveread table
        $sql = "SELECT * FROM `haveread`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                displayBook($row);
            }
        } else {
            echo '<p class="text-gray-600">No books added to your read list yet.</p>';
        }
        ?>
    </div>

</div>

<?php include("body/footer.php"); ?>

<?php
// Function to display book details
function displayBook($row) {
    // Check if any essential fields are empty
    if (!empty($row["book-img"]) && !empty($row["book-title"]) && !empty($row["book-author"]) && !empty($row["book-date"])) {
        echo '<div class="book">';
        echo '<div class="flex items-center mb-4">';
        echo '<img src="' . $row["book-img"] . '" alt="Book Cover" class="w-16 h-auto mr-4">';
        echo '<div>';
        echo '<h3 class="text-lg font-semibold">' . $row["book-title"] . '</h3>';
        echo '<p class="text-sm text-gray-500">By: ' . $row["book-author"] . ' <br> Date Published: ' . $row["book-date"] . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}
?>
</body>
</html>
