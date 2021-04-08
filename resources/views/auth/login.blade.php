@extends('layouts.external_layouts')
@section('title', 'Iniciar Sesión')

@section('css')

@endsection

@section('content')

      @include('flash::message')
        <h1 class="page-header-title">Iniciar sesión adm <i class="fa fa-address-card" aria-hidden="true"></i></h1>
          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif
          <br>
          @include('flash::message')
            <form method="post" action="{{ url('/login') }}" autocomplete="off" id="formLoginAdm">
              {!! csrf_field() !!}
              @include('flash::message')
              <div class="form-row justify-content-center">
                  <div class="col-lg-6 col-md-8">

                <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                  <div class="mr-0 mr-lg-2">
                  <input type="email" class="required form-control form-control-solid rounded-pill" name="email" value="{{ old('email') }}" placeholder="Email">
                   </div>
                   <div><span class="help-block" id="error"></span></div>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                      @if ($errors->has('email'))
                      <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                      </span>
                    @endif
                </div>

                <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                  <div class="mr-0 mr-lg-2">
                  <input type="password" class="required form-control form-control-solid rounded-pill" placeholder="Password" name="password">
                    </div>
                    <div><span class="help-block" id="error"></span></div>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                      @if ($errors->has('password'))
                      <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                      </span>
                    @endif
                </div>

                <div class="align-items-center containers">
                  <div class="center">
                      <button type="submit" class="btn-registro btn btn-win btn-marketing rounded-pill">
                        Acceder
                      </button>
                    </div>
                </div>
              </div>
              </div>

            </form>



              @endsection

              @section('scripts')
              <!--<script src="{{ asset('js/externo/auth_app/login.js')}} "></script>-->
              <script>
              $(function () {
                $('input').iCheck({
                  checkboxClass: 'icheckbox_square-blue',
                  radioClass: 'iradio_square-blue',
                  increaseArea: '20%' // optional
                });
              });
              $('div.alert').not('.alert-important').delay(6000).fadeOut(350);
              </script>
              <script src="{{ asset('js/externo/auth_app/loginadm.js')}} "></script>
              @endsection
