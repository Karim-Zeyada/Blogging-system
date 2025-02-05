<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<link rel="stylesheet" href="{{ mix('css/custom.css') }}">

<style>
    .navbar-nav .nav-link:hover {
        color: #17a2b8 !important; 
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(90deg, #232526, #414345);">

    <div class="container">
        <a class="navbar-brand" href="{{ route('posts.index') }}">
            <i class="bi bi-journal-code"></i> TechTalks with Karim
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('posts.index') }}">
                        <i class="bi bi-file-earmark-text"></i> Posts
                    </a>
                </li>

                <!-- Navigation bar profil icon -->
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.edit') }}">
                        <img src="{{ Auth::user()->avatar_url }}" 
                            alt="Avatar" 
                            class="rounded-circle shadow border border-1 border-primary"
                            style="width: 27px; height: 27px; object-fit: cover;">
                            {{ Auth::user()->name }}
                    </a>
                </li>

                    <li class="nav-item">
                        <a class="nav-link text-danger" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="bi bi-key"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="bi bi-pencil-square"></i> Register
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
