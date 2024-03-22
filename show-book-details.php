<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Book Details</title>
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
    .book-details-container {
        display: flex;
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }
    .book-details-container img {
        width: 200px;
        height: 300px;
        margin-right: 20px;
    }
    .book-details {
        flex-grow: 1;
        text-align: left;
    }
    .book-details p {
        margin-bottom: 10px;
    }
</style>

</head>
<body>
<?php include("body/header.php"); ?>

<div class="book-details-container">
    <?php
    if(isset($_GET['bookId'])) {
        $bookId = $_GET['bookId'];
        
        // Fetch book details based on the bookId from the Google Books API
        $url = 'https://www.googleapis.com/books/v1/volumes/' . $bookId;
        $response = file_get_contents($url);
        $bookData = json_decode($response, true);

        // Display book details
        if($bookData) {
            $bookImage = isset($bookData['volumeInfo']['imageLinks']['thumbnail']) ? $bookData['volumeInfo']['imageLinks']['thumbnail'] : 'default_image_icon.jpg';
            $bookTitle = isset($bookData['volumeInfo']['title']) ? $bookData['volumeInfo']['title'] : 'Title Not Available';
            $bookAuthors = isset($bookData['volumeInfo']['authors']) ? implode(', ', $bookData['volumeInfo']['authors']) : 'Unknown';
            $bookPublishedDate = isset($bookData['volumeInfo']['publishedDate']) ? $bookData['volumeInfo']['publishedDate'] : 'Unknown';
            $bookDescription = isset($bookData['volumeInfo']['description']) ? $bookData['volumeInfo']['description'] : 'No description available';
           

            echo '<img src="' . $bookImage . '" alt="Book Cover">';
            echo '<div class="book-details">';
            echo '<h2>' . $bookTitle . '</h2>';
            echo '<p><strong>Author(s):</strong> ' . $bookAuthors . '</p>';
            echo '<p><strong>Publish Year:</strong> ' . $bookPublishedDate . '</p>';
            echo '<p><strong>Description:</strong><br>' . $bookDescription . '</p>';
            echo '</div>';
        } else {
            echo '<p>Book details not found.</p>';
        }
    } else {
        echo '<p>No book selected.</p>';
    }
    ?>
</div>

<?php include("body/footer.php"); ?>
</body>
</html>