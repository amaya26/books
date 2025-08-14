
<?php
// Check user is logged on
if (isset($_SESSION['admin'])) {

// get author full name from database
$author_full_sql = "SELECT *, CONCAT(First, ' ', Middle, ' ', Last) AS Full_Name FROM author" ;
$all_authors = autocomplete_list($dbconnect, $author_full_sql, 'Full_Name');

?>

<div class = "admin-form">
    <h1>Add a Book</h1>

    <form action="index.php?page=../admin/insert_book" method="post">
        <p>
            <textarea name="title" placeholder="Title (Required)"
            required></textarea>
        </p>

        <div class="autocomplete">
            <p><input name="author_full" id="author_full" 
            placeholder="Author Name (First Middle Last)"/></p>
        </div>

        <p><input class="form-submit" type="submit" name="submit" value="Submit Book" /></p>

    </form>

    <script>
        <?php include("autocomplete.php"); ?>

        var all_author = <?php print("$all_authors") ?>;
        autocomplete(document.getElementById("author_full"),
        all_author);

    </script>

</div>

<?php
    } // end user logged on it

    else {
        $login_error = 'Please login to access this page';
        header("Location: index.php?page=../admin/login&error=$login_error");
    }

?>