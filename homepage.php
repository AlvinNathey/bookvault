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
         /* CSS code for arranging books in a grid of 3 by 3 */
       /* Style for each book */
.book {
    padding: 10px;
    border: 1px solid #ccc; /* Add border for visualization */
}

/* Ensure the image maintains its aspect ratio */
.book img {
    width: 30%; /* Adjust the width of the image */
    height: auto; /* Maintain aspect ratio */
}

@media (max-width: 768px) {
    .book {
        width: calc(50% - 20px); /* Change to 50% width on smaller screens */
    }
}
/* CSS code for arranging favorite books in a grid of 3 by 3*/
.book-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* Three columns with equal width */
    gap: 20px; /* Adjust the gap between books */
}

/* Style for each favorite book */
.book-fav {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 10px; /* Rounded border */
}


    </style>
</head>
<body>
<?php include("body/header.php"); ?>

<div class="max-w-xl mx-auto">
<h1 class="text-3xl font-bold mt-8 mb-4 text-center">My Book Collection</h1>


    <!-- Display Favorite Books -->
    <h3 class="text-2xl font-bold mt-8 mb-4 text-center">My Favorite Books</h3>
    <h3 class="text-2xl font-bold mt-8 mb-4"></h3>
    <div class="book-container">
        <?php
        // Include the database connection file
        include_once 'connection.php';

        // Select specific columns from the favorite_books table
        $sql = "SELECT id, book_img, book_title, book_author, book_date FROM favorite_books";
        $result = $conn->query($sql);

        // Check if there are any records
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                // Display book details using the fetched data
                ?>
               <div class="book-fav">
    <div class="flex items-center mb-4">
        <img src="<?php echo $row["book_img"]; ?>" alt="Book Cover" class="w-16 h-auto mr-4">
        <div>
            <h3 class="text-lg font-semibold"><?php echo $row["book_title"]; ?></h3>
            <p class="text-sm text-gray-500">By: <?php echo $row["book_author"]; ?> </p>
        </div>
    </div>
</div>
                <?php
            }
        } else {
            // If there are no records, display a message
            echo '<p class="text-gray-600">No favorite books added yet.</p>';
        }
        ?>
    </div>
</div>

    <!-- Display Books You Want to Read -->
    <h3 class="text-2xl font-bold mt-8 mb-4 text-center">Books I Want to Read</h3>
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
    <h3 class="text-2xl font-bold mt-8 mb-4 text-center">Books I Have Read</h3>
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
