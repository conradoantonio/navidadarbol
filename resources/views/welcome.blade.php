<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login</title>
        <link rel="shortcut icon" href="{{ asset('img/favicon24x24.png')}}" />
        <link rel="stylesheet" href="{{ asset('plugins/pace/pace-theme-flash.css')}}"  type="text/css" media="screen"/>
        <link rel="stylesheet" href="{{ asset('plugins/boostrapv3/css/bootstrap.min.css')}}"  type="text/css"/>
        <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.css')}}"  type="text/css"/>
        <link rel="stylesheet" href="{{ asset('css/style.css')}}" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,900" rel="stylesheet">
        <style type="text/css">
        /* Change the white to any color ;) */
        input:-webkit-autofill {
            -webkit-box-shadow: 0 0 0px 1000px white inset !important;
            color: red!important;
        }
        .body-login {
            background: url('{{url('')}}/img/bg_login.png');
            background-size: 100% 100%;
            background-repeat: no-repeat;
        }
        img.logo-login {
            width: 75px;
            padding-top: 5.0em;
            padding-bottom: 5.0em;
        }
        input::placeholder, h1.login-header {
            font-family: 'Source Sans Pro', sans-serif;
            color: #2C6C44!important;
            font-size: 16px;
            font-weight: 900;
        }
        input:focus{
            border: 0;
            outline: 0;
            background-color: transparent!important;
            border-bottom: 2px solid #2C6C44!important;
        }
        input[type="text"], input[type="password"] {
            font-size:16px;
            font-weight: 900;
            font-family: 'Source Sans Pro', sans-serif;
            color: #2C6C44!important;
        }
        i.fa{
            color: #2C6C44!important;
        }
        h1.login-header {
            color: #2C6C44!important;
            font-size: 5em;
            font-weight: 300;
            padding-bottom: 1.2em;
        }
        input.form-control {
            background-color: transparent;
            border: 0;
            outline: 0;
            border-bottom: 2px solid #2C6C44;
        }
        button {
            margin-top: 2.5em;
            font-weight: bold;
            width: 300px;
            border: none;
            background: #E34647;
            color: #f2f2f2;
            padding: 5px;
            font-size: 14px;
            border-radius: 40px;
            position: relative;
            box-sizing: border-box;
            transition: all 500ms ease;
        }
        button:hover {
            cursor: pointer;
            background: rgba(0,0,0,0);
            color: #E34647;
            box-shadow: inset 0 0 0 3px #E34647;
        }
        .show-error {
            font-size: 12px;
            color: maroon;
            display: block;
            margin-top: 2%;
            margin-bottom: 3%;
        }
        </style>
    </head>
    <body class="body-login">
        <div class="">
            <div class="col-lg-6 text-center">
                <div class="col-xs-12 col-sm-8 col-sm-push-2 col-sm-pull-2 col col-md-6 col-md-push-3 col-md-pull-3">
                    <div class="p-t-20 p-l-15 p-r-15 p-b-30">
                        <form class="m-t-30 m-l-15 m-r-15 form-horizontal" method="POST" action="login" autocomplete="off">
                            <img class="logo-login" src="{{asset('img/arbol-icono.png')}}">
                            <h1 class="login-header">Login</h1>
                            {!! csrf_field() !!}
                            <div class="form-group {{ $errors->has('user') || $errors->has('status') ? ' error' : '' }}">
                                <label for="user" class="col-sm-2 control-label"><i class="fa fa-2x fa-envelope" aria-hidden="true"></i></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="user" name="user" value="{{ @session('account') ? session('account') : '' }}" placeholder="Usuario">
                                </div>
                                @if ($errors->has('user'))
                                    <span class="show-error">
                                        <strong>{{ $errors->first('user') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('status'))
                                    <span class="show-error">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label"><i class="fa fa-2x fa-lock" aria-hidden="true"></i></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="password" name="password" placeholder="Contraseña">
                                </div>
                            </div>
                            @if ($errors->has('password'))
                                <span class="show-error">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            <button class="" type="submit">INGRESAR</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="{{ asset('js/sweetalert.min.js') }}"></script>
        <script src="{{ asset('plugins/boostrapv3/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/pace/pace.min.js') }}" type="text/javascript"></script>
    </body>
</html>
