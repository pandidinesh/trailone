<?php
$conn = mysqli_connect("localhost","root","","classroom");

$result = mysqli_query($conn,"SELECT * FROM questions");

$score = 0;
$total = mysqli_num_rows($result);

while($row=mysqli_fetch_assoc($result)){
    $id = $row['id'];
    if(isset($_POST["q$id"])){
        if($_POST["q$id"] == $row['correct_answer']){
            $score++;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Result</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
    <center>

<div class="box">
<h2>Your Score</h2>

<h1><?php echo $score." / ".$total; ?></h1>

<?php
if($score >= 4){
    echo "<p style='color:green;'>Excellent 🎉</p>";
}else{
    echo "<p style='color:red;'>Need Improvement</p>";
}
?>

<a href="quiz.php"><button>Retry</button></a>

</div>
</center>
</body>
</html>