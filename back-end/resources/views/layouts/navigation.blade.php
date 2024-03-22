<nav x-data="{ open: false }" class="navbar navbar-expand-lg  ">
    <!-- Primary Navigation Menu -->
    <div class="container-fluid pt-3 align-items-start">
        
            <ul class="navbar-nav mr-auto align-items-center">
                 <li class="nav-item">
                    <a class="navbar-brand" href="http://localhost:5173/#/">
                        <img src="../BoolBnB_Logo.svg" alt="Logo" class="logo"  >
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost:5173/#/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost:5173/#/apartments">Appartamenti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                
            </ul>
            <ul class="navbar-nav ml-auto ">
                @auth
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">Profilo</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Log Out</button>
                            </form>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link btn" href="{{ route('login') }}">Log in</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Registrati</a>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style scoped>
    .logo{
        width: 60px;
        height: 50px;
    }
</style>