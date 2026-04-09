<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Classroom | Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', sans-serif; }
        body {
            background-image: url("https://png.pngtree.com/thumb_back/fh260/background/20250116/pngtree-digital-classroom-board-mockup-blank-white-screen-for-education-image_16917748.jpg");
            background-size: cover; background-position: center; background-attachment: fixed;
            height: 100vh; display: flex; justify-content: center; align-items: center;
        }
        .container { background: rgba(255, 255, 255, 0.95); width: 100%; max-width: 400px; padding: 30px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.3); }
        .form-title { text-align: center; margin-bottom: 25px; color: #333; }
        .input-group { position: relative; margin-bottom: 20px; }
        .input-group i { position: absolute; left: 12px; top: 15px; color: #666; }
        .input-group input { width: 100%; padding: 12px 12px 12px 40px; border: 1px solid #ccc; border-radius: 8px; outline: none; font-size: 15px; }
        .btn { width: 100%; padding: 12px; background: #2563eb; color: white; border: none; border-radius: 8px; font-size: 17px; font-weight: 600; cursor: pointer; transition: 0.3s; }
        .btn:hover { background: #1d4ed8; }
        .or { text-align: center; margin: 15px 0; color: #777; }
        .icons { display: flex; justify-content: center; gap: 20px; margin-bottom: 20px; }
        .links { text-align: center; margin-top: 15px; font-size: 14px; }
        .links button { background: none; border: none; color: #2563eb; font-weight: 700; cursor: pointer; text-decoration: underline; }
    </style>
</head>
<body>

    <div class="container" id="signup" style="display:none;">
        <h1 class="form-title">Register</h1>
        <form id="regForm">
            <div class="input-group"><i class="fas fa-user"></i><input type="text" id="regFName" placeholder="First Name" required></div>
            <div class="input-group"><i class="fas fa-envelope"></i><input type="email" id="regEmail" placeholder="Email" required></div>
            <div class="input-group"><i class="fas fa-lock"></i><input type="password" id="regPass" placeholder="Password" required></div>
            <p style="font-size: 11px; color: #666; margin-bottom: 10px;">*8+ chars, 1 Capital, 1 Symbol</p>
            <input type="submit" class="btn" value="Sign Up">
        </form>
        <p class="or">----------or--------</p>
        <div class="links"><p>Already Have Account? <button onclick="toggleForm('signin')">Sign In</button></p></div>
    </div>

    <div class="container" id="signIn">
        <h1 class="form-title">Sign In</h1>
        <form id="loginForm">
            <div class="input-group"><i class="fas fa-envelope"></i><input type="email" id="logEmail" placeholder="Email" required></div>
            <div class="input-group"><i class="fas fa-lock"></i><input type="password" id="logPass" placeholder="Password" required></div>
            <input type="submit" class="btn" value="Sign In">
        </form>
        <p class="or">----------or--------</p>
        <div class="links"><p>Don't have account yet? <button onclick="toggleForm('signup')">Sign Up</button></p></div>
    </div>

    <script>
        function toggleForm(type) {
            document.getElementById('signup').style.display = (type === 'signup') ? 'block' : 'none';
            document.getElementById('signIn').style.display = (type === 'signin') ? 'block' : 'none';
        }

        document.getElementById('regForm').onsubmit = function(e) {
            e.preventDefault();
            const name = document.getElementById('regFName').value;
            const email = document.getElementById('regEmail').value;
            const pass = document.getElementById('regPass').value;

            const passRegex = /^(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.{8,})/;
            if(!passRegex.test(pass)) {
                alert("Security Alert: Password must have 8 chars, 1 Uppercase, and 1 Symbol.");
                return;
            }

            localStorage.setItem(email, JSON.stringify({ name, email, pass }));
            alert("Registration Successful! Please Sign In.");
            toggleForm('signin');
        };

        document.getElementById('loginForm').onsubmit = function(e) {
            e.preventDefault();
            const email = document.getElementById('logEmail').value;
            const pass = document.getElementById('logPass').value;
            const storedUser = localStorage.getItem(email);

            if (storedUser) {
                const user = JSON.parse(storedUser);
                if (user.pass === pass) {
                    // Save session data
                    localStorage.setItem('loggedInUser', user.name);
                    // REDIRECT TO DASHBOARD
                    window.location.href = "dashboard.html";
                } else {
                    alert("Incorrect Password!");
                }
            } else {
                alert("Email not found!");
            }
        };
    </script>
</body>
</html>