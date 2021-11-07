<nav>
    <div class="container">
        <div class="navbar navbar-expand-lg navbar-light bg-white">
            <a href="{{ route('home') }}" class="navbar-brand">
                <img src="{{ url('frontend/images/logo.png') }}" alt="logo NOMADS" />
            </a>
            
            <button class="navbar-toggler navbar-toogler-right" type="button" data-toggle="collapse" data-target="#nav-primary">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="nav-primary">
                <ul class="navbar-nav ml-auto mr-3">
                    <li class="nav-item mx-md-3"><a href="#" class="nav-link active">Home</a></li>
                    <li class="nav-item mx-md-3"><a href="#" class="nav-link">Travel Package</a></li>
                    <li class="nav-item mx-md-3 mx-lg-0 dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="nav-primary-dropdown" data-toggle="dropdown">Services</a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">Link</a>
                            <a href="#" class="dropdown-item">Link</a>
                            <a href="#" class="dropdown-item">Link</a>
                        </div>
                    </li>
                    <li class="nav-item mx-md-3"><a href="#" class="nav-link">Testimonials</a></li>
                </ul>

                @guest
                    <form action="" class="form-inline d-sm-block d-md-none">
                    <button class="btn btn-blue my-2 my-sm-0" type="button" onclick="event.preventDefault(); location.href='{{ route('login') }}'">
                            Login
                        </button>
                    </form>

                    <form action="" class="form-inline my-2 my-lg-0 d-none d-md-block">
                    <button class="btn btn-blue btn-navbar-right my-2 my-sm-0" type="button" onclick="event.preventDefault(); location.href='{{ route('login') }}'">
                            Login
                        </button>
                    </form>
                @endguest
                
                @auth
                    <form action="{{ route('logout') }}" method="POST" class="form-inline d-sm-block d-md-none">
                    <button class="btn btn-blue my-2 my-sm-0" type="submit">
                            @csrf
                            Logout
                        </button>
                    </form>

                    <form action="{{ route('logout') }}" method="POST" class="form-inline my-2 my-lg-0 d-none d-md-block">
                    <button class="btn btn-blue btn-navbar-right my-2 my-sm-0" type="submit">
                            @csrf
                            Logout
                        </button>
                    </form>
                @endauth
                
            </div>
        </div>
    </div>
</nav>