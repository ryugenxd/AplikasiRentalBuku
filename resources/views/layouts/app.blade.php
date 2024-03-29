<!Doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RENTAL BUKU | @yield('title')</title>
    <link rel="stylesheet" href="{{asset('theme/css/bootstrap.min.css')}}">
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
              @if(Auth::user())
                @if(Auth::user()->role_id != 2)
                  <a href="{{route('dashboard')}}" class="{{Request::is('dashboard') ? 'active' : ' '}}">Dashboard</a>
                  <a href="{{route('categories')}}" class="{{Request::is('categories') || Request::is('categories/*') ? 'active' : ' '}}">Categories</a>
                  <a href="{{route('books')}}" class="{{Request::is('books') || Request::is('books/*') && !Request::is('books/rent') && !Request::is('books/return') ? 'active' : ' '}}">Books</a>
                  <a href="{{route('users')}}" class="{{Request::is('users') || Request::is('users/*') ? 'active' : ' '}}">Users</a>
                  <a href="{{route('logs')}}" class="{{Request::is('logs') ? 'active' : ' '}}">History  </a>
                  <a href="{{route('public_views')}}" class="{{Request::is('/') ? 'active' : ' '}}">Book List</a>
                  <a href="{{route('books.rent')}}" class="{{Request::is('books/rent') ? 'active' : ' '}}">Rent Books</a>
                  <a href="{{route('books.return')}}"  class="{{Request::is('books/return') ? 'active' : ' '}}">Return Books</a>
                  <a href="{{route('logout')}}" class="{{Request::is('logout') ? 'active' : ' '}}">Logout</a>
                @else
                  <a href="{{route('public_views')}}" class="{{Request::is('/') ? 'active' : ' '}}">Book List</a>
                  <a href="{{route('profile')}}" class="{{Request::is('profile') ? 'active' : ' '}}">Profile</a>
                  <a href="{{route('logout')}}" class="{{Request::is('logout') ? 'active' : ' '}}">Logout</a>
                @endif
              @else 
              <a href="{{route('login')}}">Login</a>
              @endif
            </div>
            <div class="content col-lg-10 p-5">
              @yield('content')
            </div>
          </div>
      </div>
    </div>
    <script src="{{asset('theme/js/bootstrap.bundle.min.js')}}"></script>
  </body>
</html>