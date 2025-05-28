<?php
    /**
     * Takes a string input, removing leading or trailing: whitespace; backslashes, and formats HTML special characters. 
     * Hopefully, nullifies any attempted user manipulation of the PHP Code.
     *
     * @param string $input value to sanitize
     * 
     * @return string $output sanitized $input
     */
    function sanitizeInput($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        $output = $input;
        return $output;
    }

    // Database connection settings
    require_once("settings.php");
    
    // Session Variables
    session_start();
    if (!isset($_SESSION['debug']))
    {
        $_SESSION['debug'] = false;;
    }

    // initialise error message to ''
    $errorMessage = '';

    // only if server request was POST, execute code
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // ---------- Initialise values ----------
        $JobRefNo = sanitizeInput($_POST['JobRefNo']);
        $FirstName = sanitizeInput($_POST['FirstName']);
        $LastName = sanitizeInput($_POST['LastName']);
        $BirthDate= sanitizeInput($_POST['BirthDate']);
        $Gender = sanitizeInput($_POST['Gender']);
        $StreetAddress = sanitizeInput($_POST['StreetAddress']);
        $SuburbAddress = sanitizeInput($_POST['SuburbAddress']);
        $State = sanitizeInput($_POST['State']);
        $PostCode = sanitizeInput($_POST['PostCode']);
        $Email = sanitizeInput($_POST['Email']);
        $Phone = sanitizeInput($_POST['Phone']);
        for ($i = 0; $i < count($_POST['Skills']); $i++) {
            $Skills[$i] = sanitizeInput($_POST['Skills'][$i]);
        }
        $OtherSkills = sanitizeInput($_POST['OtherSkills']);

        if (isset($JobRefNo) && isset($FirstName) && isset($LastName) && isset($BirthDate) && isset($Gender) && isset($StreetAddress) && isset($SuburbAddress) && isset($State) && isset($PostCode) && isset($Email) && isset($Phone) && isset($Skills) && isset($OtherSkills)) {
            // set error status
            $errorStatus = false;
            // set errorStatusMessage
            $errorStatusMessage = [];

            // Validate Inputs
            // First and Last Name validation
            if(!ctype_alpha($FirstName) || !ctype_alpha($LastName)) {
                $errorStatus = true;
                $errorStatusMessage[] = "Name validation failed. Pleaser enter a valid name using only letters, no spaces.";
            } elseif (strlen($FirstName) > 20 || strlen($LastName) > 20) {
                $errorStatus = true;
                $errorStatusMessage[] = "Name validation failed. Please enter a valid name of 20 characters or less.";
            }

            // Birth Date validation
            if ($BirthDate == "") {
                $errorStatus = true;
                $errorStatusMessage[] = "Birth Date validation failed. Please enter a valid date of birth.";
            } else {
                // Birth Date format validation
                $BirthDate = date('d-m-Y', strtotime($BirthDate));
                if (!preg_match("/^\d{2}-\d{2}-\d{4}$/", $BirthDate)) {
                    $errorStatus = true;
                    $errorStatusMessage[] = "Birth Date validation failed. Please enter a valid date in the format DD-MM-YYYY.";
                }
            }

            // Gender validation
            if (!in_array($Gender, ['m', 'f', 'u'])) {
                $errorStatus = true;
                $errorStatusMessage[] = "Gender validation failed. Please select an option.";
            }

            // Street Address validation
            if (strlen($StreetAddress) > 40) {
                $errorStatus = true;
                $errorStatusMessage[] = "Street Address validation failed. Please enter a valid street address of 40 characters or less.";
            }

            // Suburb Address validation
            if (strlen($SuburbAddress) > 40) {
                $errorStatus = true;
                $errorStatusMessage[] = "Suburb Address validation failed. Please enter a valid suburb address of 40 characters or less.";
            }

            // State validation
            if (!in_array($State, ['vic', 'nsw', 'qld', 'nt', 'wa', 'sa', 'tas', 'act'])) {
                $errorStatus = true;
                $errorStatusMessage[] = "State validation failed. Please select a state from the list.";
            }

            // PostCode validation
            // Australian Post Code Regex source https://www.etl-tools.com/regular-expressions/is-australian-post-code.html
            if (!preg_match("/^(0[289][0-9]{2})|([1345689][0-9]{3})|(2[0-8][0-9]{2})|(290[0-9])|(291[0-4])|(7[0-4][0-9]{2})|(7[8-9][0-9]{2})$/", $PostCode)) {
                $errorStatus = true;
                $errorStatusMessage[] = "Postcode validation failed. Please enter a valid 4 digit, Australian postcode";
            }

            // confirm email is less than 320 bytes in length
            // email size is varchar(320), length of input cannot exceed 320 bytes
            // Regex is WC3 basic email regex
            if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                $errorStatus = true;
                $errorStatusMessage[] = "Email validation failed. Please enter a valid email address. e.g. 'yournamehere@gmail.com'.";
            } elseif (strlen($Email) > 320) {
                $errorStatus = true;
                $errorStatusMessage[] = "Email validation failed. Server email length limit exceeded, please use an alternate email address of 50 bytes or less.";
            }

            // Phone Number validation
            if (!preg_match("/[\d ]{8,12}/", $Phone)) {
                $errorStatus = true;
                $errorStatusMessage[] = "Phone Number validation failed. Please enter a valid phone number of 8 to 12 digits.";
            }

            // if error occured, assign error message
            if ($errorStatus) {
                $errorMessage = "<p>Input Validation Failure: </p>\n";
                foreach($errorStatusMessage as $message) {
                    $errorMessage .= "<p>" . $message . "</p>\n";
                }
            }

            // If no errors, attempt connection and upload to database
            if (!$errorStatus) {
                // Create connection
                $db_connect = mysqli_connect($host, $user, $pswd, $dbnm);
                // Check connection
                if ($db_connect->connect_errno) {
                    $e = new \Exception;
                    die("<p>Failure: Unable to execute the query.</p>"
                        . "<p>Error code " . $db_connect->errno
                        . ": " . $db_connect->error . "</p>"
                        . "<pre>". var_dump($e->getTraceAsString()) . "</pre>");
                    }

                // Set query to create EOI Table if it doesn't exist
                $query = "CREATE TABLE IF NOT EXISTS eoi ("
                    . "EOInumber int(12) NOT NULL AUTO_INCREMENT,"
                    . "job_reference VARCHAR(10) NOT NULL,"
                    . "first_name VARCHAR(20) NOT NULL,"
                    . "last_name VARCHAR(20) NOT NULL,"
                    . "dob DATE NOT NULL,"
                    . "gender ENUM('m', 'f', 'u') NOT NULL,"
                    . "street_address VARCHAR(40) NOT NULL,"
                    . "suburb VARCHAR(40) NOT NULL,"
                    . "state CHAR(3) NOT NULL,"
                    . "postcode CHAR(4) NOT NULL,"
                    . "email VARCHAR(320) NOT NULL,"
                    . "phone VARCHAR(12) NOT NULL,"
                    . "skills varchar(200) NOT NULL,"
                    . "other_skills VARCHAR(200),"
                    . "status ENUM('new','current','final') NOT NULL DEFAULT 'New',"
                    . "PRIMARY KEY (EOInumber));";

                // Execute query
                if (!$db_connect->query($query)) {
                    $e = new \Exception;
                    die("<p>Failure: Unable to execute the query.</p>"
                        . "<p>Error code " . $db_connect->errno
                        . ": " . $db_connect->error . "</p>"
                        . "<pre>". var_dump($e->getTraceAsString()) . "</pre>");
                }
                // Prepare the date for MySQL
                $BirthDate = date('Y-m-d', strtotime($BirthDate));
                // Prepare the skills array for MySQL
                $Skills = implode(' ', $Skills);
                // Prepare SQL query
                $query = "INSERT INTO EOI (job_reference, first_name, last_name, dob, gender, street_address, suburb, state, postcode, email, phone, skills, other_skills)
                VALUES ('$JobRefNo', '$FirstName', '$LastName', STR_TO_DATE('$BirthDate', '%Y-%m-%d'), '$Gender', '$StreetAddress', '$SuburbAddress', '$State', '$PostCode', '$Email', '$Phone', '$Skills', '$OtherSkills');";
                // Execute Insert query
                if (!$db_connect->query($query)) {
                    $e = new \Exception;
                    
                    die("<p>Failure: Unable to execute the query.</p>"
                        . "<p>Query: " . $query . "</p>"
                        . "<p>Error code " . $db_connect->errno
                        . ": " . $db_connect->error . "</p>"
                        . "<pre>". var_dump($e->getTraceAsString()) . "</pre>");
                }

                $selectQuery = "SELECT EOInumber FROM EOI WHERE job_reference LIKE '$JobRefNo' AND first_name LIKE '$FirstName' AND last_name LIKE '$LastName' AND dob = STR_TO_DATE('$BirthDate', '%Y-%m-%d');";
                // Execute Select query
                $queryResult = false;
                if (!$queryResult = $db_connect->query($selectQuery)) {
                    $e = new \Exception;
                    
                    die("<p>Failure: Unable to execute the query.</p>"
                        . "<p>Error code " . $db_connect->errno
                        . ": " . $db_connect->error . "</p>"
                        . "<pre>". var_dump($e->getTraceAsString()) . "</pre>");
                }

                $row = $queryResult->fetch_row();
                header('refresh: 5; url=job_application_success.php');
                echo("<p>Application Successful. Your application number is: {$row[0]}. You are being redirected in 5s, thank you for your application.</p>");
            }
            // echo errorMessage from previous session
            echo($errorMessage);
            // reset errorMessage
            $errorMessage = '';
        } else {
        $errorMessage .= "<p>Registration failed: Please ensure all fields are filled.</p>";
        }

        // echo errorMessage from previous session
        echo($errorMessage);
        // reset errorMessage
        $errorMessage = '';

        // Debug Print Application Input Values
        if ($_SESSION['debug']) {
            echo("<p>Job Ref No: " . $JobRefNo . "</p>" . 
            "<p>Name: " . $FirstName . " " . $LastName . "</p>" . 
            "<p>Birth Date: " . $BirthDate . "</p>" . 
            "<p>Gender: " . $Gender . "</p>" . 
            "<p>Address: " . $StreetAddress . ", " . $SuburbAddress . ", " . $State . ", " . $PostCode . "</p>" . 
            "<p>Email: " . $Email . "</p>" . 
            "<p>Phone: " . $Phone . "</p>" . 
            "<p>Other Skills: " . $OtherSkills . "</p>");
            echo("<p>");
            print_r($Skills);
            echo("</p>");
        }
    } else {
        header("refresh: 3; url=apply.php");
        echo("<p>You are being redirected. Please apply through the form provided.</p>");
    }
?>