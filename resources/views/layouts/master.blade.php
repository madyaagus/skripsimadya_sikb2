
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Smarthr - Bootstrap Admin Template">
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>PB3R Kejaksaan Negeri Sijunjung</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('assets/img/logo kejaksaan.png') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">

    {{-- message toastr --}}
	<link rel="stylesheet" href="{{ URL::to('assets/css/toastr.min.css') }}">
	<script src="{{ URL::to('assets/js/toastr_jquery.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/toastr.min.js') }}"></script>
    @yield('style')

    <style>
        .custom-dropdown-menu {
            width: 120px; /* Sesuaikan lebar dropdown menu */
            height: 40px; /* Sesuaikan tinggi dropdown menu */
            position: relative; /* Mengatur posisi relatif untuk membuat penempatan absolut berdasarkan container ini */
        }
    
        .custom-dropdown-menu a {
            color: #BF3131; /* Sesuaikan warna tulisan */
            display: block;
            margin: 5px;
            text-align: center; /* Menempatkan teks di pojok kanan */
            top: 0; /* Menempatkan teks di pojok atas */
            right: 0; /* Menempatkan teks di pojok kanan */
            transform: translateY(30%); /* Koreksi posisi untuk menempatkan teks di tengah vertikal */
        }
    </style>
    
</head>

<body>

    <div class="main-wrapper">
		<!-- Loader -->
		<div id="loader-wrapper">
			<div id="loader">
				<div class="loader-ellips">
				  <span class="loader-ellips__dot"></span>
				  <span class="loader-ellips__dot"></span>
				  <span class="loader-ellips__dot"></span>
				  <span class="loader-ellips__dot"></span>
				</div>
			</div>
		</div>
		<!-- /Loader -->
        <div class="header">
            <div class="header-left text-center pt-1">
                <a href="{{ route('/') }}" class="logo">
                    <img src="{{ URL::to('assets/img/logo kejaksaan.png') }}" width="40" height="40" alt="">
                </a>
            </div>

            <a id="toggle_btn" href="javascript:void(0);" class="pt-3">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>

            <div class="page-title-box">
                <h3>PB3R</h3>
            </div>

            <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

            <ul class="nav user-menu">
                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        @if(auth()->check() && Auth::user()->role == 'stafbb')
                            <span class="user-img"><img src="{{ URL::to('assets/img/profiles/default-avatar.jpg') }}" alt="">
                                <span class="status online"></span></span>
                            <span>Staf BB</span>
                        @endif
                        @if(auth()->check() && Auth::user()->role == 'kasibb')
                            <span class="user-img"><img src="{{ URL::to('assets/img/profiles/default-avatar.jpg') }}" alt="">
                                <span class="status online"></span></span>
                            <span>Kasi BB</span>
                        @endif
                        @if(auth()->check() && Auth::user()->role == 'kajari')
                            <span class="user-img"><img src="{{ URL::to('assets/img/profiles/default-avatar.jpg') }}" alt="">
                                <span class="status online"></span></span>
                            <span>Kajari</span>
                        @endif
                        @if(auth()->check() && Auth::user()->role == 'jaksa')
                            <span class="user-img"><img src="{{ URL::to('assets/img/profiles/default-avatar.jpg') }}" alt="">
                                <span class="status online"></span></span>
                            <span>Jaksa</span>
                        @endif
                        @guest
                            <span class="user-img"><img src="{{ URL::to('assets/img/profiles/default-avatar.jpg') }}" alt="">
                                <span class="status online"></span></span>
                            <span>Guest</span>
                        @endguest
                    </a>

                    @if(auth()->check() && Auth::user()->role == 'stafbb')
                        <div class="dropdown-menu custom-dropdown-menu">
                                <a  href="{{ route('logout') }}" class="{{ set_active(['logout']) }}">Logout</a>
                        </div>
                    @endif
                    @if(auth()->check() && Auth::user()->role == 'kasibb')
                        <div class="dropdown-menu custom-dropdown-menu">
                                <a  href="{{ route('logout') }}" class="{{ set_active(['logout']) }}">Logout</a>
                        </div>
                    @endif
                    @if(auth()->check() && Auth::user()->role == 'kajari')
                        <div class="dropdown-menu custom-dropdown-menu">
                                <a  href="{{ route('logout') }}" class="{{ set_active(['logout']) }}">Logout</a>
                        </div>
                    @endif
                    @if(auth()->check() && Auth::user()->role == 'jaksa')
                        <div class="dropdown-menu custom-dropdown-menu">
                                <a  href="{{ route('logout') }}" class="{{ set_active(['logout']) }}">Logout</a>
                        </div>
                    @endif

                    @guest
                        <div class="dropdown-menu custom-dropdown-menu">
                            <a  href="{{ route('login') }}" class="{{ set_active(['login']) }}">Login</a>
                        </div>   
                    @endguest
                </li>
            </ul>
            

            <div class="dropdown mobile-user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
            
                @if(auth()->check() && in_array(Auth::user()->role, ['stafbb', 'kasibb', 'kajari', 'jaksa']))
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#" onclick="confirmLogout()">Logout</a>
                    </div>
            
                    <script>
                        function confirmLogout() {
                            var isConfirmed = window.confirm("Apakah Anda yakin ingin logout?");
                            if (isConfirmed) {
                                window.location.href = "{{ route('logout') }}";
                            }
                        }
                    </script>
                @else
                    @guest
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('login') }}" class="{{ set_active(['login']) }}">Login</a>
                        </div>
                    @endguest
                @endif
            </div>
        </div>

       <!-- Sidebar -->
		@include('sidebar.sidebar')
        {{-- @unless(Auth::user()->role == 'stafbb')
            @include('sidebar.sidebar_role')
        @endunless --}}
		<!-- /Sidebar -->

		<!-- Page Wrapper -->
		@yield('content')
		<!-- /Page Wrapper -->
    </div>

    <script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="{{ URL::to('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/popper.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/chart.js') }}"></script>
    <script src="{{ URL::to('assets/js/select2.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/moment.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/fileupload/fileupload.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/app.js') }}"></script>
    
	@yield('script')
</body>

</html>
