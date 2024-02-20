@extends('layouts.app')
@section('title','Return Book')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="d-flex justify-content-center align-items-center p-4">
    <form action="" method="post" class="p-3">
        @csrf
        @if(Session::has('message'))
                <div class="alert {{Session::get('message')['status']}}">
                    {{Session::get('message')['value']}}
                </div>
        @endif
        <div class="p-4">
            <h1>Return Books</h1>
        </div>
        <div class="p-4">
            <select name="user_id" id="user" class="form-control">
                <option selected>Select User</option>
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->username}}</option>
                @endforeach
            </select>
        </div>
        <div class="p-4">
            <select name="book_id" id="book" class="form-control">
                <option selected>Select Book</option>
                @foreach($books as $book)
                    <option value="{{$book->id}}">{{$book->code}} {{$book->title}}</option>
                @endforeach
            </select>
        </div>
        <button class="w-100 btn btn-primary" type="submit">Submit</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('#user').select2();
    $('#book').select2();
});
</script>
@endsection