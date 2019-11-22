<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php include("../includes/layouts/header.php"); ?>
<?php find_selected_page(); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">

        <!-- Begin Sidebar -->
        <div class="col-sm-3 col-md-2 sidebar">
            <?php echo navigation($current_subject, $current_page); ?>
        </div>
        <!-- End Sidebar -->

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Create New Subject</h1>
            <span style="font-size: 10px;"><a href="admin.php">Dashboard</a> > <a href="manage_content.php">Content</a> > Create New Subject</span>
            <br/>
            <br/>
            <?php echo message(); ?>
            <?php $errors = errors(); ?>
            <?php echo form_errors($errors); ?>

            <!-- Begin form -->
            <form action="create_subject.php" method="post" role="form">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="menu_name">Menu Name</label> <span class="red-star">*</span>
                            <input name="menu_name" type="text" class="form-control" id="menu_name" value=""/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="subject_name">Position</label>
                            <select name="position" class="form-control" id="position">
                                <?php
                                $subject_set   = find_all_subjects(false);
                                $subject_count = mysqli_num_rows($subject_set);
                                for ($count = 1; $count <= ($subject_count + 1); $count++) {
                                    echo "<option value=\"{$count}\">{$count}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="subject_name">Visible</label> <span class="red-star">*</span>
                    <br/>
                    <label class="radio-inline">
                        <input type="radio" name="visible" id="inlineRadio2" value="0"> No
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="visible" id="inlineRadio1" value="1"> Yes
                    </label>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Create" class="btn btn-success"/>&nbsp;&nbsp;<a
                        href="manage_content.php">Cancel</a>
                </div>
            </form>
            <!-- End Form -->

        </div>
    </div>
</div>
<!-- End Page Content -->

<?php include("../includes/layouts/footer.php"); ?>
</body>
</html>