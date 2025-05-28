<?php
    if(!isset($_SESSION['applied'])){
        header("redirect: 3; url=index.php");
        echo("<p>You are being redirected.</p>");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "header.inc" ?>
    <title>Document</title>
</head>
<body>
    <?php include "nav.inc" ?>
    <main class="application_page_layout top_margin_PC">
    <article>
        <h2>Last Minute Heroes Employment</h2>
        <section>
            <p>Application success !</p>
        </section>
    </article>
    </main>
</body>
</html>