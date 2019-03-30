<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Local Book Share</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="text-center bg-light">
            <a href="/about">
                <div class="row">
                    <div class="col-md-3">
                        <img src="/images/needHelp.jpg" alt="" height="100" width="100%">
                    </div>
                    <div class="col-md-4">
                        <img src="/images/givebook.png" alt="" height="100" width="100%">
                    </div>
                    <div class="col-md-2">
                        <img src="/images/giveBook.jpg" alt="" height="100" width="100%">
                    </div>
                    <div class="col-md-3">
                        <img src="/images/needDesigner.png" alt="" height="100" width="100%">
                    </div>
                </div>
            </a>
        </div>
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/all_books/1/all') }}">
                    Local Book Share - We lend books for free!
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span>{{ __('messages.books') }}</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/all_books/1/all">{{ __('messages.allBooks') }}</a>
                                <a class="dropdown-item" href="/all_books/1/vi">{{ __('messages.vietnameseBooks') }}</a>
                                <a class="dropdown-item" href="/all_books/1/en">{{ __('messages.englishBooks') }}</a>
                                <a class="dropdown-item" href="/all_books/1/ja">{{ __('messages.japaneseBooks') }}</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="/what_new" class="nav-link">
                                New Update
                            </a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @if (Auth::user()->status == 0)
                                <li class="nav-item">
                                    <a href="/reserving_info" class="nav-link">
                                        {{ __('messages.reservingBook') }}<b class="text-danger">(1)</b>
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="{{ Auth::user()->image }}" alt="what" height="30" width="30">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if (Auth::user()->type > 79)
                                        <a class="dropdown-item" href="/admin/all_books/1/all">Admin Site</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('messages.logout') }}
                                    </a>
                                    <a class="dropdown-item" href="/my_info/edit">{{ __('messages.editInfo') }}</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 container">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ __($error) }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ __(session()->get('message')) }}
                </div>
            @endif
            
            @yield('content')
            <br><br><br><br><br><br>
            <hr>
            <br><br>
            <div class="row">
                <div class="text-center col-sm-4">
                    <a href="/contact">{{__("messages.contactMe")}}</a>
                    <br>
                    <img src="/system/contact_line.ico" alt="" height="30" width="30"> 
                    <span>ID: duongtinhvu</span> 
                    <br>
                    <img src="/system/contact_email.png" alt="" height="30" width="30">  <span>danganhvu1998@gmail.com</span>
                    <br>
                </div>
                <div class="col-sm-8">
                    <ul>
                        <b>Place to receive book | Nơi nhận sách | 本を貰う場所</b>
                        <li>Dormy Kawaguchi - 1 Chome-5-１２ Sakaechō, Kawaguchi-shi, Saitama-ken
                            <a target="_blank" href="https://www.google.com/maps/place/Dormy+Kawaguchi/@35.8033652,139.7284405,15z/data=!4m5!3m4!1s0x0:0xe6da61b437052809!8m2!3d35.8033652!4d139.7284405">
                                <b>Google Map</b>
                            </a>
                        </li>
                        <li>INIAD Toyo University - 1 Chome-7-11 Akabanedai, Kita-ku, Tōkyō-to 
                            <a target="_blank" href="https://www.google.com/maps/place/INIAD+%E8%B5%A4%E7%BE%BD%E5%8F%B0%E3%82%AD%E3%83%A3%E3%83%B3%E3%83%91%E3%82%B9/@35.7802503,139.713406,17z/data=!3m1!4b1!4m5!3m4!1s0x6018931eb45983f7:0x620ef08f425b6925!8m2!3d35.780246!4d139.7156">
                                <b>Google Map</b>
                            </a>
                        </li>
                        <li>Toyo University Hakusan Campus - 5 Chome-28-２０ Hakusan, Bunkyō-ku, Tōkyō-to
                            <a target="_blank" href="https://www.google.com/maps/place/Toyo+University+Hakusan+Campus/@35.7235951,139.7474811,17z/data=!3m1!4b1!4m5!3m4!1s0x60188db7b2c0766d:0xe80e1b6e1bac88a5!8m2!3d35.7235908!4d139.7496751">
                                <b>Google Map</b>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="text-muted text-center">
                I'm currently looking for a parttime jobs! Please check out my <a target="_blank" href="https://resume.io/r/LqvSTnLSM">ONLINE CV</a>. Thank you!
            </div>
        </main>
    </div>
</body>
</html>
