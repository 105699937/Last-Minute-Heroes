<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'header.inc' ?>
  <meta name="author" content="LastMinuteHeroesG02 - Calvin">
  <title>Vacancies</title>
</head>

<body>
  <?php include 'nav.inc' ?>
  <main class="main_page_layout job_page_layout top_margin_mobile">
    <!-- the query should be executed  -->
    <?php
    require_once("settings.php");
    $conn = @mysqli_connect($host, $user, $pswd, $dbnm);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM jobs";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<section>";
            echo "<div class='text_content'>";
            echo "<h2>Job Opportunity</h2>";
            echo "<h3>Reference ID: " . $row['reference_id'] . "</h3>";
            echo "<h3>Position: " . $row['position'] . "</h3>";
            if (!empty($row['image_url'])) {
                echo "<img src='" . $row['image_url'] . "' alt='Job Image'>";
            }
            echo "<p>" . $row['job_description'] . "</p>";
            echo "<p><strong>Salary Range:</strong> " . $row['salary_range'] . "</p>";
            echo "<p><strong>Reports to:</strong> " . $row['reports_to'] . "</p>";

            echo "<div class='highlights'>";
            echo "<h4>Key Responsibilities</h4><ol>";
            foreach (explode("\r\n", $row['responsibilities']) as $item) {
                echo "<li>" . htmlspecialchars($item) . "</li>";
            }
            echo "</ol>";

            echo "<h4>Essential Qualifications & Skills</h4><ul>";
            foreach (explode("\r\n", $row['skills']) as $item) {
                echo "<li>" . htmlspecialchars($item) . "</li>";
            }
            echo "</ul>";

            echo "<h4>Preferable</h4><ul>";
            foreach (explode("\r\n", $row['preferred']) as $item) {
                echo "<li>" . htmlspecialchars($item) . "</li>";
            }
            echo "</ul>";
            echo "</div></div></section>";
        }
    } else {
        echo "<p>No jobs available at the moment.</p>";
    }

    mysqli_close($conn);
    ?>

    <aside>
      <h3>🌐 We are Hiring</h3>
      <p>Stay updated with current trends in IT! Whether you're aiming for a networking, cybersecurity, or software development role, certifications and real-world practice make a huge difference. Apply for relevant positions below.</p>
      <a href="apply.php" target="_blank">Apply</a>
    </aside>
  </main>

  <?php include 'footer.inc' ?>
</body>
</html>
