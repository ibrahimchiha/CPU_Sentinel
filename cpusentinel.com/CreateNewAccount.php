<html>

<head>

<title> Create New Account </title>
<link rel="stylesheet" type="text/css" href="CreateAccountStyle.css">
<body>

    <div class="loginbox">
    <img src="logo.png" class="avatar">
        <h1> Create new account </h1>
        
        
        <form method="post" action='CreateNewAccount.php'>
            
            <p> Create a username </p>
            <input type="text" name="username" id="username" placeholder="Enter Username">
                <p> Create a password </p>
                <input type="password" name="password1" id="password" placeholder="Enter Password">
                    <p> Confirm password </p>
                <input type="password" name="password2" id="password" placeholder="Enter Password">
                    <input type="submit" name="login" value="Create my account">
                    
                    <input type="button" class="button" value='I already have an account' onclick="location.href='index.html';" />
                        <br>
                        
            
            </form>
        </div>

</body>


</head>
</html>
