<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechTalks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/custom.css') }}"> -->
    
<!-- Custome Styling :) -->
    <style>
:root {
    --bg-light: #f8f9fa;
    --text-light: #212529;
    --card-light: #ffffff;
    --bg-dark: #212529;
    --text-dark: #f8f9fa;
    --card-dark: #343a40;
}

body {
    background-color: var(--bg-light);
    color: var(--text-light);
    transition: background-color 0.3s, color 0.3s;
}

/* Add other custom styles here */
body.dark-mode {
    background-color: var(--bg-dark);
    color: var(--text-dark);
}

.post-card {
    background: var(--card-light);
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    transition: all 0.3s ease-in-out;
}

.dark-mode .post-card {
    background: var(--card-dark);
}

.post-card:hover {
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
    transform: translateY(-3px);
}

.post-title {
    color: inherit;
    text-decoration: none;
}

.dark-mode .btn-outline-secondary {
    color: var(--text-dark);
    border-color: var(--text-dark);
}

.dark-mode .modal-content {
    background-color: var(--card-dark);
    color: var(--text-dark);
}
</style>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ mix('js/dark-mode.js') }}" defer></script>
</head>
<body>
    @include('partials.nav')

    <div class="container-lg mt-4">
        @include('partials.alerts')
        @yield('content')
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check for saved dark mode preference
        const darkMode = localStorage.getItem('darkMode') === 'true';
        if (darkMode) {
            document.body.classList.add('dark-mode');
        }

        // Add dark mode toggle to navbar
        const navbar = document.querySelector('.navbar-nav');
        const darkModeToggle = document.createElement('li');
        darkModeToggle.className = 'nav-item';
        darkModeToggle.innerHTML = `
            <button class="nav-link btn" id="darkModeToggle">
                ${darkMode ? '☀️ Light Mode' : '🌙 Dark Mode'}
            </button>
        `;
        navbar.appendChild(darkModeToggle);

        // Handle dark mode toggle
        document.getElementById('darkModeToggle').addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            const isDarkMode = document.body.classList.contains('dark-mode');
            localStorage.setItem('darkMode', isDarkMode);
            this.innerHTML = isDarkMode ? '☀️ Light Mode' : '🌙 Dark Mode';
        });
    });
</script>

    @stack('scripts')
</body>
</html>
