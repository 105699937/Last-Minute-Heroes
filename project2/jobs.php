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

  $createQuery = "CREATE TABLE IF NOT EXISTS `jobs` ("
    . "`job_id` INT AUTO_INCREMENT PRIMARY KEY,"
    . "`reference_id` VARCHAR(20) NOT NULL,"
    . "`position` VARCHAR(100) NOT NULL,"
    . "`job_description` TEXT NOT NULL,"
    . "`salary_range` VARCHAR(50),"
    . "`image_url` VARCHAR(255),"
    . "`reports_to` VARCHAR(100),"
    . "`responsibilities` TEXT,"
    . "`skills` TEXT,"
    . "`preferred` TEXT);";

    $createResult = mysqli_query($conn, $createQuery);
    
    $selectResult = mysqli_query($conn, "SELECT * FROM `jobs`");
    if (!$selectResult || mysqli_num_rows($selectResult) == 0) {
      $insertQuert = "INSERT INTO `jobs` ("
        . "`job_id`, `reference_id`, `position`, `job_description`, `salary_range`,"
        . "`image_url`, `reports_to`, `responsibilities`, `skills`, `preferred`"
        . ") VALUES"
        . "(NULL, 'NA0000076', 'Network Administrator', "
        . "'As a Network Administrator, you’ll be responsible for the upkeep, configuration, and reliable operation of our client networks.', "
        . "'$70,000 – $90,000 per year', "
        . "'images/networkAdminstratorSmall.jpeg', "
        . "'Senior IT Manager', "
        . "'Maintain and troubleshoot LAN/WAN network infrastructure\r\nInstall and configure network hardware\r\nMonitor network performance and security\r\nCollaborate with IT support teams', "
        . "'Degree in Computer Science or related field\r\n3+ years of network administration experience\r\nProficiency in Cisco and Juniper technologies\r\nStrong problem-solving skills', "
        . "'CCNA/CCNP certification\r\nExperience with cloud networking (Azure, AWS)\r\nUnderstanding of ITIL framework'),"

        . "(NULL, 'SD0000128', 'Front-End Developer Intern', "
        . "'Join our vibrant team to help turn UI/UX designs into functional and scalable web pages.', "
        ."'$15 – $20 per hour (paid internship)', "
        . "'', "
        . "'UI/UX Lead Designer', "
        . "'Work closely with designers and developers\r\nWrite clean, scalable, and responsive HTML/CSS\r\nOptimize pages for speed and accessibility\r\nParticipate in code reviews and brainstorming sessions', "
        . "'HTML5, CSS3, JavaScript fundamentals\r\nCreative mindset\r\nStrong communication and collaboration skills', "
        . "'Knowledge of Git\r\nExperience using Figma or Adobe XD\r\nEnthusiasm for new technologies');";
        mysqli_query($conn, $insertQuert);
    }

    $query = "SELECT * FROM jobs";
    try {
      $result = mysqli_query($conn, $query);
    } catch (\Exception $e) {
        echo "<p>Error executing query: " . htmlspecialchars($e->getMessage()) . "</p>";
        $result = false;
    }

    if (!$result || mysqli_num_rows($result) > 0) {
        while ($result && $row = mysqli_fetch_assoc($result)) {
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
