<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Movimoto</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css')  }}">

    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">

    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"> -->
    <link rel="stylesheet" href="{{ asset('browers/css/libs/ionicons.min.css') }}">

    <!-- Theme style -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/AdminLTE.min.css"> -->
    <link rel="stylesheet" href="{{ asset('browers/css/AdminLTE.min.css') }}">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/skins/_all-skins.min.css"> -->
    <link rel="stylesheet" href="{{ asset('browers/css/libs/skins/_all-skins.min.css') }}">

    <!-- iCheck -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/_all.css"> -->
    <link rel="stylesheet" href="{{ asset('browers/css/libs/skins/_all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/botones.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inputs_sin_icon.css')  }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body background="{{ asset('images/fondo.png')  }}">

    <br>
      <div align="center"><img src= "{{ asset('images/logomovimoto.png') }}" width="90" height="90"/></div>
    <br>

    <div class="col-md-4 col-md-offset-4">
      <div class="panel panel-heading">
          <h1 class="panel-title">Movimoto</h1>
      </div>

      <!-- /.login-logo -->
        <div class="login-box-body">
          <p class="login-box-msg">Ingrese email para restablecer contraseña</p>
            @if (session('status'))
              <div class="alert alert-success">
                {{ session('status') }}
              </div>
            @endif

            <form method="post" action="{{ url('/password/email') }}">
              {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                  <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                      @if ($errors->has('email'))
                        <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                        </span>
                      @endif
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <button type="submit" class="btn-registro btn btn-block">
                      Enviar enlace de restablecimiento de contraseña
                    </button>
                  </div>
                </div>

            </form>

        </div>
      <!-- /.login-box-body -->
    </div>
      <!-- /.login-box -->

      <!-- jQuery 3.1.1 -->
      <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
      <script src="{{ asset('browers/js/libs/jquery.min.js')}}"></script>
      <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
      <script src="{{ asset('browers/js/bootstrap/bootstrap.min.js')}}"></script>

      <!-- AdminLTE App -->
      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/js/adminlte.min.js"></script> -->
      <script src="{{ asset('browers/js/libs/adminlte.min.js')}}"></script>

      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script> -->
      <script src="{{ asset('browers/js/libs/icheck.min.js')}}"></script>
  </body>
</html>
