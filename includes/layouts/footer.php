<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="lib/bootstrap/js/bootstrap.min.js"></script>
<script src="lib/bootstrap/js/docs.min.js"></script>
<script src="lib/bootstrap/js/ie10-viewport-bug-workaround.js"></script>

<?php
if (isset($connection)) {
    mysqli_close($connection);
}
?>