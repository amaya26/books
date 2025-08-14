<?php

// retrieve search type
$search_type = clean_input($dbconnect, $_REQUEST['search']);

if ($search_type == "all") {
    $heading = "All Books";
    $sql_conditions = "";
}

elseif ($search_type == "recent") {
    $heading = "Recent Books";
    $sql_conditions = "ORDER BY b.Book_ID DESC LIMIT 10";
}

elseif ($search_type == "random") {
    $heading = "Random Books";
    $sql_conditions = "ORDER BY RAND() LIMIT 10";
}

elseif ($search_type=="author") {
    // retrieve author ID
    $author_ID = $_REQUEST['Author_ID'];
    
    $heading = "";
    $heading_type = "author";

    $sql_conditions = "WHERE b.Author_ID = $author_ID";
}

else {
    $heading = "No results test";
    $sql_conditions = "WHERE b.Book_ID = 1000";
}

include("results.php");

?>