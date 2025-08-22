<?php 

// check user is logged on 
if (isset($_SESSION['admin'])) {
    
// retrieve book ID and sanitise it in case someone edits the URL
$book_ID = filter_var($_REQUEST['Book_ID'], FILTER_SANITIZE_NUMBER_INT);

// adjust heading and find book
$heading_type = "delete_book";
$heading = "";
$sql_conditions = "WHERE Book_ID = $book_ID";

include("content/results.php");

// check that variable is defined and set to 0 if not
    if ($find_rs && isset($find_rs['Author_ID'])) {
        $author_ID = $find_rs['Author_ID'];
    } 
    else {
        $author_ID = 0; 
    }

?>

<p>
    <span class="tag white-tag">
    <a href="index.php?page=../admin/deletebook&Book_ID=<?php echo $book_ID; ?>&author=<?php echo $author_ID ?>">Yes, Delete it!</a>
    </span>

    &nbsp;

    <span class="tag white-tag">
    <a href="index.php">No, take me back</a>
    </span>
</p>

<?php

} // end user logged on it

else {
    $login_error = 'Please login to access this page';
    header("Location: index.php?page=../admin/login&error=$login_error");
}

?>