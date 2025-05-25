<?php
require_once("./settings.php");
$conn = mysqli_connect($host,$u_name,$u_password,$db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$login_id = "105699937";
$password = "root";
$manager_name = "Tanvir Rahman Tonoy";
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO managers (login_id, password, name) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "sss", $login_id, $hashedPassword,$manager_name);

if (mysqli_stmt_execute($stmt)) {
    echo "🎉 Manager added successfully!";
} else {
    echo "❌ Error: " . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>