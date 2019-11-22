<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
$admin_set = find_all_admins();
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
            <h1 class="page-header">People</h1>
            <span style="font-size: 10px;"><a href="admin.php">Dashboard</a> > People</span>
            <br/>
            <br/>

            <?php
            // $num = mysqli_num_rows($admin_set);
            // if ($num > 0) {
            // echo "<h6>There ".pluralize($num, 'are', 'is')." currently $num active user".pluralize($num).".</h6>";
            ?>

            <?php
            $num = mysqli_num_rows($admin_set);
            if ($num > 0) {
                echo "<h6><a href='manage_admins.php'>All</a> " . "<span class='text-muted'>(" . $num . ")</span>" . "</h6>";
                ?>

                <table class="table table-hover table-striped">
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php while ($admin = mysqli_fetch_assoc($admin_set)) { ?>
                        <tr>
                            <td><?php echo htmlentities($admin["id"]); ?></td>
                            <td>
                                <a href="profile.php?id=<?php echo urlencode($admin["id"]); ?>"><?php echo htmlentities($admin["username"]); ?></a>
                            </td>
                            <td><?php echo htmlentities($admin["first_name"]); ?></td>
                            <td><?php echo htmlentities($admin["last_name"]); ?></td>
                            <td><?php echo htmlentities($admin["email"]); ?></td>
                            <td><a href="edit_admin.php?id=<?php echo urlencode($admin["id"]); ?>">Edit</a></td>
                            <td><a href="delete_admin.php?id=<?php echo urlencode($admin["id"]); ?>"
                                   onclick="return confirm('Are you sure you want to delete <?php echo $admin["first_name"] . " " . $admin["last_name"]; ?>?');">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
                <br/>
                <a href="new_admin.php">+ Create new user</a>

            <?php
            } else {
                echo "<h6>There are currently no active users.</h6>";
            }
            ?>
        </div>
    </div>
</div>
<!-- End Page Content -->

<?php include("../includes/layouts/footer.php"); ?>
</body>
</html>