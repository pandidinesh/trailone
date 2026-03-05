<?php
$conn = mysqli_connect("localhost","root","","filedb");

if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}

$message = "";

/* ================= UPLOAD ================= */
if(isset($_POST['upload'])){

    if(isset($_FILES['myfile']) && $_FILES['myfile']['error'] == 0){

        $filename = $_FILES['myfile']['name'];
        $tmpname  = $_FILES['myfile']['tmp_name'];
        $folder = "uploads/".$filename;

        if(move_uploaded_file($tmpname, $folder)){

            $stmt = $conn->prepare("INSERT INTO uploads (filename, filepath) VALUES (?, ?)");
            $stmt->bind_param("ss", $filename, $folder);
            $stmt->execute();

            $message = "File uploaded successfully!";
        }
    }
}


/* ================= DELETE ONLY CLICKED FILE ================= */
if(isset($_POST['delete'])){

    $id = intval($_POST['file_id']);

    // Get file path safely
    $stmt = $conn->prepare("SELECT filepath FROM uploads WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if($row){

        $filepath = $row['filepath'];

        // Delete file from folder
        if(file_exists($filepath)){
            unlink($filepath);
        }

        // Delete from DB
        $stmt = $conn->prepare("DELETE FROM uploads WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $message = "Selected file deleted successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload & Delete Single File</title>
    <style>
        body{
            background:#f2f2f2;
            font-family: Arial;
            text-align:center;
        }

        .box{
            background:white;
            width:550px;
            margin:40px auto;
            padding:20px;
            border-radius:10px;
            box-shadow:0 0 10px gray;
        }

        button{
            padding:6px 12px;
            border:none;
            border-radius:5px;
            cursor:pointer;
        }

        .upload-btn{
            background:green;
            color:white;
        }

        .delete-btn{
            background:red;
            color:white;
        }

        table{
            width:100%;
            margin-top:20px;
            border-collapse:collapse;
        }

        th, td{
            border:1px solid #ccc;
            padding:8px;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Upload File</h2>

    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="myfile" required>
        <button type="submit" name="upload" class="upload-btn">Upload</button>
    </form>

    <p style="color:green;"><?php echo $message; ?></p>

    <h3>Uploaded Files</h3>

    <table>
        <tr>
            <th>ID</th>
            <th>File Name</th>
            <th>Open</th>
            <th>Delete</th>
        </tr>

        <?php
        $result = mysqli_query($conn, "SELECT * FROM uploads ORDER BY id DESC");

        while($row = mysqli_fetch_assoc($result)){
        ?>

        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['filename']; ?></td>
            <td>
                <a href="<?php echo $row['filepath']; ?>" target="_blank">Open</a>
            </td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="file_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="delete" class="delete-btn"
                        onclick="return confirm('Delete this file?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>