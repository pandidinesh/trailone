function sendMsg() {
  let msg = document.getElementById("userInput").value;
  if(msg === "") return;

  let chat = document.getElementById("chat");
  chat.innerHTML += "<div class='user'>You: " + msg + "</div>";

  fetch("chat.php", {
    method: "POST",
    headers: {"Content-Type": "application/x-www-form-urlencoded"},
    body: "message=" + msg
  })
  .then(res => res.text())
  .then(data => {
    chat.innerHTML += "<div class='bot'>Bot: " + data + "</div>";
    chat.scrollTop = chat.scrollHeight;
  });

  document.getElementById("userInput").value = "";
}
