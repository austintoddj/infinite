<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php find_selected_page(); ?>

<?php
// Unlike new_page.php, we don't need a subject_id to be sent
// We already have it stored in pages.subject_id
if (!$current_page) {
    // Page ID was missing or invalid
    // Page coudn't be found in the database
    redirect_to("manage_content.php");
}
?>

<?php
if (isset($_POST["submit"])) {
    // Process the form

    // Validations
    $required_fields = array("menu_name", "position", "visible", "content");
    validate_presences($required_fields);

    $fields_with_max_lengths = array("menu_name" => 30);
    validate_max_lengths($fields_with_max_lengths);

    if (empty($errors)) {
        // Perform Update

        $id        = $current_page["id"];
        $menu_name = mysql_prep($_POST["menu_name"]);
        $position  = (int)$_POST["position"];
        $visible   = (int)$_POST["visible"];
        $content   = mysql_prep($_POST["content"]);

        $query = "UPDATE pages SET ";
        $query .= "menu_name = '{$menu_name}', ";
        $query .= "position = {$position}, ";
        $query .= "visible = {$visible}, ";
        $query .= "content = '{$content}' ";
        $query .= "WHERE id = {$id} ";
        $query .= "LIMIT 1";
        $result = mysqli_query($connection, $query);

        if ($result && mysqli_affected_rows($connection) >= 0) {
            // Success
            $_SESSION["message"] = "Page has been updated successfully.";
            redirect_to("manage_content.php");
        } else {
            // Failure
            $message = "Page has not been updated successfully.";
        }

    }
} else {
    // This is probably a GET request

}   // End: if (isset($_POST['submit']))

?>

<?php include("../includes/layouts/header.php"); ?>

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
            <h1 class="page-header"><?php echo htmlentities($current_page["menu_name"]); ?></h1>
            <span style="font-size: 10px;"><a href="admin.php">Dashboard</a> > <a href="manage_content.php">Content</a> > <?php echo htmlentities($current_page["menu_name"]); ?></span>
            <br/>
            <br/>
            <ul class="nav nav-tabs">
                <li role="presentation"><a href="manage_content.php?page=<?php echo urlencode($current_page["id"]); ?>">View</a>
                </li>
                <li role="presentation" class="active"><a href="">Edit</a></li>
            </ul>

            <br/>
            <br/>

            <?php // $message is just a variable, doesn't use the SESSION
            if (!empty($message)) {
                echo "<div class=\"alert alert-danger\">" . htmlentities($message) . "</div>";
            }
            ?>
            <?php echo form_errors($errors); ?>

            <!-- Begin form -->

            <form action="edit_page.php?page=<?php echo urlencode($current_page["id"]); ?>" method="post" role="form">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <fieldset disabled>
                                <label for="disabledTextInput">Content Type</label>
                                <input name="menu_name" type="text" class="form-control" id="disabledTextInput"
                                       value="Page"/>

                                <p class="text-muted"><i>Content types cannot be changed.</i></p>
                            </fieldset>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="menu_name">Menu Name</label>
                            <input name="menu_name" type="text" class="form-control" id="menu_name"
                                   value="<?php echo htmlentities($current_page["menu_name"]); ?>"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="position">Position</label>
                            <select name="position" class="form-control" id="position">
                                <?php
                                $page_set   = find_pages_for_subject($current_page["subject_id"], false);
                                $page_count = mysqli_num_rows($page_set);
                                for ($count = 1; $count <= ($page_count); $count++) {
                                    echo "<option value=\"{$count}\"";
                                    if ($current_page["position"] == $count) {
                                        echo " selected";
                                    }
                                    echo ">{$count}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="visible">Visible</label>
                            <br/>
                            <label class="radio-inline">
                                <input type="radio" name="visible" id="inlineRadio2"
                                       value="0" <?php if ($current_page["visible"] == 0) {
                                    echo "checked";
                                } ?> /> No
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="visible" id="inlineRadio1"
                                       value="1" <?php if ($current_page["visible"] == 1) {
                                    echo "checked";
                                } ?>/> Yes
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea class="form-control" rows="20" name="content"
                                      id="content"><?php echo htmlentities($current_page["content"]); ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Save" class="btn btn-success"/>&nbsp;&nbsp;<a
                        href="delete_page.php?page=<?php echo urlencode($current_page["id"]); ?>" class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to delete <?php echo $current_page['menu_name']; ?>?');"/>Delete</a>
                    &nbsp;&nbsp;<a href="manage_content.php">Cancel</a>
                </div>
            </form>

            <!-- End Form -->

        </div>
    </div>
    <!-- End Page Content -->

    <?php include("../includes/layouts/footer.php"); ?>
    </body>
    </html>
