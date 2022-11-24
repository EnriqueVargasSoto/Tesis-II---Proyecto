<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSPINIA | Login</title>
    <link href="{{ asset('Inspinia/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('Inspinia/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('Inspinia/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('Inspinia/css/style.css') }}" rel="stylesheet">
</head>

<body class="gray-bg">
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <img src="{{ asset('Inspinia/img/logo.jpg') }}" class="img-fluid">

            </div>
            <h3>BIENVENIDO</h3>
            <p>Inicar Session-Restaurant</p>
            <form class="m-t" role="form" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required placeholder="Username" required="">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="Password" required="">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">LOGIN</button>
                <a href="#"><small>¿Olvidaste tu contraseña?</small></a>
                <p class="text-muted text-center"><small>¿No tienes una cuenta?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Crear una cuenta</a>
            </form>

        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="{{ asset('Inspinia/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('Inspinia/js/popper.min.js') }}"></script>
    <script src="{{ asset('Inspinia/js/bootstrap.js') }}"></script>
</body>

</html>
