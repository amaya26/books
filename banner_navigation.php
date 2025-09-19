<div class="box banner">
    <h1>The Book Nook</h1>
</div> <!-- / banner -->

<!-- Navigation goes here -->
<div class="box nav">

    <div class="linkwrapper">
        <div class="commonsearches">
            <a href="index.php">Home</a>
            <a href="index.php?page=all_results&search=all">All Books</a>
            <a href="index.php?page=all_results&search=recent">Recent</a>
            <a href="index.php?page=all_results&search=random">Random</a>
        </div> <!-- / commonsearches -->

        <div class="topsearch">

            <!-- Quick Search -->
            <form method="post" action="index.php?page=quick_search" enctype="multipart/form-data">

                <input class="search quicksearch" type="text" name="quick search" size="40" value="" required placeholder="Quick Search...">

                <select class="quick-choose" name="search_type">
                    <option value="all" selected>All</option>
                    <option value="title">Book</option>
                    <option value="author">Author</option>
                </select>

                <input class="submit" type="submit" name="find_quick" value="&#xf002;" >

            </form> <!-- / quick search -->
        </div> <!-- / top search -->

        <div class="topadmin">

        <?php
            if(isset($_SESSION['admin'])) {

                ?>

                <a href="index.php?page=../admin/add_book">
                <i class="fa fa-plus fa-2x"></i></a>
                &nbsp; &nbsp;
                <a href="index.php?page=/logout">
                <i class="fa fa-sign-out fa-2x"></i></a>

                <?php

            } // end admin if

        else {

            ?>
                <a href="index.php?page=../admin/login">
                <i class="fa fa-sign-in fa-2x"></i></a>
            <?php

        } // end login else
        ?>

        </div> <!-- / top admin -->

    </div> <!-- / link wrapper -->

</div> <!-- / nav -->