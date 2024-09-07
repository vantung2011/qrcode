<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js" ></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <!-- Scripts -->
</head>
<style>
.navbar-nav .nav-link:hover {
    color: #fec771 !important;
}
.py-4{
    padding-top: 0.5rem !important;
}
.dropdown-item:hover{
    color: #da0b4e !important;
    margin-left: 5px;
}
body{
    background: #f4f8fa !important;
}
</style>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md rounded  shadow-sm p-3" style="background: #1c2938; margin: 8px 10px">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ url('/home') }}" style="color: #fff;">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('login') }}" style="color: #fff;">Đăng nhập</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}" style="color: #fff;">Đăng ký</a>
                                </li>
                            @endif
                        @else
                        @if(Auth::user()->role_id == 1)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}"
                            style="color: #fff;">Nhân viên</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('timesheet.index') }}"
                            style="color: #fff;">Bảng chấm công</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/salary"
                            style="color: #fff;">Lương nhân viên</a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="/salary/{{ Auth::user()->id }}"
                            style="color: #fff;">Quản lý lương</a>
                        </li>
                            <li class="nav-item dropdown item-name">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: #fff;">Xin chào,
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end p-3" aria-labelledby="navbarDropdown">
                                    <a id="profile-link" href="/profile/{{ Auth::user()->id }}" class="dropdown-item">Thông tin </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();" style="color: #000;">
                                        Đăng xuất
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @vite(['resources/sass/app.scss', 'resources/js/app.js','resources/js/create_user.js','resources/css/app.css'])
</body>
</html>

{{-- <script>
	$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	});
    $(document).ready(function() {
        $('#profile-link').click(function(event) {
            event.preventDefault(); 
            var profileUrl = $(this).attr('href');
            history.pushState({}, '', profileUrl);
            $.get(profileUrl, function(data) {
                $('body').html(data);
            });
        });
    });
</script> --}}
