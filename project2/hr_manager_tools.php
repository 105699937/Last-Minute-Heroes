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
            <form action="hr_manager_tools.php" method="post">
            <input type="submit" name="list_al_eois" value="Applications" >
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

<?php
if (isset($_POST['list_al_eois'])) {
    header("location:hr_manager_tools_all_applications.php");
}

?>