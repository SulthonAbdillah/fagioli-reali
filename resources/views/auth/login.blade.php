<!DOCTYPE html>
<html>
<head>
<title>Login | Fagioli Reali</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
height:100vh;
display:flex;
align-items:center;
justify-content:center;
background:linear-gradient(135deg,#1e3c72,#2a5298);
}

.container{
width:400px;
background:white;
padding:40px;
border-radius:15px;
box-shadow:0 20px 50px rgba(0,0,0,0.2);
text-align:center;
}

h1{
margin-bottom:10px;
font-weight:600;
}

.subtitle{
color:gray;
margin-bottom:30px;
}

input{
width:100%;
padding:12px;
margin:10px 0;
border-radius:8px;
border:1px solid #ddd;
}

button{
width:100%;
padding:12px;
border:none;
border-radius:8px;
background:#2a5298;
color:white;
font-size:16px;
cursor:pointer;
margin-top:10px;
}

button:hover{
background:#1e3c72;
}

.register{
margin-top:20px;
}

.register a{
color:#2a5298;
text-decoration:none;
font-weight:600;
}

.logo{
font-size:22px;
font-weight:600;
margin-bottom:20px;
}

</style>

</head>

<body>

<div class="container">

<div class="logo">
☕ Fagioli Reali
</div>

<h1>Welcome Back</h1>

<p class="subtitle">
Login to continue shopping coffee beans
</p>

<form method="POST" action="{{ route('login') }}">
@csrf

<input type="email" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit">
Login
</button>

</form>

<div class="register">
Don't have account?
<a href="{{ route('register') }}">Register</a>
</div>

</div>

</body>
</html>