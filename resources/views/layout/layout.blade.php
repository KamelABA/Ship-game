<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="ship-solid.svg" type="image/svg">

    <title>@yield('title', 'Battleship Game')</title>
    @vite(['resources/css/ship.css'])
    @yield('styles')
</head>

<body>

    <div class="top-bar d-flex align-items-center m-2">
        <!-- أيقونة الإعدادات -->
        <div class="dropdown">
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="settingsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                ⚙️ Settings
            </button>
            <ul class="dropdown-menu" aria-labelledby="settingsDropdown">
                @if(Auth::check())
                <li><span class="dropdown-item-text fw-bold">Welcome, {{ Auth::user()->name }}</span></li>
                @else
                <li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button></li>
                @endif
                <li><button class="dropdown-item" onclick="changeLanguage()">🌍 Change Language</button></li>
                <li><button class="dropdown-item" onclick="toggleDarkMode()">🌙 Dark Mode</button></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                @if(Auth::check())
                <li>
                    <a href="{{ route('logout') }}" class="dropdown-item text-danger"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                @endif
            </ul>
        </div>
    </div>


    <div class="modal fade text-dark" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="loginForm" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email_login" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Login</button>
                    </form>
                    <div class="text-center mt-3">
                        <p>New account?
                            <a href="#" id="showRegisterModal"><button class="btn btn-success">Register</button></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-dark" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Register</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="registerForm" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email_reg" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password_reg" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success">Register</button>
                        <div class="text-center mt-3">
                            <p>Already have an account!
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @yield('content')


    @vite(['resources/js/ship.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#showRegisterModal").click(function() {
                $("#loginModal").modal('hide'); // إغلاق مودال تسجيل الدخول
                setTimeout(() => {
                    $("#registerModal").modal('show'); // فتح مودال التسجيل
                }, 500);
            });
        });
    </script>

    <script>
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
        }

        function changeLanguage() {
            alert('Language change functionality coming soon!');
        }
    </script>


</body>

</html>