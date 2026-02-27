<?php
$conn = mysqli_connect("localhost","root","","filedb");

$result = mysqli_query($conn,"SELECT * FROM uploads");

while($row = mysqli_fetch_assoc($result)){
    echo "<a href='".$row['filepath']."' target='_blank'>
          ".$row['filename']."
          </a><br>";
}
?>
