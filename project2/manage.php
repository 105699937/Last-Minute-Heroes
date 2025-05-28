<?php 
// connecting this page to the server 
require_once("settings.php");
$conn = mysqli_connect($host,$user,$pswd,$dbnm);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}else{
    echo "server connected";
}


if($_SERVER['REQUEST_METHOD'] == "POST"){
    // do something :) 
}else{
    header("location:manager_login.php");
}

session_start();
// seting login_attempts 0 at initial point 
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

// checking if someone is trying to login with wrong info more than 3 times
if ($_SESSION['login_attempts'] >= 3) {
    header("location:frequent_login_attempts.php");
}

if(isset($_POST['login_id'])){
    $login_id = $_POST["login_id"];
    $password = $_POST["login_password"];
}
    $query = "CREATE TABLE IF NOT EXISTS managers ("
        . "id INT AUTO_INCREMENT PRIMARY KEY,"
        . "login_id VARCHAR(50) NOT NULL UNIQUE,"
        . "password VARCHAR(255) NOT NULL,"
        . "name VARCHAR(100),"
        . "created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);";

// Execute query
    if (!$conn->query($query)) {
            $e = new \Exception;
            die("<p>Failure: Unable to execute the query.</p>"
                . "<p>Error code " . $conn->errno
                . ": " . $conn->error . "</p>"
                . "<pre>". var_dump($e->getTraceAsString()) . "</pre>");
    }
    echo "table created"; 



    // I need to deal with this portion to log the manager in 
    $sql = "SELECT * FROM managers WHERE login_id = ?";
    $stmt = mysqli_prepare($conn, $sql);


    if(isset($login_id)){
        mysqli_stmt_bind_param($stmt, "s", $login_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) === 1) {
            $manager = mysqli_fetch_assoc($result);

            if (password_verify($password, $manager['password'])) {
                $_SESSION['login_attempts'] = 0; 
                $_SESSION['login_status'] = "success";
                $_SESSION['name'] = $manager['name'];
                header("location:hr_manager_tools.php");
            } else {
                $_SESSION['login_attempts'] += 1;
                echo"no manager found";
            }
        } else {
            $_SESSION['login_attempts'] += 1;
            header("location:manager_login.php");
        }
    }elseif(isset($_SESSION["login_status"])){
header("location:hr_manager_tools.php");
    }
    else{
        // $_SESSION['login_attempts'] += 1;
        header("location:manager_login.php");
    }
?>