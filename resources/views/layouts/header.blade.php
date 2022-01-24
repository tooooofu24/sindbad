<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>シンドバッド</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- CoreUI -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.1.0/dist/css/coreui.min.css" rel="stylesheet" integrity="sha384-J2WCKfhPxbtZAT+USOoPNCnZVozpAaGtaH/LUcSKXjdCXN85i5fGMTy1Agp8HChK" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.1.0/dist/js/coreui.bundle.min.js" integrity="sha384-CYI4AskcOOUbgXyjrkNZzI5Mbi6ZXe1RWn29fPG/MBZArrlwrfk8u49XbAkCHmzu" crossorigin="anonymous"></script> -->

    <!-- Font Awsome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <main>
        <nav class="navbar navbar-dark bg-dark navbar-expand-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="">
                </a>
                <button class=" navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link @if(request()->route()->getName() == 'spots.index') active @endif" href="{{ route('spots.index') }}">スポット一覧</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->route()->getName() == 'spots.create.index') active @endif" href="{{ route('spots.create.index') }}">スポット登録</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->route()->getName() == 'spots.check') active @endif" href="{{ route('spots.check') }}">スポット承認</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
    </main>


    <!-- JavaScript -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>