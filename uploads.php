<?php
echo "<pre>";
print_r($_FILES);
echo "</pre>";
exit;
?>

//


<?php
$conn = mysqli_connect("localhost","root","","filedb");

if(isset($_FILES['myfile']) && $_FILES['myfile']['error'] == 0){

    $filename = $_FILES['myfile']['name'];
    $tmpname  = $_FILES['myfile']['tmp_name'];

    $folder = "uploads/".$filename;

    move_uploaded_file($tmpname, $folder);

    $sql = "INSERT INTO uploads (filename, filepath)
            VALUES ('$filename', '$folder')";
    mysqli_query($conn, $sql);

    echo "File uploaded successfully";

}else{
    echo "No file selected or file not received";
}
?>