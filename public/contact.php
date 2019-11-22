<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header_contact.php"); ?>
<?php find_selected_page(); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">

        <!-- Begin Sidebar -->
        <div class="col-sm-3 col-md-2 sidebar">

        </div>
        <!-- End Sidebar -->

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

            <h1 class="page-header">Contact</h1>
            <span style="font-size: 10px;"><a href="admin.php">Dashboard</a> > Contact</span>
            <br/>
            <br/>

            <p class="lead">Let us know how we can improve your experience!</p>

            <form role="form">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label> <span class="red-star">*</span>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Subject</label> <span class="red-star">*</span>
                            <input type="text" class="form-control" id="subject">
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label> <span class="red-star">*</span>
                            <textarea class="form-control" rows="5" name="message" id="message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Page Content -->

<?php include("../includes/layouts/footer.php"); ?>
</body>
</html>