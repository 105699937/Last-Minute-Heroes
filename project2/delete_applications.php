<?php
session_start();
if(!isset($_SESSION['login'])){
    header("location:manage.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "./header.inc" ?>
    <title>Document</title>
</head>
<body>
    <?php include "./nav.inc" ?>
<main class=" application_page_layout view_all_applicants top_margin_mobile ">
<article>
<h2>📋 All EOIs</h2>    

<form action="delete_applications.php" method="post">
    <label for="eoi_number">EOI Number</label>
    <input type="text" name = "eoi_number" placeholder="Please Enter EOI number ">
    <input type="submit" value="delete" name="delete_btn">
</form>
<section id="all_application_section">
<h5>📋 bigger screen - better experience </h5>    

<?php

include_once("./settings.php");
$conn = mysqli_connect($host,$user,$pswd,$dbnm);
$query = "SELECT * FROM eoi ORDER BY EOInumber ASC";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<table  id='all_application_table'>";
    echo "<tr>
            <th>EOI Number</th>
            <th>Job Ref</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Street</th>
            <th>Suburb</th>
            <th>State</th>
            <th>Postcode</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Other Skills</th>
            <th>Status</th>
          </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['EOInumber']}</td>
                <td>{$row['job_reference']}</td>
                <td>{$row['first_name']}</td>
                <td>{$row['last_name']}</td>
                <td>{$row['street_address']}</td>
                <td>{$row['suburb']}</td>
                <td>{$row['state']}</td>
                <td>{$row['postcode']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['other_skills']}</td>
                <td>{$row['status']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p>😕 No EOIs found in the database.</p>";
}

if(isset($_POST['eoi_number'])){
    $eoi_number = mysqli_real_escape_string($conn, trim($_POST['eoi_number']));

        if (!empty($eoi_number)) {
            $check_query = "SELECT * FROM eoi WHERE EOInumber = '$eoi_number'";
            $check_result = mysqli_query($conn, $check_query);

            if (mysqli_num_rows($check_result) > 0) {
                $delete_query = "DELETE FROM eoi WHERE EOInumber = '$eoi_number'";
                if (mysqli_query($conn, $delete_query)) {
                    echo "<p>✅ Record with EOI Number <strong>$eoi_number</strong> has been deleted.</p>";
                } else {
                    echo "<p>❌ Error deleting record: " . mysqli_error($conn) . "</p>";
                }
            } else {
                echo "<p>⚠️ No record found with EOI Number <strong>$eoi_number</strong>.</p>";
            }
        } else {
            echo "<p>⚠️ Please enter a valid EOI number.</p>";
        }

        mysqli_close($conn);

}
?>
</section>
</article>

</main>
<?php include "./footer.inc" ?>
</body>
</html>