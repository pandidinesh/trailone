<?php
include "db.php";
$data = mysqli_query($conn,"SELECT * FROM materials ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Classroom</title>

<style>
body{
    margin:0;
    background:#121212;
    font-family:Arial;
    color:white;
}
.header{
    background:#1f1f1f;
    padding:15px;
}
.upload-box{
    background:#1e1e1e;
    margin:15px;
    padding:15px;
    border-radius:12px;
}
.card{
    background:#1e1e1e;
    margin:15px;
    padding:15px;
    border-radius:12px;
}
button{
    background:#2f80ed;
    color:white;
    border:none;
    padding:8px 15px;
    border-radius:8px;
    cursor:pointer;
}
input[type=file]{
    color:white;
}
a{
    color:#4da3ff;
    text-decoration:none;
}
</style>
</head>

<body>

<div class="header">
    <h3>📘 Classroom</h3>
</div>

<div class="upload-box">
    <input type="file" id="file">
    <button onclick="uploadFile()">Upload</button>
</div>

<div id="list">
<?php while($row = mysqli_fetch_assoc($data)){ ?>
    <div class="card">
        📄 New material:
        <a href="uploads/<?= $row['filename'] ?>" target="_blank">
            <?= $row['filename'] ?>
        </a><br>
        <small><?= $row['uploaded_on'] ?></small>
    </div>
<?php } ?>
</div>

<script>
function uploadFile(){

    let fileInput = document.getElementById("file");
    let file = fileInput.files[0];   // IMPORTANT

    if(!file){
        alert("File select pannunga");
        return;
    }

    let formData = new FormData();
    formData.append("file", file);

    fetch("upload_ajax.php",{
        method:"POST",
        body: formData
    })
    .then(res => res.text())
    .then(filename => {

        if(filename === "Upload failed"){
            alert("Upload failed");
            return;
        }

        let div = document.createElement("div");
        div.className = "card";
        div.innerHTML =
        `📄 New material:
         <a href="uploads/${filename}" target="_blank">${filename}</a>`;

        document.getElementById("list").prepend(div);
        fileInput.value = "";
    })
    .catch(err => {
        console.log(err);
        alert("Error uploading file");
    });
}
</script>

</body>
</html>
