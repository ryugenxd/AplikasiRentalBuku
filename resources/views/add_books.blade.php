@extends('layouts.app')
@section('title','Add Book')
@section('content')
<link href="{{asset('theme/css/select2.min.css')}}" rel="stylesheet" />
<h1>Add Book</h1>
<div class="row mt-3">
    <div class="col-lg-6 col-ms-5 col-md-7">
        <div class="mt-4">
            <form action="{{route('books.created')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="p-3 mb-2">
                    <label for="code" class="form-label">Code</label>
                    <input id="code" type="text" name="code" class="form-control" value="{{old('code')}}"/>
                    @error('code')
                        <div class="alert alert-danger mt-2">
                            {{$message}}
                        </div>
                    @enderror
                </div>      
                <div class="p-3 mb-2">
                    <label for="title" class="form-label">Title</label>
                    <input id="title" type="text" name="title" class="form-control" value="{{old('title')}}"/>
                    @error('title')
                        <div class="alert alert-danger mt-2">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="p-3 mb-2">
                    <label for="cover" class="form-label">Cover</label>
                    <input id="cover" type="file" name="cover" class="form-control" accept="image/*"/>
                    @error('cover')
                        <div class="alert alert-danger mt-2">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="p-3 mb-2">
                    <label for="categories" class="form-label">Category</label>
                    <select name="categories[]" id="categories" class="form-control multiple-select" multiple>
                        @forelse($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @empty
                        <option>Category Is Empty</option>
                        @endforelse
                    </select>
                </div>
                <div class="p-3 d-flex justify-content-end aling-items-center">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mt-4">
            @if(Session::has('message'))
                <div class="alert  {{Session::get('message')['status']}}">
                    {{Session::get('message')['value']}}
                </div>
            @endif
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
                @forelse ($books as $book)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td class="text-center">{{$book -> title}}</td>
                        <td class="text-end">
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete">
                                <i class="bi bi-trash"></i>
                            </button>
                            <div class="modal fade" id="confirmDelete" tabindex="-1" aria-labelledby="deleted" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form method="post"  action="{{route('books.delete',[$book -> slug])}}" class="modal-content">
                                        @csrf
                                        @method('delete')
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleted">Modal title</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <p>Are you sure you want to delete this book ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">
                                                OK, I'm sure
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="btn btn-success" href="{{route('books.update',[$book -> slug])}}"><i class="bi bi-pencil-square"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            Data Is Empty
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="{{asset('theme/js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('theme/js/select2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.multiple-select').select2();
    });
</script>
@endsection