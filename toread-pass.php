<?php
// Include the database connection file
include_once 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the book details from the form
    $bookImage = $_POST['bookImage'];
    $bookTitle = $_POST['bookTitle'];
    $bookAuthors = $_POST['bookAuthors'];
    $bookPublishedDate = $_POST['bookPublishedDate'];

    // Prepare and execute the SQL statement to insert the data into the table using prepared statements
    $sql = "INSERT INTO `want-to-read` (`book-img`, `book-title`, `book-author`, `book-date`) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $bookImage, $bookTitle, $bookAuthors, $bookPublishedDate);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the statement
    $stmt->close();

    // Close the database connection
    $conn->close();
}
?>
