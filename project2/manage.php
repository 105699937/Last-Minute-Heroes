<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "./header.inc"?>
    <title>HR manager</title>
</head>
<body>
    <?php include "./nav.inc" ?>
    <main class="application_page_layout top_margin_PC top_margin_mobile">
    <article>
    <section>
        <h2>HR manager</h2>
            <form action="?" method="POST">
                <label for="ID">ID</label>
                <input type="text" placeholder="Enter your ID" name="login_id">
                <label for="password">Password</label>
                <input type="password" name="login_password" placeholder="****">
                <button type="Login">Login</button>
                <button type="reset">Reset</button>
            </form>
        </section>
        <code>now we need to redirect to a page where all the managers tools are available if the credintials are valid else print a message to give genuine informations and block the page after 3 wrong attempts</code>
        </article>
    </main>
    <?php include "./footer.inc" ?>
</body>
</html>