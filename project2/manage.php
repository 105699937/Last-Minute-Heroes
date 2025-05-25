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
            <form action="manage.php" method="POST">
                <label for="ID">ID</label>
                <input type="text" placeholder="Enter your ID" name="login_id">
                <label for="password">Password</label>
                <input type="password" name="login_password" placeholder="*********">
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

<!-- CREATE TABLE managers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login_id VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
 -->


<?php
session_start();

// Connect to database
require_once("./settings.php");
$conn = mysqli_connect($host,$u_name,$u_password,$db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// Initialize attempts if not set
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

// Block login if too many attempts
if ($_SESSION['login_attempts'] >= 3) {
    die("🚫 Too many login attempts. Please try again later.");
}

// Get login data
$login_id = $_POST["login_id"];
$password = $_POST["login_password"];

// Check login_id in DB
$sql = "SELECT * FROM managers WHERE login_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $login_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) === 1) {
    $manager = mysqli_fetch_assoc($result);

    if (password_verify($password, $manager['password'])) {
        echo "✅ Login successful! Welcome, " . $manager['name'];
        $_SESSION['login_attempts'] = 0; // Reset attempts
        // Optional: set login session
        $_SESSION['name'] = $manager['name'];
        header("location:hr_manager_tools.php");
    } else {
        $_SESSION['login_attempts'] += 1;
        echo "❌ Incorrect password! Attempt " . $_SESSION['login_attempts'] . " of 3";
    }
} else {
    $_SESSION['login_attempts'] += 1;
    echo "❌ Manager not found! Attempt " . $_SESSION['login_attempts'] . " of 3";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

