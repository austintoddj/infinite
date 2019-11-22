<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php find_selected_page(); ?>

<?php
// Can't add a new page unless we have a subject as a parent
if (!$current_subject) {
    // Subject ID was missing or invalid or
    // subject couldn't be found in the database
    redirect_to("manage_content.php");
}
?>

<?php
if (isset($_POST['submit'])) {
    // Process the form

    // Validations
    $required_fields = array("menu_name", "position", "visible", "content");
    validate_presences($required_fields);

    $fields_with_max_lengths = array("menu_name" => 30);
    validate_max_lengths($fields_with_max_lengths);

    if (!empty($errors)) {
        $_SESSION["errors"] = $errors;
        redirect_to("new_page.php?subject=" . $current_subject["id"]);
    } else {
        // Perform Create
        // Make sure you add the subject_id!
        $subject_id = $current_subject["id"];
        $menu_name  = mysql_prep($_POST["menu_name"]);
        $position   = (int)$_POST["position"];
        $visible    = (int)$_POST["visible"];
        // Be sure to escape the content
        $content = mysql_prep($_POST["content"]);

        $query = "INSERT INTO pages (";
        $query .= " subject_id, menu_name, position, visible, content";
        $query .= ") VALUES (";
        $query .= " {$subject_id}, '{$menu_name}', {$position}, {$visible}, '{$content}'";
        $query .= ")";
        $result = mysqli_query($connection, $query);

        if ($result) {
            // Success
            $_SESSION["message"] = "New page has been created successfully.";
            redirect_to("manage_content.php");
        } else {
            // Failure
            $_SESSION["message"] = "New page has not been created successfully.";
        }
    }
} else {
    // This is probably a GET request

}   // End: if (isset($_POST['submit']))
?>

<?php include("../includes/layouts/header.php"); ?>
<!-- Begin page Content -->
<div class="container-fluid">
    <div class="row">

        <!-- Begin Sidebar -->
        <div class="col-sm-3 col-md-2 sidebar">
            <?php echo navigation($current_subject, $current_page); ?>
        </div>
        <!-- End Sidebar -->

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Create Basic Page</h1>
            <span style="font-size: 10px;"><a href="admin.php">Dashboard</a> > <a href="manage_content.php">Content</a> > Create Basic Page</span>
            <br/>
            <br/>
            <?php echo message(); ?>
            <?php $errors = errors(); ?>
            <?php echo form_errors($errors); ?>

            <!-- Begin form -->
            <form action="new_page.php?subject=<?php echo urlencode($current_subject["id"]); ?>" method="POST"
                  role="form">
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
                                $page_set   = find_pages_for_subject($current_subject["id"], false);
                                $page_count = mysqli_num_rows($page_set);
                                for ($count = 1; $count <= ($page_count + 1); $count++) {
                                    echo "<option value=\"{$count}\">{$count}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
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
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="content">Content</label> <span class="red-star">*</span>
                            <textarea class="form-control" rows="20" name="content" id="content"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Create" class="btn btn-success"/>&nbsp;&nbsp;<a
                        href="manage_content.php?subject=<?php echo urlencode($current_subject["id"]); ?>">Cancel</a>
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