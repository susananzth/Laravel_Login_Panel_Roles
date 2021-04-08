<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Movimoto | Página de Registro</title>

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
  <body background="../images/fondo.png">

    <br>
      <div align="center"><img src= "{{ asset('images/logomovimoto.png') }}" width="90" height="90"/></div>
    <br>

    <div class="col-md-4 col-md-offset-4">
      <div class="panel panel-heading">
          <h1 class="panel-title">Movimoto</h1>
      </div>

        <div class="register-box-body">
          <p class="login-box-msg">Registrar una nueva cuenta</p>
            <form method="post" action="{{ url('/register') }}" autocomplete="off">
                {!! csrf_field() !!}

                  <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Full Name">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('name'))
                    <span class="help-block">
                      <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                  </div>

                  <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                    <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                  </div>

                  <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                    <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                  </div>

                  <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                      <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                    @endif
                  </div>

                  <div class="row">
                    <div class="col-xs-8">
                      <div class="checkbox">
                        <label>
                          <a href="{{ url('/login') }}" class="text-center" style="color:#177A4B">Ya tengo cuenta</a>
                        </label>
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                      <button type="submit" class="btn-registro btn btn-block">Registro</button>
                    </div>
                    <!-- /.col -->
                  </div>
            </form>

        </div>
      <!-- /.form-box -->
    </div>
      <!-- /.register-box -->

      <!-- jQuery 3.1.1 -->
      <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
      <script src="{{ asset('browers/js/libs/jquery.min.js') }}"></script>
      <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
      <script src="{{ asset('browers/js/bootstrap/bootstrap.min.js') }}"></script>

      <!-- AdminLTE App -->
      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/js/adminlte.min.js"></script> -->
      <script src="{{ asset('browers/js/libs/adminlte.min.js') }}"></script>

      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script> -->
      <script src="{{ asset('browers/js/libs/icheck.min.js') }}"></script>

      <script>
        $(function () {
          $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
          });
        });
      </script>
  </body>
</html>
