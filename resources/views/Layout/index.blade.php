<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Restaurant | Dashboard</title>
    @yield('estilos-vue')
    <link href="{{ asset('Inspinia/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Inspinia/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <!-- Toastr style -->


    <link href="{{ asset('Inspinia/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('Inspinia/css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('Inspinia/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
    @yield('estilos')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <img alt="image" class="rounded-circle"
                                src="{{ asset('Inspinia/img/profile_small.jpg') }}" />
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs font-bold">{{ Auth::user()->name }}</span>
                            </a>
                        </div>
                        <div class="logo-element">
                            IN+
                        </div>
                    </li>
                    @include('Rutas.index')
                </ul>
            </div>
        </nav>
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i
                                class="fa fa-bars"></i> </a>
                        {{-- Consulta/getHelp --}}
                        <a class="btn btn-primary mt-2" href="/Consulta/getHelp"><i
                                class="fa fa-file-pdf-o"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li style="padding: 20px">
                            <span class="m-r-sm text-muted welcome-message">Bienvenido {{ Auth::user()->name }}</span>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> Cerrar
                                Sesión</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
            <div id="content-system" style="">
                <!-- Contenido del Sistema -->
                @routes()
                @yield('contenido')
                <!-- /.Contenido del Sistema -->
            </div>
            <div class="footer">
                <div>
                    <strong>Copyright</strong>Restaurante &copy;2021
                </div>
            </div>
        </div>
    </div>
    <!-- Mainly scripts -->
    @yield('script-vue')
    <script src="{{ asset('Inspinia/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('Inspinia/js/popper.min.js') }}"></script>
    <script src="{{ asset('Inspinia/js/bootstrap.js') }}"></script>
    <script src="{{ asset('Inspinia/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('Inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('Inspinia/js/inspinia.js') }}"></script>
    <script src="{{ asset('Inspinia/js/plugins/pace/pace.min.js') }}"></script>
    <!-- jQuery UI -->
    <script src="{{ asset('Inspinia/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- GITTER -->
    <script src="{{ asset('Inspinia/js/plugins/gritter/jquery.gritter.min.js') }}"></script>

    {{-- <script src="{{ asset('Inspinia/js/plugins/chartJs/Chart.min.js') }}"></script> --}}
    <!-- Toastr -->
    <script src="{{ asset('Inspinia/js/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('SweetAlert/sweetalert2@10.js') }}">
    </script>
    @yield('script')

</body>

</html>
