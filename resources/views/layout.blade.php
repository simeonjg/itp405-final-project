<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
    <div class="container">
      <!-- Navigation section -->
        <ul class="navbar navbar-expand-md bg-light justify-content-end list-inline">
            @if (Auth::check())
              <li class="nav-item">
                <a href="{{ route('search.home') }}" class="nav-link">Home</a>
              </li>
              <li class="nav-item">
                <a href="{{ route('favorites.index') }}" class="nav-link">Favorites</a>
              </li>
              <li class="nav-item">
                <a href="{{ route('profile.index') }}" class="nav-link">Profile</a>
              </li>
              <li class="nav-item">
                <form method="post", action="{{ route('auth.logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link">Logout</button>
                </form>
              </li>
            @else
              <li class="nav-item">
                <a href="{{ route('registration.index') }}" class="nav-link">Register</a>
              </li>
              <li class="nav-item">
                <a href="/login" class="nav-link">Login</a>
              </li>
            @endif
        </ul>

        <!-- Error section -->
        @if (session('error'))
            <div class="alert alert-danger mt-3" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @yield('main')
        

    </div>
</body>
</html>