
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('projects.index') }}">Dashboard</a></li>
                
            </ul>
            <button id="logoutButton">Logout</button>
        </nav>
    </header>

    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Project Management Tool. All rights reserved.</p>
    </footer>

    <script>
    // Set up Axios default headers
    const token = getCookie('token');
    if (token) {
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    }

    // You can intercept requests to ensure the token is added dynamically
    function getCookie(name) {
    const cookieArr = document.cookie.split(';');
    
    for (let i = 0; i < cookieArr.length; i++) {
        const cookiePair = cookieArr[i].trim();
        
        // Check if the cookie name matches
        if (cookiePair.startsWith(name + '=')) {
            return decodeURIComponent(cookiePair.split('=')[1]);
        }
    }
    
    // Return null if the cookie is not found
    return null;
}

    $.ajaxSetup({
    headers: {
        'Authorization': "Bearer "+ getCookie('token'),
    }
    });

    $('#logoutButton').on('click', function() {
        if (confirm('Are you sure you want to logout?')) {
            $.ajax({
                url: 'api/auth/logout',
                method: 'POST',
                headers: {
        'Authorization': "Bearer "+getCookie('token'),
    },
                success: function(response) {
                    // Handle success response
                  
                    // Clear the token from localStorage
                    deleteCookie('token');
                    localStorage.removeItem('token');
                    // Optionally redirect to login or home page
                    window.location.href = '/login';
                },
                error: function(xhr) {
                    // Handle error response
                    console.error(xhr.responseJSON.message || 'Logout failed.');
                    alert('Logout failed. Please try again.');
                }
            });
        }
    });

    function deleteCookie(name) {
    document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
}

// Example usage
 // Replace 'token' with the name of your cookie

</script>

</body>
</html>
