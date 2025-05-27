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
    <?php include "./header.inc" ?>
    <title>Filter by Names</title>
</head>
<body>
    <?php include "./nav.inc" ?>
    <main class=" application_page_layout view_all_applicants top_margin_mobile ">
<article>
    <h2>Filter by Name</h2>
    <section>
    <h4>Please Enter Names</h4>
    <form action="filter_by_name.php" method="POST">
    <div class="filter_by_job_reference_number_box">
    <input type="text" id="fName" name="first_name" placeholder="First Name">
    <input type="text" id="lName" name="last_name" placeholder="Last Name">
    <input type="submit" name="filter_by_name" value="filter" id="filter_by_name">
    </div>
</form>
<?php
include_once("./settings.php");

$conn = mysqli_connect($host, $user, $pswd, $dbnm);
if (!$conn) {
    echo "<p>Database connection failed.</p>";
    exit;
}

if (isset($_POST['filter_by_name'])) {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);

    if (!empty($first_name) && !empty($last_name)) {
        $query = "SELECT * FROM eoi WHERE first_name = '$first_name' and last_name = '$last_name'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<h3>Results for $first_name and $last_name</h3>";
            echo "<table  id='all_application_table'>";
            echo "<tr>
                    <th>EOI #</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Status</th>
                  </tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['EOInumber']}</td>
                        <td>{$row['first_name']}</td>
                        <td>{$row['last_name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['status']}</td>
                      </tr>";
            }

            echo "</table>";
        } else {
            echo "<p>❌ No EOIs found for those names</p>";
        }
    } else {
        echo "<p>⚠️ Please enter names</p>";
    }
}
?>


</section>
</article>
</main>
<?php include "./footer.inc" ?>
</body>
</html>