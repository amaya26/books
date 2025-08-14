<?php 

// retrieve search type...
$search_type = clean_input($dbconnect, $_POST['search_type']);
$search_term = clean_input($dbconnect, $_POST['quick_search']);

//set up searches...
$book_search = "b.Title LIKE '%$search_term%'";

$name_search = "
CONCAT(a.First, ' ', a.Middle, ' ', a.Last) LIKE '%$search_term%'
OR CONCAT(a.First, ' ', a.Last) LIKE '%$search_term%'
";

if ($search_type == "title") {
    $sql_conditions = "WHERE $book_search";
}

elseif($search_type == "author") {
    $sql_conditions = "";
}

else {
    $sql_conditions = "WHERE $name_search OR $book_search";
}

$heading = "'$search_term' Books";

include ("results.php");

?>