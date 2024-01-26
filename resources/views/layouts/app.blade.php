<!Doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RENTAL BUKU | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
  </head>
  <body>
    <div class="main d-flex flex-column justify-content-between">
      <nav class="navbar navbar-dark navbar-expand-lg bg-primary">
        <div class="container-fluid">
          <h1 class="navbar-brand">RENTAL BUKU</h1>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </nav>
      <div class="main-content h-100">
          <div class="row g-0 h-100">
            <div class="sidebar  col-lg-2 collapse d-lg-block" id="navbarSupportedContent">
                @if(Auth::user()->role_id != 2)
                  <a href="{{route('dashboard')}}" class="{{Request::is('dashboard') ? 'active' : ' '}}">Dashboard</a>
                  <a href="{{route('books')}}" class="{{Request::is('books') ? 'active' : ' '}}">Books</a>
                  <a href="{{route('categories')}}" class="{{Request::is('categories') ? 'active' : ' '}}">Categories</a>
                  <a href="{{route('users')}}" class="{{Request::is('users') ? 'active' : ' '}}">Users</a>
                  <a href="{{route('logs')}}" class="{{Request::is('logs') ? 'active' : ' '}}">Log Activity</a>
                  <a href="{{route('logout')}}" class="{{Request::is('logout') ? 'active' : ' '}}">Logout</a>
                @else
                  <a href="{{route('books')}}" class="{{Request::is('books') ? 'active' : ' '}}">Books</a>
                  <a href="{{route('profile')}}" class="{{Request::is('profile') ? 'active' : ' '}}">Profile</a>
                  <a href="{{route('logout')}}" class="{{Request::is('logout') ? 'active' : ' '}}">Logout</a>
                @endif
            </div>
            <div class="content col-lg-10 p-5">
              @yield('content')
            </div>
          </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>