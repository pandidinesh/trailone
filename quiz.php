<?php
$conn = mysqli_connect("localhost","root","","classroom");

$result = mysqli_query($conn,"SELECT * FROM questions ORDER BY RAND()");
?>

<!DOCTYPE html>
<html>
<head>
<title>Quiz</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<form action="result.php" method="POST">
<div class="box">

<h2>Answer All Questions</h2>

<?php
$i=1;
while($row=mysqli_fetch_assoc($result)){
?>

<p><b><?php echo $i.". ".$row['question']; ?></b></p>

<input type="radio" name="q<?php echo $row['id']; ?>" value="<?php echo $row['option1']; ?>" required> <?php echo $row['option1']; ?><br>
<input type="radio" name="q<?php echo $row['id']; ?>" value="<?php echo $row['option2']; ?>"> <?php echo $row['option2']; ?><br>
<input type="radio" name="q<?php echo $row['id']; ?>" value="<?php echo $row['option3']; ?>"> <?php echo $row['option3']; ?><br>
<input type="radio" name="q<?php echo $row['id']; ?>" value="<?php echo $row['option4']; ?>"> <?php echo $row['option4']; ?><br>

<hr>

<?php
$i++;
}
?>

<button type="submit">Submit</button>

</div>
</form>

</body>
</html>