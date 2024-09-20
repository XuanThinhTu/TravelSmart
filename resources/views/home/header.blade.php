<style>
    .nav-link {
        font-size: 1rem;
        /* Ensures all links have the same font size */
        color: #ffffff;
        /* Set the color for all nav links */
    }

    .nav-link i {
        margin-right: 0.5rem;
        /* Space between icon and text */
    }

    .nav-item {
        display: flex;
        /* Ensures items align properly */
        align-items: center;
    }

    .navbar-nav .nav-link {
        display: flex;
        align-items: center;
    }
</style>

<div class="py-1 bg-primary">
    <div class="container">
        <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
            <div class="col-lg-12 d-block">
                <div class="row d-flex">
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                        <span class="text">+ 1235 2355 98</span>
                    </div>
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
                        <span class="text">travelsmart@email.com</span>
                    </div>
                    <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                        <span class="text">3-5 Business days delivery &amp; Free Returns</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="/">TRAVEL SMART</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="/" class="nav-link">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="/">Shop</a>
                        <a class="dropdown-item" href="/">Wishlist</a>
                        <a class="dropdown-item" href="/">Single Product</a>
                        <a class="dropdown-item" href="/">Cart</a>
                        <a class="dropdown-item" href="/">Checkout</a>
                    </div>
                </li>
                <li class="nav-item"><a href="/" class="nav-link">About</a></li>
                <li class="nav-item"><a href="/" class="nav-link">Blog</a></li>
                <li class="nav-item"><a href="/" class="nav-link">Contact</a></li>

                <!-- Authentication Links -->
                @if (Route::has('login'))
                @auth
                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}" class="nav-link">
                        <i class="fa fa-user"></i> {{ Auth::user()->name }}
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <a style="color:black;" href="#" class="nav-link"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fa fa-sign-out" ></i> Logout
                        </a>
                    </form>
                </li>
                @else
                <li class="nav-item"><a href="{{ route('login') }}" class="nav-link"><i class="fa fa-user"></i> Login</a></li>
                @if (Route::has('register'))
                <li class="nav-item"><a href="{{ route('register') }}" class="nav-link"><i class="fa fa-vcard"></i> Register</a></li>
                @endif
                @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>