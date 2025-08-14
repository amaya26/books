<?php // retrieve data from form
    $book = $_REQUEST['Title'];

    $author_full = $_REQUEST['author_full'];

    $first = "";
    $middle = "";
    $last = "";

// Initialise IDs
$author_ID = "";

// handle blank fields
if ($author_full == "") {
    $author_full = $first = "Anonymous";
}

// check to see if author is in DB, if it isn't add it.

// check to see if author exists
$find_author_id = "SELECT * FROM author a WHERE
CONCAT(a.First, ' ', a.Middle, ' ', a.Last) LIKE '%$author_full%'
OR CONCAT(a.First, ' ', a.Last) LIKE '%$author_full%'";
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
$stmt = $dbconnect -> prepare("INSERT INTO `author` (`First`, `Middle`,
 `Last`) VALUES (?, ?, ?); ");
$stmt -> bind_param("sss", $first, $middle, $last);
$stmt -> execute();

$author_ID = $dbconnect -> insert_id;

} // end name split else

?>