<<<<<<< HEAD
<?php
$conn = mysqli_connect("localhost","root","","filedb");

// DELETE FILE
if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $get = mysqli_query($conn,"SELECT * FROM uploads WHERE id=$id");
    $row = mysqli_fetch_assoc($get);

    if(file_exists($row['filepath'])){
        unlink($row['filepath']);
    }

    mysqli_query($conn,"DELETE FROM uploads WHERE id=$id");
}

// DATE FILTER
$date_filter = "";
if(isset($_GET['date'])){
    $date = $_GET['date'];
    $date_filter = "WHERE created_at >= '$date 00:00:00' 
                    AND created_at <= '$date 23:59:59'";
}

$result = mysqli_query($conn,"SELECT * FROM uploads $date_filter ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Calendar File Viewer</title>
<style>
body{
    font-family: Arial;
    background:#f2f2f2;
    text-align:center;
    background-image: url("https://as2.ftcdn.net/jpg/04/06/24/59/1000_F_406245971_GRuEzVO3WIDa32dqwv96N1puvCYpGUPM.jpg");
}
.box{
    background:white;
    padding:20px;
    width:500px;
    margin:20px auto;
    border-radius:10px;
    box-shadow:0 0 10px gray;
}
button{
    padding:8px 15px;
    background:blue;
    color:white;
    border:none;
    cursor:pointer;
}
a{
    text-decoration:none;
    color:green;
}
.delete{
    color:red;
}
</style>
</head>
<body>

<div class="box">

<h3>Select Date to View Files</h3>
<form method="GET">
    <input type="date" name="date" required>
    <button type="submit">Show Files</button>
</form>

<hr>

<h3>Uploaded Files</h3>

<?php
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        echo "<p>";
        echo "<a href='".$row['filepath']."' target='_blank'>".$row['filename']."</a>";
        echo " | <small>".$row['created_at']."</small>";
        echo " | <a class='delete' href='?delete=".$row['id']."'>Delete</a>";
        echo "</p>";
    }
} else {
    echo "<p style='color:red;'>No files found for selected date</p>";
}
?>

</div>

</body>
=======
<?php
$conn = mysqli_connect("localhost","root","","filedb");

// DELETE FILE
if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $get = mysqli_query($conn,"SELECT * FROM uploads WHERE id=$id");
    $row = mysqli_fetch_assoc($get);

    if(file_exists($row['filepath'])){
        unlink($row['filepath']);
    }

    mysqli_query($conn,"DELETE FROM uploads WHERE id=$id");
}

// DATE FILTER
$date_filter = "";
if(isset($_GET['date'])){
    $date = $_GET['date'];
    $date_filter = "WHERE created_at >= '$date 00:00:00' 
                    AND created_at <= '$date 23:59:59'";
}

$result = mysqli_query($conn,"SELECT * FROM uploads $date_filter ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Calendar File Viewer</title>
<style>
body{
    font-family: Arial;
    background:#f2f2f2;
    text-align:center;
}
.box{
    background:white;
    padding:20px;
    width:500px;
    margin:20px auto;
    border-radius:10px;
    box-shadow:0 0 10px gray;
}
button{
    padding:8px 15px;
    background:blue;
    color:white;
    border:none;
    cursor:pointer;
}
a{
    text-decoration:none;
    color:green;
}
.delete{
    color:red;
}
</style>
</head>
<body>

<div class="box">

<h3>Select Date to View Files</h3>
<form method="GET">
    <input type="date" name="date" required>
    <button type="submit">Show Files</button>
</form>

<hr>

<h3>Uploaded Files</h3>

<?php
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        echo "<p>";
        echo "<a href='".$row['filepath']."' target='_blank'>".$row['filename']."</a>";
        echo " | <small>".$row['created_at']."</small>";
        echo " | <a class='delete' href='?delete=".$row['id']."'>Delete</a>";
        echo "</p>";
    }
} else {
    echo "<p style='color:red;'>No files found for selected date</p>";
}
?>

</div>

</body>
>>>>>>> 567c4a9d0bad21e248c6b18fd98bdf607e03f40c
</html>