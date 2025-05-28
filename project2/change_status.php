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
    <title>Document</title>
</head>
<body>
    <?php include "./nav.inc" ?>
<main class=" application_page_layout view_all_applicants top_margin_mobile ">
<article>
<h2>📋 All EOIs</h2>    

<form action="change_status.php" method="post">
    <label for="eoi_number">EOI Number</label>
    <input type="text" name = "eoi_number" placeholder="Please Enter EOI number ">
    <label for="status">Set New Status</label>
     <select name="status" id="status">
                        <option value="">Please Select</option>
                        <option value="New">New</option>
                        <option value="Current">Current</option>
                        <option value="Final">Final</option>
    </select>
    <input type="submit" value="Change Status" name="change_status">
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
    echo "<p> No EOIs found in the database.</p>";
}

// change status 
if (isset($_POST['change_status'])) {
    $eoi_number = mysqli_real_escape_string($conn, trim($_POST['eoi_number']));
    $status = mysqli_real_escape_string($conn, trim($_POST['status']));

    // Validation
    if (empty($eoi_number) || empty($status)) {
        echo "<p>⚠️ Please enter both EOI Number and a new status.</p>";
        exit;
    }

    // Check if EOI exists
    $check_query = "SELECT * FROM eoi WHERE EOInumber = '$eoi_number'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Perform update
        $update_query = "UPDATE eoi SET status = '$status' WHERE EOInumber = '$eoi_number'";
        if (mysqli_query($conn, $update_query)) {
            echo "<p>✅ Status updated successfully for EOI #<strong>$eoi_number</strong>.</p>";
        } else {
            echo "<p>❌ Error updating status: " . mysqli_error($conn) . "</p>";
        }
    } else {
        echo "<p>❌ No EOI found with number <strong>$eoi_number</strong>.</p>";
    }
} else {
    // echo "<p>⚠️ Invalid request.</p>";
}
?>
</section>
</article>

</main>
<?php include "./footer.inc" ?>
</body>
</html>