<div class = "admin-form">

<h2>Login</h2>

<form action="index.php?page=../admin/adminlogin" method="post">
    <p><input name="username" placeholder="Username"/></p>
    <p><input name="password" placeholder="Password" type="password" /></p>

    <?php

    if (isset($_GET['error'])) {
        ?>
        <span class="error">
            <?php echo $_GET['error']; ?>
        </span>

        <?php

    }//end of get error if

    ?>
    <p><input class="form-submit" type="submit" name="login" value="Log In" /></p>
</form>

</div>