<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}" type="image/x-icon">
    <meta name="theme-color" content="#1B6DC1" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


    <script src="{{ asset('js/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/typed.min.js') }}"></script>

    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/checkout.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    {{-- live chat --}}
    <script src="//code.tidio.co/n8v0g5wq1atnbyn4rm7lk7jr83cqavhy.js" async></script>
    <script>
        var availableTags = [];
        $.ajax({
            method: "GET",
            url: "/product_list",
            success: function(response) {
                console.log(response);
                startautocomplete(response);
            }
        });

        function startautocomplete(availableTags) {
            $("#tags").autocomplete({
                source: availableTags
            });
        }
        new WOW().init(); 
    </script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                    KouFood
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span><img src="{{asset('images/menu.png')}}" alt=""></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mx-auto p-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Ana Sayfa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('about') }}">Hakkımızda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('services') }}">Servisler</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('all_categories') }}">Kategoriler</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('all_products') }}">Ürünler</a>
                        </li>
                    </ul>
                    
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link login_btn" href="{{ route('login') }}">{{ __('Giriş Yap') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link signup_btn" href="{{ route('register') }}">{{ __('Kayıt Ol') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link icon" href="{{ url('cart') }}"><img
                                        src="{{ asset('images/shopping-basket.png') }}" alt=""> <span
                                        class="cart-count">0</span></a>
                                <a class="nav-link icon" href="{{ url('wishlist') }}"><img
                                    src="{{ asset('images/wishlist.png') }}" alt=""> <span
                                    class="wishlist-count">0</span></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('my_orders') }}">Siparişlerim</a>
                                    @if (Auth::user()->role_as == '1')
                                        <a class="dropdown-item" href="{{ url('dashboard') }}">Gösterge Paneli</a>
                                    @endif
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> {{ __('Çıkış Yap') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
        <footer class="py-5">
            <div class="container">
              <div class="row">
                <div class="col-lg-4 col-md-4 col-12">
                  <div class="img text-center">
                    <h1><b>KouFood</b></h1>
                    <p>
                    Yeni Bir Deneyim Yaşamak İster Misiniz?<br>
                    Yemek Kalitemiz ile Damaklarda Mükemmel Bir Tat Bırakıyoruz
                    </p>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                  <h5><i class="fas fa-caret-right" style="font-size: small;"></i> Önemli Linkler</h5>
                  <ul class="list-unstyled p-0">
                    <li><a href="{{ url('/') }}">Ana Sayfa</a></li>
                    <li><a href="{{ url('about') }}">Hakkımızda</a></li>
                    <li><a href="{{ url('categories') }}">Kategoriler</a></li>
                    <li><a href="{{ url('products') }}">Ürünler</a></li>
                  </ul>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                  <h5><i class="fas fa-caret-right" style="font-size: small;"></i> Hızlı Linkler</h5>
                  <ul class="list-unstyled p-0">
                    <li><a href="">Sık Sorulan Sorular</a></li>
                    <li><a href="">Şartlar & Koşullar</a></li>
                    <li><a href="">Gizlilik Politikası</a></li>
                  </ul>
                  <h5><i class="fas fa-caret-right" style="font-size: small;"></i> Bizimle İletişime Geçin</h5>
                  <div class="social">
                    <ol class="list-unstyled">
                      <li class="shadow-sm"><a href=""> <i class="fab fa-facebook-f"></i></a></li>
                      <li class="shadow-sm"><a href=""> <i class="fab fa-twitter"></i></a></li>
                      <li class="shadow-sm"><a href=""> <i class="fas fa-envelope"></i></a></li>
                      <li class="shadow-sm"><a href=""><i class="fas fa-phone"></i></a></li>
                    </ol>
                  </div>
                </div>
                <div class="col-md-12 col-12">
                  <div class="copyright mt-4 mb-2 mx-auto text-center">
                    Tüm Hakları Saklıdır KouFood | Mehmet Berk BAYTÜRK &copy; 2023
                  </div>
                </div>
              </div>
            </div>
        </footer>
        <div class="scrollUp text-center">
            <i class="fas fa-angle-double-up shadow-sm"></i>
        </div>
        {{-- <div class="loading-overlay">
            <img src="{{asset('images/loading.gif')}}" alt="">
        </div> --}}
    </div>

    @if (session('status'))
        <script>
            swal("", "{{ session('status') }}", "success");
        </script>
    @endif
</body>

</html>
