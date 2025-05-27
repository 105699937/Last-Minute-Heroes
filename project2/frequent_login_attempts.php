<?php
session_start();
if(!isset($_SESSION['error_msg'])){
session_unset();
session_destroy();
header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "./header.inc" ?>
    <title>Error Page</title>
</head>
<body>
    <?php include "./nav.inc" ?>
    <main class="application_page_layout top_margin_PC" >
        <article>
            <section><h2>Please Try again Later with correct credentials </h2></section>
        </article>
    </main>
    <?php include "./footer.inc"  ?>
</body>
</html>