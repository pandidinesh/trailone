




<?php
$conn = mysqli_connect("localhost","root","","filedb");
if(!$conn){ die("Connection Failed"); }

/* GET CLASS NAME */
$className = $_GET['class'] ?? '';

/* DELETE FUNCTION */
if(isset($_GET['delete'])){
    $id = intval($_GET['delete']);

    $res = mysqli_query($conn,"SELECT * FROM uploads WHERE id=$id AND class_name='$className'");
    $file = mysqli_fetch_assoc($res);

    if($file){
        if(file_exists($file['filepath'])){
            unlink($file['filepath']);
        }
        mysqli_query($conn,"DELETE FROM uploads WHERE id=$id");
    }

    header("Location: classroom.php?class=".urlencode($className));
    exit();
}

/* DATE FILTER */
$dateFilter = "";
if(isset($_GET['date'])){
    $selectedDate = $_GET['date'];
    $dateFilter = "AND DATE(created_at) = '$selectedDate'";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo htmlspecialchars($className); ?> Classroom</title>

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

.stream{
    padding:15px;
    margin-bottom:70px;
}

.card{
    background:#1e1e1e;
    border-radius:12px;
    padding:15px;
    margin-bottom:15px;
    box-shadow:0 0 8px black;
    position:relative;
}

.top-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.menu-container{ position:relative; }

.menu-btn{
    background:none;
    border:none;
    color:white;
    font-size:22px;
    cursor:pointer;
}

.dropdown-menu{
    display:none;
    position:absolute;
    right:0;
    top:30px;
    background:white;
    color:black;
    border-radius:5px;
    min-width:100px;
}

.dropdown-menu a{
    display:block;
    padding:10px;
    text-decoration:none;
    color:black;
}

.dropdown-menu a:hover{ background:#eee; }

.date{
    font-size:13px;
    color:#aaa;
    margin-top:4px;
}

.comment{
    margin-top:12px;
    border-top:1px solid #333;
    padding-top:10px;
    color:#888;
    font-size:14px;
}

.nav{
    position:fixed;
    bottom:0;
    width:100%;
    display:flex;
    justify-content:space-around;
    background:#1f1f1f;
    padding:10px 0;
}

.active{
    color:#4da3ff;
    font-weight:bold;
}

a{
    color:#4da3ff;
    text-decoration:none;
}
</style>

</head>
<body>

<div class="header">📘 <?php echo htmlspecialchars($className); ?> Classroom</div>

<div class="stream">

<?php
// 🔥 CLASS FILTER + DATE FILTER
$query = "SELECT * FROM uploads WHERE class_name='$className' $dateFilter ORDER BY id DESC";
$result = mysqli_query($conn,$query);

while($row = mysqli_fetch_assoc($result)){
?>

<div class="card">

    <div class="top-row">

        <div>
            <div style="font-weight:bold;">
                New material:
                <a href="<?php echo $row['filepath']; ?>" target="_blank">
                    <?php echo $row['filename']; ?>
                </a>
            </div>

            <div class="date">
                <?php echo date("d M Y", strtotime($row['created_at'])); ?>
            </div>
        </div>

        <!-- 3 DOTS -->
        <div class="menu-container">
            <button class="menu-btn" onclick="toggleMenu(this)">⋮</button>
            <div class="dropdown-menu">
                <a href="classroom.php?class=<?php echo urlencode($className); ?>&delete=<?php echo $row['id']; ?>">
                    Delete
                </a>
            </div>
        </div>

    </div>

    <div class="comment">Add class comment</div>

</div>

<?php } ?>

</div>

<div class="nav">
    <div class="active">Stream</div>
    <div><a href="quizz1.php">AI QUIZZ</a></div>
    <div>
        <a href="upload.php?class=<?php echo urlencode($className); ?>">
            Upload
        </a>
    </div>
</div>

<script>
function toggleMenu(button){
    let menu = button.nextElementSibling;
    menu.style.display = menu.style.display === "block" ? "none" : "block";
}
</script>

</body>
</html>