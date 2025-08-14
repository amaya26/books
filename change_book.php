<?php

// check user is logged on
if (isset($_SESSION['admin'])) {

    if(isset($_REQUEST['submit']))

{

// retrieve book and author ID from form
// check they are integers (in case someone edits the URL)
$book_ID = filter_var($_REQUEST['Book_ID'], FILTER_SANITIZE_NUMBER_INT);
$old_author = filter_var($_REQUEST['Author_ID'],
FILTER_SANITIZE_NUMBER_INT);

    include("process_form.php");

// delete author if there are no books associated
// with that author!
if ($old_author != $author_ID) {
    delete_ghost($dbconnect, $old_author);
} // end check author changed

// update book
$stmt = $dbconnect -> prepare("UPDATE `books` SET `Author_ID` = ?,
`Title` = ? WHERE `Book_ID` = ?;");
$stmt -> bind_param("isi", $author_ID, $book, $book_ID);
$stmt -> execute();

// Close stmt once everything has been inserted
$stmt -> close();

$heading = "";
$heading_type = "edit_success";
$sql_conditions = "WHERE b.Book_ID = $book_ID";

include("content/results.php");

} // end submit button pushed

} // end user logged

else {
    $login_error = 'Please login to access this page';
    header("Location: index.php?page=../admin/login&
    error=$login_error");
}

?>