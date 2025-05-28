<?php 
session_start();
// if(isset($_SESSION['name'])){
//     header("location:manage.php");
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "header.inc"?>
    <title>HR manager</title>
</head>
<body>
    <?php include "./nav.inc" ?>
    <main class="application_page_layout top_margin_PC top_margin_mobile">
    <article>
        <h2>HR manager</h2>

    <section>
            <form action="manage.php" method="POST">
                <label for="login_id">ID</label>
                <input type="text" placeholder="Enter your ID" name="login_id" id="login_id" require>
                <label for="login_password">Password</label>
                <input type="password" name="login_password" id="login_password" placeholder="*********" require>
                <input type="submit" value="Login" class="manager_login_buttons">
                <input type="reset" value="reset" class="manager_login_buttons">
                <!-- <button type="submit">submit</button> -->
                <!-- <button type="reset">Reset</button> -->
            </form>
        </section>
        <code>
        <?php 
        if(isset($_SESSION['login_attempts'])){
            $attempts_left = 3 - $_SESSION['login_attempts'];
        if($_SESSION['login_attempts'] >=3){
            echo "<p>too many attempts</p>";
            header("location:frequent_login_attempts.php");
        }else{
            echo("you have $attempts_left more attempts left</p>");
        }
        }
        ?>
        </code>
        </article>
    </main>
    <?php include "footer.inc" ?>
</body>
</html>