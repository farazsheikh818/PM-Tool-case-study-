<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        .register-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        .register-container h2 {
            margin-bottom: 1rem;
            font-size: 24px;
            color: #333;
        }
        .register-container input,
        .register-container select {
            width: 100%;
            padding: 10px;
            margin: 0.5rem 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .register-container button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .register-container button:hover {
            background-color: #0056b3;
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

<div class="register-container">
    <h2>Register</h2>
    <form id="registerForm">
        @csrf
        <input type="text" name="name" required placeholder="Full Name">
        <input type="email" name="email" required placeholder="Email">
        <input type="password" name="password" required placeholder="Password">
        <input type="password" name="password_confirmation" required placeholder="Confirm Password">
        
        <select name="roles[]" multiple required>
            @foreach($roles as $role)
            <option value="{{$role->name}}">{{$role->name}}</option>
            @endforeach
        </select>

        <button type="submit">Register</button>
        <div class="error" id="errorMessage" style="display:none;"></div>
    </form>
    <div class="footer">
        <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#registerForm').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission
        
        $.ajax({
            url: '/api/auth/register', // Your API route for registration
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if(response.success){
                    alert('Registration successful! Please log in.');
                }
               

                // Optionally, redirect to login page
                window.location.href = '/login';
            },
            error: function(xhr) {
                
                console.log(xhr.responseJSON.error);
                var errorMessages ='';
                if(typeof xhr.responseJSON.password !='undefined'){
                    for (let index = 0; index < xhr.responseJSON.password.length; index++) {
                        errorMessages +=  xhr.responseJSON.password[index] + '<br>'; ;
                    
                }

                $('#errorMessage').html(errorMessages).show();
                }
                
               
            }
        });
    });
});
</script>

</body>
</html>
