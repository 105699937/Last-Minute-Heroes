<?php 
session_start();
if(!isset($_SESSION['name'])){
    header("location:manage.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "./header.inc" ?>
    <title>Filter by Job Reference Number</title>
</head>
<body>
    <?php include "./nav.inc" ?>
    <main class=" application_page_layout view_all_applicants top_margin_mobile ">
<article>
    <h2>Filter by Job Job Reference Number</h2>
    <section>
    <h4>Please Enter Job Reference Numbers in this box</h4>
    <form action="filter_by_jrn.php" method="POST">
    <div class="filter_by_job_reference_number_box">
    <input type="text" id="jrn" name="job_reference_number" placeholder="Enter Job Reference Number">
    <input type="submit" name="filter_by_jrn" value="filter" id="filter_by_jrn">
    </div>
</form>

<section id="all_application_section">
<h5> ----> scroll </h5>    

<?php
include_once("./settings.php");

$conn = mysqli_connect($host, $user, $pswd, $dbnm);
if (!$conn) {
    echo "<p>Database connection failed.</p>";
    exit;
}

if (isset($_POST['filter_by_jrn'])) {
    $job_ref = trim($_POST['job_reference_number']);

    if (!empty($job_ref)) {
        $query = "SELECT * FROM eoi WHERE job_reference = '$job_ref'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<h3>Results for Job Reference Number: <strong>$job_ref</strong></h3>";
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
            echo "<p>❌ No EOIs found for job reference number: <strong>$job_ref</strong></p>";
        }
    } else {
        echo "<p>⚠️ Please enter a Job Reference Number.</p>";
    }
}
?>


</section>
</article>
</main>
<?php include "./footer.inc" ?>
</body>
</html>