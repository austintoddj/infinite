<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>
<?php find_selected_page(); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">

        <!-- Begin Sidebar -->
        <div class="col-sm-3 col-md-2 sidebar">

        </div>
        <!-- End Sidebar -->

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

            <h1 class="page-header">About</h1>
            <span style="font-size: 10px;"><a href="admin.php">Dashboard</a> > About</span>
            <br/>
            <br/>

            <p class="lead">Users</p>

            <p>The People Screen allows you to add, change, or delete your site's users. The main part of the People
                Screen displays a table of all the users listed by ID order. The three actions that can be applied to
                users are as follows:</p>
            <ul>
                <li><b>View</b>: Shows all the information associated with the selected user</li>
                <li><b>Edit</b>: Edit the username, password, biography information or more</li>
                <li><b>Delete</b>: Remove the selected user from the system.</li>
                <ul>
                    <li><span style="color: red;"><i>WARNING: This action is destructive. Once confirmed, the user will
                                no longer exist in the database.</i></span></li>
                </ul>
            </ul>
            <br/>

            <p class="lead">Content</p>

            <p>There are two content types that you are able to create, edit, and delete.</p>
            <ul>
                <li><b>Subjects</b>:</li>
                <ul>
                    <li>These are the main sections of the website. Under each Subject, you can create, edit, delete, or
                        re-order pages. However, if you try to delete a Subject that has pages underneath it, you will
                        recieve an error. You can only delete Subjects that have no pages assosciated with them.
                    </li>
                    <li>When creating a new subject, ensure that the new subject position does not interfere with
                        another already occupying that spot. For example, if two subjects currently exist, and a new
                        subject is created but you would like to see it between the existing ones, set the new subject
                        to Position 2, and the third subject to Position 3.
                    </li>
                </ul>
                <li><b>Pages</b>:</li>
                <ul>
                    <li>These can be organized and rearranged within their respective subjects based on their position.
                        To change a pages' position, navigate to its Edit tab.
                    </li>
                    <li>When creating a basic page, ensure that the new page position does not interfere with another
                        already occupying that spot. For example, if two pages currently exist within a subject, and a
                        new page is created but you would like to see it between the existing ones, set the new page to
                        Position 2, and the third page to Position 3.
                    </li>
                </ul>
            </ul>
            <br/>

            <p class="lead">Database Management</p>

            <p>The main database management system implemented by Infinite is phpMyAdmin. By clicking on Database
                Management, you will be take to the login screen. Credentials for accessing the database are as
                follows:</p>
            <ul>
                <li>Username: <i>root</i></li>
                <li>Password: <i>root</i></li>
                <ul>
                    <li><span style="color: red;"><i>WARNING: These credentials are not secure. On a production
                                deployment of your website, you need to make sure that you choose a different username
                                and password to protect against hackers.</i></span></li>
                </ul>
            </ul>
            <br/>

            <p class="lead">Server Configuration</p>

            <p>By clicking on Server Configuration, you will be taken to the <a href="http://ajenti.org">Ajenti</a>
                Dashboard. Managing your server processes and configuring various storage options can be done here.</p>
            <ul>
                <li>Username: <i>root</i></li>
                <li>Password: <i>admin</i></li>
                <ul>
                    <li><span style="color: red;"><i>WARNING: These credentials are not secure. On a production
                                deployment of your website, you need to make sure that you choose a different username
                                and password to protect against hackers.</i></span></li>
                </ul>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Content -->

<?php include("../includes/layouts/footer.php"); ?>
</body>
</html>