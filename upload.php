<<<<<<< HEAD
<?php
$conn = mysqli_connect("localhost","root","","filedb");
if(!$conn){ die("Connection Failed"); }

// 🔥 Get class name from URL
$className = $_GET['class'] ?? '';

if(isset($_POST['upload'])){

    $fileName = $_FILES['file']['name'];
    $tmpName  = $_FILES['file']['tmp_name'];

    $uploadPath = "uploads/" . basename($fileName);

    if(move_uploaded_file($tmpName, $uploadPath)){

        $stmt = mysqli_prepare($conn,
            "INSERT INTO uploads (filename, filepath, class_name, created_at) 
             VALUES (?, ?, ?, NOW())");

        mysqli_stmt_bind_param($stmt,"sss",
            $fileName,
            $uploadPath,
            $className
        );

        mysqli_stmt_execute($stmt);

        // 🔥 After upload go back to same classroom
        header("Location: classroom.php?class=" . urlencode($className));
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Upload File</title>
<style>
body{
     background-image: url("https://as1.ftcdn.net/jpg/02/16/47/50/1000_F_216475029_YEdkzXdw97bvK9OioWRwRjfPG1IQkP69.jpg");
    color:white;
    font-family:Arial;
    padding:20px;
}
button{
    padding:8px 15px;
    background:#1e88e5;
    border:none;
    color:white;
}
</style>
</head>
<body>
<center>
<h2>Upload File - <?php echo htmlspecialchars($className); ?></h2>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="file" required>
    <br><br>
    <button type="submit" name="upload">Upload</button>
</form>
</center>
</body>
=======
<?php
$conn = mysqli_connect("localhost","root","","filedb");
if(!$conn){ die("Connection Failed"); }

// 🔥 Get class name from URL
$className = $_GET['class'] ?? '';

if(isset($_POST['upload'])){

    $fileName = $_FILES['file']['name'];
    $tmpName  = $_FILES['file']['tmp_name'];

    $uploadPath = "uploads/" . basename($fileName);

    if(move_uploaded_file($tmpName, $uploadPath)){

        $stmt = mysqli_prepare($conn,
            "INSERT INTO uploads (filename, filepath, class_name, created_at) 
             VALUES (?, ?, ?, NOW())");

        mysqli_stmt_bind_param($stmt,"sss",
            $fileName,
            $uploadPath,
            $className
        );

        mysqli_stmt_execute($stmt);

        // 🔥 After upload go back to same classroom
        header("Location: classroom.php?class=" . urlencode($className));
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Upload File</title>
<style>
body{
    background:#121212;
    color:white;
    font-family:Arial;
    padding:20px;
}
button{
    padding:8px 15px;
    background:#1e88e5;
    border:none;
    color:white;
}
</style>
</head>
<body>

<h2>Upload File - <?php echo htmlspecialchars($className); ?></h2>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="file" required>
    <br><br>
    <button type="submit" name="upload">Upload</button>
</form>

</body>
>>>>>>> 567c4a9d0bad21e248c6b18fd98bdf607e03f40c
</html>