<?php
    // functions
    require_once("functions/mykeys.inc.php");
    require_once("functions/MyFriendsSystemQuery.php");
    require_once("functions/sanitizeInput.php");

    // initialise error message to ''
    $errorMessage = '';

    // only if server request was POST, execute code
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // ---------- Initialise values ----------
        $email = sanitizeInput($_POST['email']);
        $profile_name = sanitizeInput($_POST['profile_name']);
        $password = sanitizeInput($_POST['password']);
        $confirmPassword = sanitizeInput($_POST['confirmPassword']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" >
  <meta name="description" content="Applied Web Project Part 1" >
  <meta name="keywords" content="HTML5" >
  <meta name="author" content="LastMinuteHeroesG02 - Rory" >
  <meta name="viewport" content="width=device-width, initial-scale=1.0" >
  <link rel="stylesheet" href="styles/styles.css" type="text/css">
  <title>Apply Now</title>
</head>

<body>
    <header>
        <div class="logo"><h1><a href="index.php">Last Minute Heroes</a></h1></div>

        <nav>
            <a href="index.php">Home</a>
            <a href="jobs.php">Available Jobs</a>
            <a href="apply.php">Job Applications</a>
            <a href="about.php">About Us</a>
        </nav>
    </header>
    <main class="application_page_layout top_margin_PC">

    <article>
        <h2>Last Minute Heroes Employment</h2>
        <section>
            <form action="https://mercury.swin.edu.au/it000000/formtest.php" method="post">
                <fieldset>
                    <legend>Application Form</legend>
                    <label for="JobRefNoSelect">Job Reference Number</label>
                    <select name="JobRefNo" id="JobRefNoSelect" required>
                        <option value="">Please Select</option>
                        <option value="NA0000076">(NA0000076) Network Administrator</option>
                        <option value="SD0000128">(SD0000128) Front-End Developer Intern</option>
                        <option value="DA0000365">(DA0000365) Data Analyst</option>
                        <option value="CS0000038">(CS0000038) Cybersecurity Specialist</option>
                    </select>
                    <br>
                    <label for="FirstNameInput">First Name</label>
                    <input type="text" name="FirstName" id="FirstNameInput" pattern="[A-Za-z]{1,20}" placeholder="Your First Name" required>
                    <br>
                    <label for="LastNameInput">Last Name</label>
                    <input type="text" name="LastName" id="LastNameInput" pattern="[A-Za-z]{1,20}" placeholder="Your Last Name" required>
                    <br>
                    <label for="BirthDateInput">Date of Birth</label>
                    <input type="date" name="BirthDate" id="BirthDateInput" required>
                    <br>
                    <br>
                    <fieldset>
                        <legend>Gender</legend>
                        <label for="GenderMale">Male</label>
                        <input type="radio" name="Gender" id="GenderMale" value="male" required>
                        <label for="GenderFemale">Female</label>
                        <input type="radio" name="Gender" id="GenderFemale" value="female" required>
                        <label for="GenderUnspecified">Unspecified</label>
                        <input type="radio" name="Gender" id="GenderUnspecified" value="unspecified" required>
                    </fieldset>
                    <br>
                    <label for="StreetAddressInput">Street Address</label>
                    <input type="text" name="StreetAddress" id="StreetAddressInput" pattern="{1,40}" required>
                    <br>
                    <label for="SuburbAddressInput">Suburb/ Town</label>
                    <input type="text" name="SuburbAddress" id="SuburbAddressInput" pattern="{1,40}" required>
                    <br>
                    <br>
                    <label for="StateSelect">State</label>
                    <select name="State" id="StateSelect" required>
                        <option value="" selected>Please Select</option>
                        <option value="vic">VIC</option>
                        <option value="nsw">NSW</option>
                        <option value="qld">QLD</option>
                        <option value="nt">NT</option>
                        <option value="wa">WA</option>
                        <option value="sa">SA</option>
                        <option value="tas">TAS</option>
                        <option value="act">ACT</option>
                    </select>
                    <br>
                    <label for="PostCodeInput">Post Code</label>
                    <input type="text" name="PostCode" id="PostCodeInput" pattern="(0[289][0-9]{2})|([123456789][0-9]{3})" required>
                    <br>
                    <label for="EmailInput">Email Address</label>
                    <input type="email" name="Email" id="EmailInput" pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$" required>
                    <br>
                    <label for="PhoneInput">Phone Number</label>
                    <input type="text" name="Phone" id="PhoneInput" pattern="[\d ]{8,12}" required>
                    <br>
                    <label>Required Skills</label>
                    <br>
                    <br>
                    <label for="Skill1Check">Programming</label>
                    <input type="checkbox" name="Skills[]" id="Skill1Check" value="Programming">
                    <br>
                    <label for="Skill2Check">Enterprise User Management</label>
                    <input type="checkbox" name="Skills[]" id="Skill2Check" value="Enterprise">
                    <br>
                    <label for="Skill3Check">CCNP Security</label>
                    <input type="checkbox" name="Skills[]" id="Skill3Check" value="CCNP">
                    <br>
                    <br>
                    <label for="OtherSkillsInput">Other Skills</label>
                    <textarea name="OtherSkills" id="OtherSkillsInput"></textarea>
                    <br>
                </fieldset>
                <button type="submit">Apply</button>
                <button type="reset">Reset</button>
            </form>
        </section>
    </article>
</main>
    <footer>
        <a href="https://last-minute-heroes.atlassian.net/jira/software/projects/SCRUM/boards/1/backlog?assignee=unassigned&epics=visible&issueParent=10000&atlOrigin=eyJpIjoiY2NlODBiZjEwYzgzNGRjOWE1NzY4M2YxZTZhMTA0ZTIiLCJwIjoiaiJ9">Jira Epic</a>
    </footer>
</body>
</html>