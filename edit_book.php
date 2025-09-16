
<?php
// Check user is logged on
if (isset($_SESSION['admin'])) {

// retrieve subjects and authors to populate combo box
include("sub_author.php");

// Retrieve current values for book...
$ID = $_REQUEST['Book_ID'];

// get values from DB
$edit_query = get_data($dbconnect, "WHERE b.Book_ID = $ID");

$edit_results_query = $edit_query[0];
$edit_results_rs = mysqli_fetch_assoc($edit_results_query);

$author_ID = $edit_results_rs['Author_ID'];
$author_full_name = $edit_results_rs['Full_Name'];
$book = $edit_results_rs['Title'];

?>

<div class = "admin-form">
    <h1>Edit a Book</h1>

    <form action="index.php?page=../admin/change_book&Book_ID=<?php echo $ID;?>& 
    authorID=<?php echo $author_ID; ?>" method="post">
        <p>
            <textarea name="Title" placeholder="Title (Required)" required><?php echo $book; ?></textarea>
        </p>

        <div class="important">
            If you edit an author, it will change the author name for the 
            title being edited. It does not edit the author name on all
            books attributed to that author.
        </div>

        <div class="autocomplete">
            <p><input name="author_full" id="author_full" value="<?php echo str_replace('  ', ' ', $author_full_name); ?>" /></p>
        </div>

        <div class="light_blue">
            Blank subjects appear as n/a. You can either edit these
             / add a subject or leave them as n/a.
        </div>

        <br>

        <p><input class="form-submit" type="submit"  name="submit"
        value="Edit Title" /></p>

    </form>

    <script>
        <?php include("autocomplete.php"); ?>

        var all_author = <?php print("$all_authors") ?>;
        autocomplete(document.getElementById("author_full"), all_author);

    </script>

</div>

<?php
    } // end user logged on if

    else {
        $login_error = 'Please login to access this page';
        header("Location: index.php?page=../admin/login&error=$login_error");
    }

?>