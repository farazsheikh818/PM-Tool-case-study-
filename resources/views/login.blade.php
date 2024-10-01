<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 1rem;
            font-size: 24px;
            color: #333;
        }
        .login-container input {
            width: 100%;
            padding: 10px;
            margin: 0.5rem 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .login-container button:hover {
            background-color: #218838;
        }
        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 1rem;
        }
        .footer {
            margin-top: 1.5rem;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login</h2>
    <form id="loginForm">
        @csrf
        <input type="email" name="email" required placeholder="Email">
        <input type="password" name="password" required placeholder="Password">
        <button type="submit">Login</button>
        <div class="error" id="errorMessage" style="display:none;"></div>
    </form>
    <div class="footer">
        <p>Don't have an account? <a href="{{url('register')}}">Register</a></p>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission
        
        $.ajax({
            url: window.location.origin+'/api/auth/login', // Adjust to your login API route
            method: 'POST',
            data: $(this).serialize(),
            xhrFields: {
        withCredentials: true
    },
            success: function(response) {
                if(response.success){
                    localStorage.setItem('token', response.token);
                   
                  
                    setCookie('token', response.token, 7);
                    window.location.href='/projects';
                    
                }else{
                    alert(response.error);
                }
                // Save the token to local storage
                
                

          
            },
            error: function(xhr) {
                $('#errorMessage').text(xhr.responseJSON.error).show();
            }
        });
    });

    function setCookie(name, value, days, path = '/') {
    const expires = new Date(Date.now() + days * 864e5).toUTCString();
    document.cookie = `${name}=${encodeURIComponent(value)}; expires=${expires}; path=${path}; SameSite=Lax`;
}

// Set the token as a cookie

});
</script>

</body>
</html>
