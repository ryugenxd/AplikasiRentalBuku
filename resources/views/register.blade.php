<!rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65octype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman REGISTER</title>
    <link rel="stylesheet" href="{{asset('theme/css/bootstrap.css')}}">
    <style>
        .main{
            height:100vh;
            box-sizing:border-box;
        }
        .register-box{
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
        <div class="register-box">
        @if (Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif
            <form action="{{route('register.authentication')}}" method="post">
                @csrf
                <div>
                    <label for="username" class="form-label">Username</label>
                    <input id="username" type="text" name="username" class="form-control" />
                    @error('username')
                    <div class="alert alert-danger p-2 mt-2">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div>
                    <label for="phone" class="form-label">Phone</label>
                    <input id="phone" type="number" name="phone" class="form-control" />
                </div>
                <div>
                    <label for="address" class="form-label">Address</label>
                    <textarea id="address"  name="address" class="form-control" /></textarea>
                    @error('address')
                    <div class="alert alert-danger p-2 mt-2">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div>
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" name="password" class="form-control"/>
                    @error('password')
                    <div class="alert alert-danger p-2 mt-2">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div>
                    <button class="btn btn-primary form-control" type="submit">Sign Up</button>
                </div>
                <div class="text-center">
                    Your Have Account? <a href="{{route('login')}}" >Login</a>
                </div>
            </form>
        </div>
    </div>
    <script src="{{asset('theme/js/bootstrap.js')}}" crossorigin="anonymous"></script>
  </body>
</html>