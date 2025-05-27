<?php 
session_start();
if(!isset($_SESSION['name'])){
    header("location:manage.php");
    session_unset();
    session_destroy();
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
    <main class="application_page_layout top_margin_PC top_margin_mobile hr_manager_tools_page">
    <article>
        <p><?php if(isset($_SESSION['name'])){echo"<h3>Welcome " .$_SESSION['name']. "</h3>";}  ?></p>
        <h2>Choose your Query</h2>
        <div class="manager_tool_box">
            <form action="hr_manager_tools.php" method="post">
            <input type="submit" name="list_al_eois" value="All Applicants" >
            <input type="submit" name ="filter_by_jrn" value="Filter by JRN">
            <input type="submit" name= "filter_by_names" value="Filter by Names">
            <input type="submit" name="delete_an_application" value="Delete Application">
            <input type="submit" name ="change_status" value="Change status">
            </form>
        </div>
    </article>
    </main>
    <?php include "./footer.inc" ?>
</body>
</html>

<?php
if (isset($_POST['list_al_eois'])) {
    header("location:hr_manager_tools_all_applications.php");
}
if (isset($_POST['filter_by_jrn'])){
    header("location:filter_by_jrn.php");
}
if (isset($_POST['filter_by_names'])){
    header("location:filter_by_name.php");
}
if (isset($_POST['delete_an_application'])){
    header("location:delete_applications.php");
}
if (isset($_POST['change_status'])){
    header("location:change_status.php");
}
?>