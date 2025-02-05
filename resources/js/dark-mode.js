document.addEventListener('DOMContentLoaded', function() {
    const darkModeToggle = document.createElement('button');
    darkModeToggle.id = 'darkModeToggle';
    darkModeToggle.classList.add('btn', 'btn-secondary');
    darkModeToggle.setAttribute('aria-label', 'Toggle Dark Mode');
    const isDarkMode = localStorage.getItem('darkMode') === 'true';
    if (isDarkMode) {
        document.body.classList.add('dark-mode');
    }
    darkModeToggle.innerHTML = isDarkMode ? '☀️ Light Mode' : '🌙 Dark Mode';
    document.querySelector('.navbar').appendChild(darkModeToggle);

    // Handle dark mode toggle
    darkModeToggle.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
        const isDarkMode = document.body.classList.contains('dark-mode');
        localStorage.setItem('darkMode', isDarkMode);
        this.innerHTML = isDarkMode ? '☀️ Light Mode' : '🌙 Dark Mode';
    });
});