<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php $layout_context = "public"; ?>
<?php include("../includes/layouts/header_public.php"); ?>
<?php find_selected_page(true); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">

        <!-- Begin Sidebar -->
        <div class="col-sm-3 col-md-2 sidebar">
            <?php echo public_navigation($current_subject, $current_page); ?>
        </div>
        <!-- End Sidebar -->

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

            <?php if ($current_page) { ?>
                <h1><?php echo htmlentities($current_page["menu_name"]); ?></h1>
                <span style="font-size: 10px;"><a
                        href="index.php">Home</a> > <?php echo htmlentities($current_page["menu_name"]); ?></span>
                <br/>
                <br/>
                <?php echo nl2br(html_entity_decode($current_page["content"])); ?>

            <?php } else { ?>
                <div class="jumbotron">
                    <div class="container">
                        <h1>Welcome to a New Site!</h1>

                        <p>"Imagination is the beginning of creation. You imagine what you desire, you will what you
                            imagine, and at last, you create what you will."</p>
                        <blockquote>
                            <footer>George Bernard Shaw</footer>
                        </blockquote>
                        <a href="about.php">
                            <btn class="btn btn-large btn-primary">Learn More</btn>
                        </a>
                        <center><span class="text-muted" style="font-size: 12px;"><i>Powered By <a href="index.php">Infinite</a>.
                                    Version 1.2</i></span></center>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- End Page Content -->

<?php include("../includes/layouts/footer.php"); ?>
</body>
</html>