<?php

// check user is logged on
if (isset($_SESSION['admin'])) {

    if(isset($_REQUEST['submit']))

{
    // retrieve data from form
    $book = $_REQUEST['Title'];

    $author_full = $_REQUEST['author_full'];

    $first = "";
    $middle = "";
    $last = "";

$author_ID = "";

// handle blank fields
if ($author_full == "") {
    $author_full = $first = "Anonymous";
}

//Check to see if movie exists in db
$find_book_id = "SELECT * FROM books b WHERE Title LIKE '$book'";
$find_book_query = mysqli_query($dbconnect, $find_book_id);
$book_count = mysqli_num_rows($find_book_query);

if ($book_count > 0) {
    ?>

    <h2>Duplicate Book</h2>

    <div class="error-message">
        Unfortunately, the book you tried to add is already in the database. Please try a different book. 
    </div>
    <br />

    <?php
}

else {
    // check to see if author exists
$find_author_id = "SELECT * FROM author a WHERE CONCAT(a.First, ' ', a.Middle, ' ', a.Last) LIKE '%$author_full%' OR CONCAT(a.First, ' ', a.Last) LIKE '%$author_full%'";
$find_author_query = mysqli_query($dbconnect, $find_author_id);
$find_author_rs = mysqli_fetch_assoc($find_author_query);
$author_count = mysqli_num_rows($find_author_query);

include("admin/process_form.php");

// insert book
$stmt = $dbconnect -> prepare("INSERT INTO `Books` (`Author_ID`, `Title`) VALUES (?, ?); ");
$stmt -> bind_param("is", $author_ID, $book);
$stmt -> execute();

$book_ID = $dbconnect -> insert_id;

// Close stmt once everything has been inserted
$stmt -> close();

$heading = "";
$heading_type = "book_success";
$sql_conditions = "WHERE Book_ID = $book_ID";

include("content/results.php");

} // end submit button pushed

} // end user logged

else {
    $login_error = 'Please login to access this page';
    header("Location: index.php?page=../admin/login&error=$login_error");
}

}

?>




