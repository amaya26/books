<?php

$all_results = get_data($dbconnect, $sql_conditions);

$find_query = $all_results[0];
$find_count = $all_results[1];

if ($find_count == 1) {
    $result_s = "Result";
}
else {
    $result_s = "Results";
}

// check if we have results
if ($find_count > 0) {

// customise headings

if ($heading != "") {
    $heading = "<h2>$heading ($find_count $result_s)</h2>";
}

elseif ($heading_type == "author") {
    // retrieve author name
    $author_rs = get_item_name($dbconnect, 'author', 'Author_ID', $author_ID);

    $author_name = $author_rs['First']." ".$author_rs['Middle']." ".$author_rs['Last'];

    $heading = "<h2>$author_name Quotes ($find_count $result_s)</h2>";
}

elseif ($heading_type == "quote_success") {
    $heading = "<h2>Insert Quote Success</h2>
    <p>You have inserted the following quote...</p>";
}

elseif ($heading_type == "edit_success") {
    $heading = "<h2>Edit Quote Success</h2>
    <p>You have edited the quote. The entry is now...</p>";
}

elseif ($heading_type == "delete_quote") {
    $heading = "<h2>Delete Quote - Are You Sure?</h2>
    <p>Do you really want to delete the quote in the box below?</p>";
}

echo $heading;

while($find_rs = mysqli_fetch_assoc($find_query)) {
    $quote = $find_rs['Title'];
    $ID = $find_rs['Book_ID'];

    // create full name of author
    $author_full = $find_rs['Full_Name'];

    // get author ID for clickable author link
    $author_ID = $find_rs['Author_ID'];

    ?>

    <div class="results">
        <?php echo $quote; ?>

        <p><i>
            <a href="index.php?page=all_results&search=author&Author_ID=<?php echo $author_ID; ?>"><?php echo $author_full; ?></a>
        </i></p>

        <p>
        <?php

        // if user is logged in, show edit / delete options
        if (isset($_SESSION['admin'])) {

            ?>
            <div class="tools">
                <a href="index.php?page=../admin/edit_book&Book_ID=<?php echo $ID; ?>">
                <i class="fa fa-edit fa-2x"></i></a> &nbsp; &nbsp;
                <a href="index.php?page=/deleteconfirm&Book_ID=<?php echo $ID; ?>">
                <i class="fa fa-trash fa-2x"></i></a>
            </div>
            <?php

        }

        ?>

    </div>

    <br />

    <?php

} // end of while loop

} // end of 'have results'

// if there are no results, show an error message
else {
    ?>

    <h2>Sorry!</h2>

    <div class="no-results">
        Unfortunately - there were no results from your search. Please try again.
    </div>
    <br />

    <?php
} // end of 'no results' else


?>