<?php
$conn = mysqli_connect("localhost","root","","classroom");

if(!$conn){
    die("Database connection failed");
}

/* FILE UPLOAD */
if(isset($_POST['upload']) && isset($_FILES['myfile'])){

    $filename = uniqid()."_".$_FILES['myfile']['name'];
    $tmpname  = $_FILES['myfile']['tmp_name'];
    $folder   = "uploads/".$filename;

    if(move_uploaded_file($tmpname, $folder)){
        
        $sql = "INSERT INTO materials (filename, filepath)
                VALUES ('$filename', '$folder')";
        mysqli_query($conn, $sql);

        // 🔥 Prevent duplicate on refresh
        header("Location: stream.php");
        exit();
    }
}

/* FETCH FILES */
$result = mysqli_query($conn,"SELECT * FROM materials ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Classroom Stream</title>
<style>
body{
    margin:0;
    background:#121212;
    font-family:Arial;
    color:#fff;
}
.header{
    padding:15px;
    background:#1f1f1f;
    font-size:18px;
}
.upload-box{
    padding:15px;
    background:#1f1f1f;
}
.stream{
    padding:15px;
}
.card{
    background:#1e1e1e;
    border-radius:12px;
    padding:15px;
    margin-bottom:15px;
}
.title{
    font-size:16px;
    font-weight:bold;
}
.date{
    font-size:13px;
    color:#aaa;
    margin-top:4px;
}
button{
    background:#4da3ff;
    color:#fff;
    border:none;
    padding:6px 12px;
    border-radius:6px;
}
a{
    color:#4da3ff;
}
</style>
</head>
<body>

<div class="header">📘 Classroom</div>

<div class="upload-box">
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="myfile" required>
    <button type="submit" name="upload">Upload</button>
</form>
</div>

<div class="stream">

<?php while($row = mysqli_fetch_assoc($result)){ ?>

    <div class="card">
        <div class="title">
            New material: <?php echo $row['filename']; ?>
        </div>
        <div class="date">
            <?php echo date("d M Y", strtotime($row['uploaded_at'])); ?>
        </div>
        <div>
            <a href="<?php echo $row['filepath']; ?>" target="_blank">Open File</a>
        </div>
    </div>

<?php } ?>

</div>

</body>
</html>