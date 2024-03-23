<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books to Read</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<?php include("body/header.php"); ?>

<div class="max-w-xl mx-auto">
    <h2 class="text-3xl font-bold mt-8 mb-4">Books to Read</h2>
    <?php
    // Include the database connection file
    include('connection.php');

    // Select all records from the want-to-read table
    $sql = "SELECT * FROM `want-to-read`";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            $bookImage = $row["book-img"];
            $bookTitle = $row["book-title"];
            $bookAuthors = $row["book-author"];
            $bookPublishedDate = $row["book-date"];
    ?>
            <div class="flex items-center mb-4">
                <img src="<?php echo $bookImage; ?>" alt="Book Cover" class="w-16 h-auto mr-4">
                <div>
                    <h3 class="text-lg font-semibold"><?php echo $bookTitle; ?></h3>
                    <p class="text-sm text-gray-500">By <?php echo $bookAuthors; ?> | Published Date: <?php echo $bookPublishedDate; ?></p>
                </div>
            </div>
    <?php
        }
    } else {
        echo '<p class="text-gray-600">No books added to read list yet.</p>';
    }

    // Close the database connection
    $conn->close();
    ?>
</div>

<?php include("body/footer.php"); ?>
</body>
</html>
