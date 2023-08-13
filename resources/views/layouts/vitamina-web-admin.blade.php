<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Vitamina-Web-Admin') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


    
    

    
    {{-- Custom CSS - Vitamina-Web-Admin é um modelo layout em bootstrap 5 (opensource) que foi obtido na web e encaixado manualmente neste projeto Laravel 10. O estilo está dispnível em: --}}    
    {{-- public/bootstrap, public/css, public/js, public/plugins, public/scss --}}
    
    <link href="{{ asset('css/style.css') }}" rel="stylesheet"> 




    <!-- Chamada Vite Comentada para inclusao do modelo de layout acima -->
    <!-- Scripts -->    
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}  
    
    

</head>
<body>

     
    {{-- ============================================================== --}}
    {{-- Preloader --}}     
    {{-- ============================================================== --}}
    
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>



        <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="dashboard.html">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!-- Dark Logo icon -->
                            <img src="{{ asset('plugins/images/logo-icon.png') }}" alt="homepage" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="{{ asset('plugins/images/logo-text.png') }}" alt="homepage" /> 
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                   
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav ms-auto d-flex justify-content-end">

                        <div class="container">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                {{ config('app.name', 'Vitamina Web Admin') }}
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                                <span class="navbar-toggler-icon"></span>
                            </button>
            
                            <div class="collapse navbar-collapse d-flex" id="navbarSupportedContent">
                                <!-- Left Side Of Navbar -->
                                <ul class="navbar-nav me-auto">
            
                                </ul>
            
                                <!-- Right Side Of Navbar -->
                                <ul class="navbar-nav ms-auto">

                                    <!-- Nao Logado -->
                                    @guest
                                        @if (Route::has('login'))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                            </li>
                                        @endif
            
                                        @if (Route::has('register'))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                            </li>
                                        @endif

                                    <!-- Logado -->    
                                    @else
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                {{ Auth::user()->name }}
                                            </a>
            
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="background: #414755;">

                                                <style>
                                                    a.dropdown-item:hover{
                                                        background: #414755 !important;
                                                    }
                                                </style>

                                                <a class="dropdown-item text-center" href="{{ route('logout') }}" style="color: #fff !important;"
                                                   onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
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
                        
                        
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">                        
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('home') }}"
                                aria-expanded="false">
                                <i class="fas fa-star" aria-hidden="true"></i>
                                <span class="hide-menu">Gerir Oportunidades</span>
                            </a>
                        </li>

                        <li class="sidebar-item pt-2">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#"
                                aria-expanded="false">
                                <i class="fas fa-shopping-cart" aria-hidden="true"></i>
                                <span class="hide-menu">Gerir Produtos</span>
                            </a>
                        </li>                                               
                        
                    </ul>
                </nav>                
            </div>            
        </aside>
        



        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            
            
            

            {{-- =========================================================================== --}}
            {{-- Conteúdo das views que utilizam este layout é chamado em @yield('content')  --}}     
            {{-- =========================================================================== --}}
            <main class="py-4">
                @yield('content')
            </main>         


            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">Vitamina Web - Sistema Administrativo</footer>
            

        </div>
        
    </div>
    
    


    {{-- ============================================================== --}}
    {{-- Jquery --}}     
    {{-- ============================================================== --}}
    <script src="{{ asset('plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>

    {{-- ============================================================== --}}
    {{-- Bootstrap tether Core JavaScript --}}
    <script src="{{ asset('bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    {{-- ============================================================== --}}

    {{-- ============================================================== --}}
    {{-- Wave Effects --}}
    <script src="{{ asset('js/waves.js') }}"></script>
    {{-- ============================================================== --}}

    {{-- ============================================================== --}}
    {{-- Menu sidebar --}}
    <script src="{{ asset('js/sidebarmenu.js') }}"></script>
    {{-- ============================================================== --}}

    {{-- ============================================================== --}}
    {{-- Custom JavaScript --}}
    <script src="{{ asset('js/custom.js') }}"></script> 
    {{-- ============================================================== --}}



    {{-- ============================================================== --}}
    {{-- Libs JQUERY: maskedinput e maskMoney --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"
        integrity="sha512-d4KkQohk+HswGs6A1d6Gak6Bb9rMWtxjOa0IiY49Q3TeFd5xAzjWXDCBW9RS7m86FQ4RzM2BdHmdJnnKRYknxw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"
        integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    {{-- Libs JQUERY: Calendário jQuery com Datepicker --}}    
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />    
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>


    {{-- Libs JQUERY: select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />


    @stack('js-scripts')

</body>
</html>
