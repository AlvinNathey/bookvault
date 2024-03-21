<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    form {
  text-align: center;
  margin-top: 30px;
}
input[type="text"] {
  width: 40%;
  padding: 15px;
  border-radius: 10px;
  font-size: 15px;
  border: 1px solid #ccc;
}
button {
  padding: 15px 20px;
  background-color: #708ee6;
  color: white;
  border: none;
  border-radius: 10px;
  margin-left: 10px;
}
.book-container {
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 10px;
  margin: 10px;
  padding: 10px;
}
.book-container img {
  width: 200px; /* Adjust the image size as needed */
  height: 300px; /* Adjust the image size as needed */
  display: block;
  margin: 0 auto 10px;
}
.book-details {
  text-align: center;
}
/* Add this CSS for the loader */
.loader {
  border: 6px solid #f3f3f3; /* Light grey */
  border-top: 6px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 30px;
  height: 30px;
  animation: spin 1s linear infinite;
  margin: 0 auto;
  display: none; /* Hide initially */
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
</head>
<body>
<?php include("body/header.php"); ?>
<form method="get" action="">
<input type="text" name="search" placeholder="Search for a book">
<button type="submit" name="submit-search"><i class="fa-solid fa-search"></i></button>
</form>
<!-- Add the loader div here -->
<div class="loader"></div>
<div class="book-list">
<?php
// Function to search for books on Open Library API
function searchBooks($query) {
// Base URL for the Open Library API
$base_url = 'https://openlibrary.org/search.json?q=';
// Construct the full URL with the search query
$url = $base_url . urlencode($query);
// Perform the API request
$response = file_get_contents($url);
// Check if the response is successful
if ($response === false) {
return false;
}
// Decode the JSON response
$data = json_decode($response, true);
// Check if the data is valid
if (!$data || !isset($data['docs'])) {
return false;
}
// Extract and return the list of books
return $data['docs'];
}
// Check if the search form is submitted
if (isset($_GET['submit-search'])) {
    // Get the search query from the form
    $query = $_GET['search'];
    // Display loading animation while fetching data
    echo "<div class='loader'></div>";
    // Search for books based on the query
    $books = searchBooks($query);
    // Check if there are any books found
    if ($books === false || empty($books)) {
        echo "No books found for the query: $query";
    } else {
        // Display the available books
        echo "<div class='book-list'>";
        echo "<h5 style='text-align: center'>Search Results for: $query</h5>";
        foreach ($books as $book) {
            echo "<div class='book-container'>";
            
            // Check if cover_edition_key exists and fetch cover image
            if (isset($book['cover_edition_key'])) {
                $cover_url = "https://covers.openlibrary.org/b/olid/{$book['cover_edition_key']}-M.jpg";
                echo "<img src='$cover_url' alt='Book Cover'>";
            } else {
                // Display a default image icon if no cover image is available
                echo "<img src='default_image_icon.jpg' alt='Book image not found!'>";
            }
            
            echo "<div class='book-details'>";
            echo "<h3>" . $book['title'] . "</h3>";
            
           // Check if the "author_name" key exists and is an array
           if (isset($book['author_name']) && is_array($book['author_name'])) {
               echo "<p>Author: " . implode(", ", $book['author_name']) . "</p>";
                } else {
                   echo "<p>Author(s): Unknown</p>";
                      }
            // Check if 'first_publish_year' key exists before accessing its value
            if (isset($book['first_publish_year'])) {
                echo "<p>Publish Year: " . $book['first_publish_year'] . "</p>";
            } else {
                echo "<p>Publish Year: Unknown</p>";
            }
            
            echo "</div>"; // close book-details div
            echo "</div>"; // close book-container div
        }
        echo "</div>"; // close book-list div
    }
    // Remove the loading animation after displaying results
    echo "<script>document.querySelector('.loader').style.display = 'none';</script>";
}
?>

</div>
<?php include("body/footer.php"); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Hide the loader when the document is loaded
  document.querySelector('.loader').style.display = 'none';
});

// Show the loader when the search button is clicked
document.querySelector('form').addEventListener('submit', function() {
  document.querySelector('.loader').style.display = 'block';
});
</script>
</body>
</html>