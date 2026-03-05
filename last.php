<?php
session_start();

$conn = mysqli_connect("localhost","root","","whatsapp");
if(!$conn){
    die("Database Connection Failed");
}

/* ---------------- LOGIN ---------------- */
if(isset($_POST['login'])){
    $name  = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);

    if($name!="" && $email!=""){
        mysqli_query($conn,"INSERT IGNORE INTO users(name,email) VALUES('$name','$email')");
        $_SESSION['name']=$name;
        header("Location: last.php");
        exit;
    }
}

/* ---------------- LOGOUT ---------------- */
if(isset($_GET['logout'])){
    session_destroy();
    header("Location: last.php");
    exit;
}

/* ---------------- SEND MESSAGE ---------------- */
if(isset($_POST['send'])){
    if(isset($_SESSION['name']) && isset($_POST['receiver'])){
        $sender   = $_SESSION['name'];
        $receiver = mysqli_real_escape_string($conn,$_POST['receiver']);
        $message  = mysqli_real_escape_string($conn,$_POST['message']);

        if($message!=""){
            mysqli_query($conn,"INSERT INTO messages(sender,receiver,message)
            VALUES('$sender','$receiver','$message')");
            header("Location: last.php?chat=".$receiver);
            exit;
        }
    }
}

/* ---------------- IF NOT LOGIN ---------------- */
if(!isset($_SESSION['name'])){
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<body>
<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    height:100vh;
    overflow:hidden;
    font-family:Arial;
    display:flex;
    justify-content:center;
    align-items:center;
}

/* Animated Background */
.background{
    position:fixed;
    width:100%;
    height:100%;
    background-image: url("https://media.istockphoto.com/id/1945538809/vector/speech-bubble-talking-chatting-quote-communication-abstract-background.jpg?s=612x612&w=0&k=20&c=eG7i2WH3JOmjaKP6FfK7B36VTK16QP0jvSaUW8DOpHY=");
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    animation: zoomBg 20s infinite alternate ease-in-out;
    z-index:-1;
}

/* Zoom Animation */
@keyframes zoomBg{
    0%{ transform: scale(1); }
    100%{ transform: scale(1.1); }
}

/* Login Form Style */
form{
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    padding:30px;
    border-radius:15px;
    box-shadow:0 8px 32px rgba(0,0,0,0.3);
    text-align:center;
}

input{
    padding:10px;
    margin:8px;
    width:250px;
    border:none;
    border-radius:5px;
}

button{
    padding:10px 20px;
    background:#075e54;
    color:white;
    border:none;
    border-radius:5px;
}
input{padding:10px;margin:5px;width:250px;}
button{padding:10px 20px;background:green;color:white;border:none;}
</style>
</head>
<body>
<div class="background"></div>

<form method="POST">
<input type="text" name="name" placeholder="Enter Name" required><br>
<input type="email" name="email" placeholder="Enter Email" required><br>
<button type="submit" name="login">Login</button>
</form>

</body>
</html>
<?php
exit;
}

$me = $_SESSION['name'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Chat</title>
<style>
body{margin:0;font-family:Arial;background:#ece5dd;}
.header{background:#075e54;color:white;padding:15px;}
.container{display:flex;height:90vh;}
.users{width:30%;background:white;border-right:1px solid #ccc;overflow-y:auto;}
.users a{display:block;padding:10px;text-decoration:none;color:black;border-bottom:1px solid #eee;}
.users a:hover{background:#f1f1f1;}
.chatbox{width:70%;display:flex;flex-direction:column;}
.messages{flex:1;padding:10px;overflow-y:auto;background:#e5ddd5;}
.msg{margin:5px;padding:8px;border-radius:5px;max-width:60%;}
.me{background:#dcf8c6;margin-left:auto;}
.other{background:white;}
.sendbox{padding:10px;background:#f0f0f0;}
.sendbox input{padding:8px;width:75%;}
.sendbox button{padding:8px;background:#075e54;color:white;border:none;}
</style>
</head>
<body>

<div class="header">
Welcome <?php echo $me; ?> |
<a href="last.php?logout=1" style="color:white;">Logout</a>
</div>

<div class="container">

<!-- USERS -->
<div class="users">
<h3 style="padding:10px;">Members</h3>
<?php
$users = mysqli_query($conn,"SELECT * FROM users WHERE name!='$me'");
while($u = mysqli_fetch_assoc($users)){
    echo "<a href='last.php?chat=".$u['name']."'>".$u['name']."</a>";
}
?>
</div>

<!-- CHAT AREA -->
<div class="chatbox">

<div class="messages">
<?php
if(isset($_GET['chat'])){
    $chat = mysqli_real_escape_string($conn,$_GET['chat']);

    $msgs = mysqli_query($conn,"SELECT * FROM messages 
    WHERE (sender='$me' AND receiver='$chat') 
    OR (sender='$chat' AND receiver='$me')
    ORDER BY id ASC");

    while($m = mysqli_fetch_assoc($msgs)){
        if($m['sender']==$me){
            echo "<div class='msg me'>".$m['message']."</div>";
        }else{
            echo "<div class='msg other'>".$m['message']."</div>";
        }
    }
}
?>
</div>

<?php if(isset($_GET['chat'])){ ?>
<div class="sendbox">
<form method="POST">
<input type="hidden" name="receiver" value="<?php echo $_GET['chat']; ?>">
<input type="text" name="message" placeholder="Type message..." required>
<button type="submit" name="send">Send</button>
</form>
</div>
<?php } ?>

</div>
</div>

</body>
</html>