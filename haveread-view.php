<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books I've read</title>
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
            width: 50%; /* Adjust as needed */
            margin-bottom: 30px; /* Adjust as needed */
        }
    </style>
</head>
<body>
<?php include("body/header.php"); ?>

<div class="max-w-xl mx-auto">
    <h2 class="text-3xl font-bold mt-8 mb-4">Books I've read</h2>
    <div class="book-container">
        <?php
        // Include the database connection file
        include_once 'connection.php';

        // Select all records from the haveread table
        $sql = "SELECT * FROM `haveread`";
        $result = $conn->query($sql);

        // Check if there are any records
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                $bookImage = $row["book-img"];
                $bookTitle = $row["book-title"];
                $bookAuthors = $row["book-author"];
                $bookPublishedDate = $row["book-date"];
                $timestamp = $row["timestamp"]; // Get the timestamp from the database

                // Display book details along with the timestamp
                ?>
                <div class="book">
                    <div class="flex items-center">
                        <img src="<?php echo $bookImage; ?>" alt="Book Cover" class="w-16 h-auto mr-4">
                        <div>
                            <h3 class="text-lg font-semibold"><?php echo $bookTitle; ?></h3>
                            <p class="text-sm text-gray-500">By <?php echo $bookAuthors; ?> <br> Published Date: <?php echo $bookPublishedDate; ?> <br> Book added on : <?php echo $timestamp; ?></p>
                        </div>
                    </div>
                    <!-- Favorite button -->
                    <form action="favourite.php" method="post">
                        <input type="hidden" name="bookImage" value="<?php echo htmlspecialchars($bookImage); ?>">
                        <input type="hidden" name="bookTitle" value="<?php echo htmlspecialchars($bookTitle); ?>">
                        <input type="hidden" name="bookAuthor" value="<?php echo htmlspecialchars($bookAuthors); ?>">
                        <input type="hidden" name="bookDate" value="<?php echo htmlspecialchars($bookPublishedDate); ?>">

                        <button class="flex-none flex items-center justify-center w-10 h-10 text-slate-300 ml-20 hover:text-red-800" type="submit" aria-label="Like" title="Add to favourites"> 
                            <svg width="20" height="20" aria-hidden="true" class="fill-current">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" fill="#4B5563" />
                            </svg>
                        </button>
                    </form>
                </div>
                <?php
            }
        } else {
            // If there are no records, display a message
            echo '<p class="text-gray-600">No books added to read list yet.</p>';
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</div>

<?php include("body/footer.php"); ?>
</body>
</html>
