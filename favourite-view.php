<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Favorite Books</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Additional CSS for styling book containers */
        .book-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .book {
            width: 48%; /* Adjust as needed */
            margin-bottom: 20px; /* Adjust as needed */
        }
    </style>
</head>
<body>
<?php include("body/header.php"); ?>

<div class="max-w-xl mx-auto">
    <h2 class="text-3xl font-bold mt-8 mb-4">My Favorite Books</h2>
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
                $bookImage = $row["book_img"]; // Corrected column name
                $bookTitle = $row["book_title"]; // Corrected column name
                $bookAuthors = $row["book_author"]; // Corrected column name
                $bookPublishedDate = $row["book_date"]; // Corrected column name

                // Display book details
                ?>
                <div class="book">
                    <div class="flex items-center mb-4">
                        <img src="<?php echo $bookImage; ?>" alt="Book Cover" class="w-16 h-auto mr-4">
                        <div>
                            <h3 class="text-lg font-semibold"><?php echo $bookTitle; ?></h3>
                            <p class="text-sm text-gray-500">By <?php echo $bookAuthors; ?> | Published Date: <?php echo $bookPublishedDate; ?></p>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            // If there are no records, display a message
            echo '<p class="text-gray-600">No favorite books added yet.</p>';
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</div>

<?php include("body/footer.php"); ?>
</body>
</html>
