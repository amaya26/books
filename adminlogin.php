<?php

if(isset($_REQUEST['login'])){

//get username from form
$username = clean_input($dbconnect, $_REQUEST['username']);
$options = ['cost' => 9,];

//get username and hashed password from database
$login_sql = "SELECT * FROM `users` WHERE `username` = '$username'";
$login_query = mysqli_query($dbconnect, $login_sql);
$login_rs = mysqli_fetch_assoc($login_query);

//hash password and compare with password in database
if (password_verify($_REQUEST['password'], $login_rs['password'])) {

//pasword matches
echo 'password is valid';
$_SESSION['admin'] = $login_rs['username'];
header("Location: index.php?page=../admin/add_book");

} //end valid password if

else {

echo 'invalid password';
unset($_SESSION);
$login_error = "Incorrect username / password";
header("Location: index.php?page=../admin/login&error=$login_error");

} //end invalid password else


}//end if login button has been pushed

?>

