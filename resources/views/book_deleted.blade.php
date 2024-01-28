@extends('layouts.app')
@section('title','Books Deleted')
@section('content')
<div class="row">
    <h2 class="p-2">Books  Deleted</h2>
    <div>
        <div class="mb-4 d-flex justify-content-end align-items-center w-100">
            <a class="btn btn-primary" href="{{route('books')}}">Back</a>
        </div>
        <table class="table">
            <thead>
                <tr class="table-primary">
                    <th>No.</th>
                    <th class="text-center">Title</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr>
                    <td>{{$loop->iteration}}.</td>
                    <td class="text-center">{{$book -> title}}</td>
                    <td class="text-end">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmRestored">
                            <i class="bi bi-arrow-clockwise"></i>
                        </button>
                        <div class="modal fade" id="confirmRestored" tabindex="-1" aria-labelledby="restored" aria-hidden="true">
                            <div class="modal-dialog">
                                <form method="post"  action="{{route('books.restore',[$book -> slug])}}" class="modal-content">
                                    @csrf
                                    @method('put')
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="restored">Modal title</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <p>Are you sure you want to restore this category ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">
                                            OK, I'm sure
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
