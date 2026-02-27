<?php
include "db.php";

if(isset($_FILES['file'])){
    $filename = time() . "_" . $_FILES['file']['name'];
    $tempname = $_FILES['file']['tmp_name'];

    $folder = "uploads/".$filename;

    if(move_uploaded_file($tempname, $folder)){
        mysqli_query($conn,
            "INSERT INTO materials(filename) VALUES('$filename')"
        );

        echo $filename; // JS-ku return
    }
}
?>
