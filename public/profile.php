<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
$admin = find_admin_by_id($_GET["id"]);

if (!$admin) {
    // Admin ID was missing or invalid or
    // admin couldn't be found in the database
    redirect_to("manage_admins.php");
}
?>

<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">

        <!-- Begin Sidebar -->
        <div class="col-sm-3 col-md-2 sidebar">

        </div>
        <!-- End Sidebar -->

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <?php echo message(); ?>

            <!-- Begin Page Section -->
            <?php { ?>
                <h1 class="page-header"><?php echo $admin["first_name"] . " " . $admin["last_name"]; ?></h1>
                <span style="font-size: 10px;"><a href="admin.php">Dashboard</a> > <a
                        href="manage_admins.php">People</a> > <?php echo $admin["first_name"] . " " . $admin["last_name"]; ?></span>
                <br/>
                <br/>

                <div class="row">
                    <img src="/img/default-user.png" height="100" width="100" alt="" class="img-responsive"
                         id="default-user" style="float: left; display: inline-block;">

                    <p style="margin-left: 10em;"><span
                            style="font-weight: 300; font-size: 21px; line-height: 29px; font-family: Helvetica Neue; color: rgb(51, 51, 51);"><?php echo htmlentities($admin["username"]); ?></span><br/><br/><?php echo htmlentities($admin["bio"]); ?>
                    </p>
                </div>

                <br/>

                <ul class="nav nav-tabs">
                    <li role="presentation" class="active"><a href="">View</a></li>
                    <li role="presentation"><a href="edit_admin.php?id=<?php echo urlencode($admin["id"]); ?>">Edit</a>
                    </li>
                </ul>

                <br/>
                <br/>




                <!-- Begin Publishing Options Panel -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Details</h3>
                            </div>
                            <div class="panel-body">
                                <p>Name: <span
                                        class="text-muted"><?php echo htmlentities($admin["first_name"]); ?> <?php echo htmlentities($admin["last_name"]); ?></span>
                                </p>

                                <p>Email: <span class="text-muted"><?php echo htmlentities($admin["email"]); ?></span>
                                </p>

                                <p>Gender: <span class="text-muted"><?php echo htmlentities($admin["gender"]); ?></span>
                                </p>

                                <p>Age: <span class="text-muted"><?php echo htmlentities($admin["age"]); ?></span></p>

                                <p>ID: <span class="text-muted"><?php echo htmlentities($admin["id"]); ?></span></p>

                                <p>Password: <span class="text-muted"><i>To change your password, click the Edit tab
                                            above.</i></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Publishing Options Panel -->

                <!-- End Page Section -->

            <?php } ?>

        </div>
    </div>
</div>
<!-- End Page Content -->

<?php include("../includes/layouts/footer.php"); ?>
</body>
</html>


