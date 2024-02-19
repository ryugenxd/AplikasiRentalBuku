@extends('layouts.app')
@section('title','Books')
@section('content')
<div class="p-3">
    <div class="row">
        @foreach($books as $book)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
            <div class="card h-100">
                <img src='{{$book -> cover ?asset("storage/covers/$book->cover"):asset("storage/covers/notfound.png")}}' class="card-img-top" alt="...">
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-1 py-3">
                        @foreach($book -> categories as $category)
                        <span class="badge text-bg-dark">{{$category->name}}</span>
                        @endforeach
                    </div>
                    <p class="card-title text-center">
                       {{$book->title}}
                    </p>
                    <div class="flex gap-1">
                        <span class="badge rounded-pill {{$book->status == 'in stock'? 'bg-success':'bg-danger'}}">
                            {{$book->status}}
                        </span>
                        <span class="badge rounded-pill bg-info">
                            {{$book->code}}
                        </span>
                    </div>
                    <div class="d-flex justify-content-center align-items-center p-3">
                        <a href="#" class="btn btn-warning shadow">Rent Now</a>
                        <div></div>
                    </div>

                </div>
            </div>
        </div>
        @endforeach

    </div>

</div>
@endsection