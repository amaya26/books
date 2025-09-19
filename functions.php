<?php 

// function to 'clean' data
function clean_input($dbconnect, $data) {
	$data = trim($data);	
	$data = htmlspecialchars($data); //  needed for correct special character rendering
        // removes dodgy characters to prevent sql injections
        $data = mysqli_real_escape_string($dbconnect, $data);
	return $data;
}

function get_data($dbconnect, $more_condition=null) {
// b => book table
// a => author table

$find_sql = "SELECT 
b.*,
a.*,
CONCAT(a.First, ' ', a.Middle, ' ', a.Last) AS Full_Name

FROM 
books b

JOIN author a ON a.Author_ID = b.Author_ID

";
// if we have a WHERE condition, add it to the sql
if($more_condition != null) {
    // add extra string onto sql
    $find_sql .= $more_condition;
}

$find_query = mysqli_query($dbconnect, $find_sql);
$find_count = mysqli_num_rows($find_query);

return $find_query_count = array($find_query, $find_count);

}

function get_item_name($dbconnect, $table, $column, $ID)
{
    $find_sql = "SELECT * FROM $table WHERE $column = $ID";
    $find_query = mysqli_query($dbconnect, $find_sql);
    $find_rs = mysqli_fetch_assoc($find_query);

    return $find_rs;
}

function autocomplete_list($dbconnect, $item_sql, $entity)    
{
// Get entity / topic list from database
$all_items_query = mysqli_query($dbconnect, $item_sql);
    
// Make item arrays for autocomplete functionality...
while($row=mysqli_fetch_array($all_items_query))
{
  $item=$row[$entity];
  $items[] = $item;
}

$all_items=json_encode($items);
return $all_items;
    
}

// Delete ghost authors 
function delete_ghost($dbconnect, $authorID)
{
    // see if there are other books by that author
    $check_author_sql = "SELECT * FROM `books` WHERE `Author_ID` = $authorID ";
    $check_author_query = mysqli_query($dbconnect, $check_author_sql);

    $count_author = mysqli_num_rows($check_author_query);

    // if there are not books associated with the old
    //author we can delete the old author
    if ($count_author <= 1) {
        $delete_ghost = "DELETE FROM `author` WHERE `author`.
        `Author_ID` = $authorID ";
        $delete_ghost_query = mysqli_query($dbconnect,
        $delete_ghost);
    }
}


function get_rs($dbconnect, $sql)
{
    $find_sql = $sql;
    $find_query = mysqli_query($dbconnect, $find_sql);
    $find_rs = mysqli_fetch_assoc($find_query);
    
    return $find_rs;
}


?>