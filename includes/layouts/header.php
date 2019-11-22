<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php $layout_context = "admin"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Infinite <?php if ($layout_context == "admin") {
            echo "Admin";
        } ?></title>
    <link href="lib/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/dashboard.css" rel="stylesheet" media="screen">
    <link href="css/content.css" rel="stylesheet" media="screen">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector:     "textarea",
            theme:        "modern",
            plugins:      [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar1:     "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            toolbar2:     "print preview media | forecolor backcolor emoticons",
            image_advtab: true,
            templates:    [
                {title: 'Test template 1', content: 'Test 1'},
                {title: 'Test template 2', content: 'Test 2'}
            ]
        });
    </script>
</head>
<body>
<!-- Begin Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://infinite.dev/admin.php">Infinite <?php if ($layout_context == "admin") {
                    echo "Admin";
                } ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="admin.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                </li>
                <li>
                    <a href="http://infinite.dev/index.php" target="_blank"><i
                            class="fa fa-fw fa-globe"></i> Visit Site</a>
                </li>
                <li>
                    <a href="profile.php?id=<?php echo htmlentities($_SESSION["admin_id"]); ?>"><i
                            class="fa fa-fw fa-user"></i> My Profile</a>
                </li>
                <li>
                    <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navigation -->