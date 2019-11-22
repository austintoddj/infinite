<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">

        <!-- Begin Sidebar -->
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
            </ul>
        </div>
        <!-- End Sidebar -->

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Dashboard</h1>

            <p class="lead">Welcome back, <?php echo htmlentities($_SESSION["username"]); ?>.</p>

            <div class="row">

                <div class="col-md-3">
                    <a href="manage_admins.php">
                        <center>
                            <img src="img/users-icon.png" style="padding: 5px;" height="100" width="100"
                                 alt="" class="img-responsive" id="users-icon">
                    </a>
                    <label for="users-icon">People</label>
                    </center>
                </div>

                <div class="col-md-3">
                    <a href="manage_content.php">
                        <center>
                            <img src="img/content-icon.png" style="padding: 5px;" height="100" width="100"
                                 alt="" class="img-responsive" id="content-icon">
                    </a>
                    <label for="content-icon">Content</label>
                    </center>
                </div>

                <div class="col-md-3">
                    <a href="http://infinite.dev/phpmyadmin" target="_blank">
                        <center>
                            <img src="img/database-icon.png" style="padding: 5px;" height="100" width="100"
                                 alt="" class="img-responsive" id="content-icon">
                    </a>
                    <label for="content-icon">Database Management</label>
                    </center>
                </div>

                <div class="col-md-3">
                    <a href="https://infinite.dev:8000" target="_blank">
                        <center>
                            <img src="img/services-icon.png" style="padding: 5px;" height="100" width="100"
                                 alt="" class="img-responsive" id="content-icon">
                    </a>
                    <label for="content-icon">Server Configuration</label>
                    </center>
                </div>

                <div class="col-md-3">
                    <a href="about.php">
                        <center>
                            <img src="img/about-icon.png" style="padding: 5px;" height="100" width="100"
                                 alt="" class="img-responsive" id="content-icon">
                    </a>
                    <label for="about-icon">About</label>
                    </center>
                </div>

                <div class="col-md-3">
                    <a href="contact.php">
                        <center>
                            <img src="img/contact-icon.png" style="padding: 5px;" height="100" width="100"
                                 alt="" class="img-responsive" id="content-icon">
                    </a>
                    <label for="contact-icon">Contact</label>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Content -->

<?php include("../includes/layouts/footer.php"); ?>
</body>
</html>