<!DOCTYPE html>
<html>
<head>
<title>Register | Fagioli Reali</title>

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
background:linear-gradient(135deg,#42275a,#734b6d);
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
background:#734b6d;
color:white;
font-size:16px;
cursor:pointer;
margin-top:10px;
}

button:hover{
background:#42275a;
}

.login{
margin-top:20px;
}

.login a{
color:#734b6d;
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

<h1>Create Account</h1>

<p class="subtitle">
Join and start buying premium coffee beans
</p>

<form method="POST" action="{{ route('register') }}">
@csrf

<input type="text" name="name" placeholder="Full Name" required>

<input type="email" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Password" required>

<input type="password" name="password_confirmation" placeholder="Confirm Password" required>

<button type="submit">
Register
</button>

</form>

<div class="login">
Already have account?
<a href="{{ route('login') }}">Login</a>
</div>

</div>

</body>
</html>