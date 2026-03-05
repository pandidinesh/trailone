<?php
$conn = mysqli_connect("localhost","root","","classroom");

if(isset($_POST['reset'])){
    $email = $_POST['email'];

    $check = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($check) > 0){
        header("Location: reset_password.php?email=$email");
        exit;
    } else {
        $error = "Email not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Recover Password</title>
</head>
<body>

<h2>Recover Password</h2>

<form method="POST">
<input type="email" name="email" placeholder="Enter your email" required>
<button type="submit" name="reset">Next</button>
</form>

<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

</body>
</html>