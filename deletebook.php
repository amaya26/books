<?php

// check user is logged on
if (isset($_SESSION['admin'])) {

    $ID = $_REQUEST['Book_ID'];
    $author_ID = $_REQUEST['author'];

    delete_ghost($dbconnect, $author_ID);

    $delete_sql = "DELETE FROM `books` WHERE `books`.`Book_ID` = $ID";
    $delete_query = mysqli_query($dbconnect, $delete_sql);

    ?>
    <h2>Delete Success</h2>

    <p>The requested book has been deleted.</p>

    <?php

} // end user logged on if

else {
    $login_error = 'Please login to access this page';
    header("Location: index.php?page=../admin/login&
    error=$login_error");
}

?>