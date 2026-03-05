<?php
session_start();
$conn = mysqli_connect("localhost","root","","login_db");
if(!$conn){ die("DB Connection Failed"); }

if(!isset($_SESSION['email'])){
    header("Location:index.php"); exit;
}

$my_email = $_SESSION['email'];
$my_name  = $_SESSION['name'];

if(isset($_POST['action'])){
    if($_POST['action']=='get_members'){
        $res = mysqli_query($conn,"SELECT * FROM users WHERE is_online=1 AND email!='$my_email'");
        $members=[];
        while($row=mysqli_fetch_assoc($res)) $members[]=$row;
        echo json_encode($members); exit;
    }

    if($_POST['action']=='send_message'){
        $to = mysqli_real_escape_string($conn,$_POST['to']);
        $msg = mysqli_real_escape_string($conn,$_POST['msg']);
        mysqli_query($conn,"INSERT INTO messages (sender_email,receiver_email,message) VALUES ('$my_email','$to','$msg')");
        echo "ok"; exit;
    }

    if($_POST['action']=='get_messages'){
        $chat_with = mysqli_real_escape_string($conn,$_POST['chat_with']);
        $res = mysqli_query($conn,"SELECT * FROM messages WHERE (sender_email='$my_email' AND receiver_email='$chat_with') OR (sender_email='$chat_with' AND receiver_email='$my_email') ORDER BY created_at ASC");
        $msgs=[];
        while($row=mysqli_fetch_assoc($res)) $msgs[]=$row;
        echo json_encode($msgs); exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard Chat</title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>

    
#members { float:left; width:200px; border:1px solid #ccc; padding:10px; }
#chatBox { margin-left:220px; border:1px solid #ccc; padding:10px; width:400px; height:400px; overflow-y:auto; }
#msgInput { width:300px; }
.member { cursor:pointer; color:blue; text-decoration:underline; margin:5px 0; }
.msg-sent { color:green; }
.msg-received { color:blue; }
</style>
</head>
<body>

<h2>Welcome, <?php echo $my_name;?></h2>
<button onclick="logout()">Logout</button>

<h3>Members Online</h3>
<div id="members"></div>

<div id="chatBox">
<h3>Chat Box</h3>
<div id="chatContent"></div>
<input type="text" id="msgInput" placeholder="Type message">
<button id="sendBtn">Send</button>
</div>

<script>
let selectedMemberEmail = "";

function loadMembers(){
    $.post('dashboard.php',{action:'get_members'},function(data){
        let members = JSON.parse(data);
        let html='';
        members.forEach(m=>{
            html += `<div class="member" data-email="${m.email}">${m.first_name} ${m.last_name}</div>`;
        });
        $('#members').html(html);
    });
}

function loadMessages(){
    if(selectedMemberEmail=="") return;
    $.post('dashboard.php',{action:'get_messages', chat_with:selectedMemberEmail}, function(data){
        let msgs = JSON.parse(data);
        let html='';
        msgs.forEach(m=>{
            if(m.sender_email=="<?php echo $my_email;?>") html+=`<div class="msg-sent"><b>You:</b> ${m.message}</div>`;
            else html+=`<div class="msg-received"><b>${m.sender_email}:</b> ${m.message}</div>`;
        });
        $('#chatContent').html(html);
        $('#chatBox').scrollTop($('#chatBox')[0].scrollHeight);
    });
}

// Click member to chat
$(document).on('click','.member',function(){
    selectedMemberEmail = $(this).data('email');
    loadMessages();
});

// Send message
$('#sendBtn').click(function(){
    let msg=$('#msgInput').val();
    if(selectedMemberEmail=="" || msg==""){ alert("Select member & type message"); return; }
    $.post('dashboard.php',{action:'send_message', to:selectedMemberEmail, msg:msg}, function(res){
        $('#msgInput').val('');
        loadMessages();
    });
});

// Auto refresh
loadMembers();
setInterval(loadMembers,3000);
setInterval(loadMessages,2000);

function logout(){
    $.post('logout.php', {}, function(){
        window.location.href='index.php';
    });
}



</script>

</body>
</html>