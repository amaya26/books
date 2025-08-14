<?php

// get author full name from database
$author_full_sql = "SELECT *, CONCAT(First, ' ', Middle, ' ', Last) AS
Full_Name FROM author" ;
$all_authors = autocomplete_list($dbconnect, $author_full_sql, 'Full_Name');

?>