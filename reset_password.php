<?php
$conn = mysqli_connect("localhost","root","","classroom");

if(!isset($_GET['email'])){
    header("Location: index.php");
    exit;
}

$email = $_GET['email'];

if(isset($_POST['update'])){
    $newpass = $_POST['newpass'];

    mysqli_query($conn,"UPDATE users SET password='$newpass' WHERE email='$email'");

    echo "<script>alert('Password Updated Successfully'); window.location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Reset Password</title>
</head>
<body>

<h2>Set New Password</h2>

<form method="POST">
<input type="password" name="newpass" placeholder="Enter new password" required>
<button type="submit" name="update">Update Password</button>
</form>

</body>
</html>