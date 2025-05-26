<?php

include_once("./settings.php");
$conn = mysqli_connect($host,$user,$pswd,$dbnm);
$query = "SELECT * FROM eoi ORDER BY EOInumber ASC";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<h2>📋 All EOIs</h2>";
    echo "<table border='1' cellpadding='10'>";
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
            <th>Skill1</th>
            <th>Skill2</th>
            <th>Skill3</th>
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
                <td>{$row['skill1']}</td>
                <td>{$row['skill2']}</td>
                <td>{$row['skill3']}</td>
                <td>{$row['other_skills']}</td>
                <td>{$row['status']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p>😕 No EOIs found in the database.</p>";
}

?>