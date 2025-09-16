<?php

// check user is logged on
if (isset($_SESSION['admin'])) {

    if(isset($_REQUEST['submit']))

{
    // retrieve data from form
    $book = $_REQUEST['title'];

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

// retrieve author id if author exists
if ($author_count > 0) {
    $author_ID = $find_author_rs['Author_ID'];
}

else {
    // split author name and add to DB
    $names = explode(' ', $author_full);

    if(count($names) > 1) {
        $first = $names[0];
        $last = $names[count($names) - 1];}

    elseif (count($names) == 1) {
        $first = $names[0];}

    // Check if a middle name exists
    if (count($names) > 2) {
        $middle = implode(' ', array_slice($names, 1, -1));
    }

// add name to DB
$stmt = $dbconnect -> prepare("INSERT INTO `author` (`First`, `Middle`, `Last`) VALUES (?, ?, ?); ");
$stmt -> bind_param("sss", $first, $middle, $last);
$stmt -> execute();

$author_ID = $dbconnect -> insert_id;

} // end name split else

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




