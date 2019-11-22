<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>
<?php find_selected_page(); ?>

<?php $num_subjects = all_subjects() ?>
<?php $num_pages = all_pages() ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">

        <!-- Begin Sidebar -->
        <div class="col-sm-3 col-md-2 sidebar">
            <?php echo navigation($current_subject, $current_page); ?>
            <br/>
            <a href="new_subject.php"><b>+</b> Create new subject</a>
        </div>
        <!-- End Sidebar -->

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

            <!-- Begin Subject Section -->
            <?php if ($current_subject) { ?>
                <!-- Begin Subject Buttons -->
                <h1 class="page-header"><?php echo htmlentities($current_subject["menu_name"]); ?></h1>
                <span style="font-size: 10px;"><a href="admin.php">Dashboard</a> > <a
                        href="manage_content.php">Content</a> > <?php echo htmlentities($current_subject["menu_name"]); ?></span>
                <br/>
                <br/>
                <ul class="nav nav-tabs">
                    <li role="presentation" class="active"><a href="">View</a></li>
                    <li role="presentation"><a
                            href="edit_subject.php?subject=<?php echo urlencode($current_subject["id"]); ?>">Edit</a>
                    </li>
                </ul>
                <!-- End Subject Buttons -->

                <br/>
                <br/>

                <!-- Begin Publishing Options Panel -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Publishing Options</h3>
                            </div>
                            <div class="panel-body">
                                <p>Content Type: <span class="text-muted">Subject</span></p>

                                <p>Position: <span class="text-muted"><?php echo $current_subject["position"]; ?></span>
                                </p>

                                <p>Visible: <span
                                        class="text-muted"><?php echo $current_subject["visible"] == 1 ? 'Yes' : 'No'; ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Publishing Options Panel -->

                <!-- Begin Pages Panel -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Pages</h3>
                    </div>
                    <div class="panel-body">
                        <ul>
                            <?php
                            $subject_pages = find_pages_for_subject($current_subject["id"], false);
                            while ($page = mysqli_fetch_assoc($subject_pages)) {
                                echo "<li>";
                                $safe_page_id = urlencode($page["id"]);
                                echo "<a href=\"manage_content.php?page={$safe_page_id}\">";
                                echo htmlentities($page["menu_name"]);
                                echo "</a>";
                                echo "</li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <!-- End Pages Panel -->
                <a href="new_page.php?subject=<?php echo urlencode($current_subject["id"]); ?>"><b>+</b> Create basic
                    page</a>

                <!-- End Subject Section -->

                <!-- Begin Page Section -->
            <?php } elseif ($current_page) { ?>
                <h1 class="page-header"><?php echo htmlentities($current_page["menu_name"]); ?></h1>
                <span style="font-size: 10px;"><a href="admin.php">Dashboard</a> > <a
                        href="manage_content.php">Content</a> > <?php echo htmlentities($current_page["menu_name"]); ?></span>
                <br/>
                <br/>
                <ul class="nav nav-tabs">
                    <li role="presentation" class="active"><a href="">View</a></li>
                    <li role="presentation"><a href="edit_page.php?page=<?php echo urlencode($current_page["id"]); ?>">Edit</a>
                    </li>
                </ul>

                <br/>
                <br/>

                <!-- Begin Publishing Options Panel -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Publishing Options</h3>
                            </div>
                            <div class="panel-body">
                                <p>Content Type: <span class="text-muted">Page</span></p>

                                <p>Position: <span class="text-muted"><?php echo $current_page["position"]; ?></span>
                                </p>

                                <p>Visible: <span
                                        class="text-muted"><?php echo $current_page["visible"] == 1 ? 'Yes' : 'No'; ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Publishing Options Panel -->

                <!-- Begin Content Panel -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Content</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo html_entity_decode($current_page["content"]); ?>
                    </div>
                </div>
                <!-- End Content Panel -->

                <!-- End Page Section -->

            <?php } else { ?>

                <?php echo message(); ?>
                <?php $errors = errors(); ?>
                <?php if (is_array($errors)) : ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $value) : ?>
                                <li><?php echo $value; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <h1 class="page-header">Content</h1>
                <span style="font-size: 10px;"><a href="admin.php">Dashboard</a> > Content</span>


                <div class="row">
                    <div class="col-md-6">
                        <div style="margin-top: 40px;">
                            <div
                                style="width: 400px; height: 200px; background-color: #fff; border: 1px solid #e5e5e5; box-shadow: rgba(0, 0, 0, 0.129412) 0px 1px 3px 0px;">
                                <div style="background-color: #e5e5e5; border: 1px solid #e5e5e5;">
                                    <h5 style="padding-left: 10px;"><span
                                            class="glyphicon glyphicon-eye-close">&nbsp;</span>At a Glance</h5>
                                </div>
                                <hr style="margin-top: -1px;">

                                <div style="padding: 10px; margin-left: 30px;">
                                    <span class="glyphicon glyphicon-book">&nbsp;</span><?php
                                    $num = mysqli_num_rows($num_subjects);
                                    echo "<a href=\"manage_content.php\">";
                                    echo $num . " Subjects";
                                    echo "</a>";
                                    ?>
                                    <br/>
                                    <br/>
                                    <span class="glyphicon glyphicon-pencil">&nbsp;</span><?php
                                    $num = mysqli_num_rows($num_pages);
                                    echo "<a href=\"manage_content.php\">";
                                    echo $num . " Pages";
                                    echo "</a>";
                                    ?>
                                </div>

                                <br/>
                                <center><p class="text-muted" style="font-size: 12px;"><i>Thank you for creating with <a
                                                href="about.php">Infinite</a>. Version 1.2</i></p></center>
                            </div>
                        </div>
                    </div>
                    <div id="content_list" class="col-md-6">
                        <div style="margin-top: 40px;">
                            <div
                                style="width: 400px; background-color: #fff; border: 1px solid #e5e5e5; box-shadow: rgba(0, 0, 0, 0.129412) 0px 1px 3px 0px;">
                                <div style="background-color: #e5e5e5; border: 1px solid #e5e5e5;">
                                    <h5 style="padding-left: 10px;"><span class="glyphicon glyphicon-edit">&nbsp;</span>Content
                                        &nbsp;&nbsp;<span style="font-size: 13px; font-weight: normal;"><a
                                                href="new_subject.php"><b> +</b> Create new subject</a></span></h5>
                                </div>
                                <hr style="margin-top: -1px;">

                                <?php echo content_list($current_subject, $current_page); ?>
                                <br/>

                            </div>
                        </div>
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