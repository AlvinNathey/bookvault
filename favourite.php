<?php
// Include the database connection file
include_once 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the book details from the form
    $bookImage = $_POST['bookImage'];
    $bookTitle = $_POST['bookTitle'];
    $bookAuthor = $_POST['bookAuthor'];
    $bookDate = $_POST['bookDate'];

    // Check if the book already exists in the favorites
    $sql_check = "SELECT * FROM favorite_books WHERE book_title = ? AND book_author = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("ss", $bookTitle, $bookAuthor);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // Book already exists in favorites
        echo "This book is already in your favorites.";
    } else {
        // Insert the book into the favorites
        $sql_insert = "INSERT INTO favorite_books (book_img, book_title, book_author, book_date) VALUES (?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("ssss", $bookImage, $bookTitle, $bookAuthor, $bookDate);

        if ($stmt_insert->execute()) {
            // Redirect back to the favourite-view.php page
            header("Location: favourite-view.php");
            exit();
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }

        // Close the statement
        $stmt_insert->close();
    }

    // Close the check statement
    $stmt_check->close();
}

// Close the database connection
$conn->close();
?>
