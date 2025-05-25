<?php
session_start();
if(empty($_SESSION['name'])){
    header("location:manage.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "./header.inc"?>
    <title>HR Manager Tools</title>
</head>
<body>
    <?php include "./nav.inc" ?>
    <main class="application_page_layout top_margin_PC top_margin_mobile">
    <article>
        <div class="manager_tool_box">
            <form action="?" method="get">
            <input type="submit" value="list all eois" >
            <input type="submit" value="Filter by JRN">
            <input type="submit" value="Filter by Names">
            <input type="submit" value="Delete ">
            <input type="submit" value="Change_status">
            </form>
        <div>
        
    </article>
    </main>
    <?php include "./footer.inc" ?>
</body>
</html>