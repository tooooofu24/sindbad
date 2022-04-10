<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm position-fixed w-100" style="z-index: 2;top: 0;">
    <div class="container">
        <span class="navbar-brand p-0 d-flex align-items-center">
            <a href="" class="d-flex align-items-center">
                <img src="/sindbad-icon.jpg" alt="シンドバッドのアイコン" class="rounded-3" width="26" height="26">
            </a>
            <h1 class="fs-6 mb-0 ms-4 align-middle">@yield('nav-title')</h1>
        </span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="ナビゲーション">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item px-2">
                    <a class="nav-link fs-4 py-0" href="" target="_blank"><i class="fa-brands fa-google-play" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Gppgle Play"></i></a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link fs-4 py-0" href="" target="_blank"><i class="fa-brands fa-app-store-ios" data-bs-toggle="tooltip" data-bs-placement="bottom" title="App Store"></i></a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link fs-4 py-0" href="{{ route('contact.index') }}"><i class="fas fa-question-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="お問い合わせ"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>