<!rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65octype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman LOGIN</title>
   <link rel="stylesheet" href="{{asset('theme/css/bootstrap.css')}}">
    <style>
        .main{
            height:100vh;
            box-sizing:border-box;
        }
        .login-box{
            width:500px;
            border: solid 1px;
            padding:1rem;
        }
        form div{
            margin-bottom:15px;
        }
    </style>
  </head>
  <body>
    <div class="main d-flex justify-content-center align-items-center">
        <div class="login-box">
        @if (Session::has('status'))
            <div class="alert alert-danger">
                {{ Session::get('message') }}
            </div>
        @endif
            <form action="{{route('login.authentication')}}" method="post">
                @csrf
                <div>
                    <label for="username" class="form-label">Username</label>
                    <input id="username" type="text" name="username" class="form-control" required/>
                </div>
                <div>
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" name="password" class="form-control" required/>
                </div>
                <div>
                    <button class="btn btn-primary form-control" type="submit">Login</button>
                </div>
                <div class="text-center">
                    Don't have account? <a href="{{route('register')}}" >Sign Up</a>
                </div>
            </form>
        </div>
    </div>
    <script src="{{asset('theme/js/bootstrap.js')}}" crossorigin="anonymous"></script>
  </body>
</html>