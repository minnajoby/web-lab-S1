<?php
$servername = "localhost";  
$username = "root";         
$password = "";             
$dbname = "weblab";     

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$student_id = $password = "";
$login_success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $student_id = $_POST['student_id'];
    $password = $_POST['password'];

    // Fetch user from the database
    $sql = "SELECT * FROM login WHERE student_id = '$student_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password
        if ($row['password'] === $password) { // In a real application, use password_hash() and password_verify()
            header("Location:home.php");
        } else {
            echo "<script>alert('Invalid password.');</script>";
        }
    } else {
        echo "<script>alert('No user found with that student id.');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>login</title>
</head>
<body>
<center>
<h2>LOGIN</h2>
<form method="POST" action="">
	Student ID : <input type="number" name="student_id" required><br><br>
        Password : <input type="password" name="password" required><br><br>
	<input type="submit" name="login" value="Login">
</form>

</body>
</html>
