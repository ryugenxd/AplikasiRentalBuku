@extends('layouts.app')
@section('title','Add user')
@section('content')
<h1>Add User</h1>
<div class="row mt-3">
    <div class="col-lg-6 col-ms-5 col-md-7">
        <div class="mt-4">
            <form action="{{route('categories.created')}}" method="post">
                @csrf
                <div class="p-3 mb-5">
                    <label for="name" class="form-label">Category Name</label>
                    <input id="name" type="text" name="name" class="form-control"/>
                    @error('name')
                        <div class="alert alert-danger mt-2">
                            {{$message}}
                        </div>
                    @enderror
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
                <div class="alert alert-success">
                    {{Session::get('message')}}
                </div>
            @endif
            <div class="mb-4 d-flex justify-content-end align-items-center w-100">
                <a class="btn btn-primary" href="{{route('categories')}}">Back</a>
            </div>
            <table class="table">
                <thead>
                    <tr class="table-primary">
                        <th>No.</th>
                        <th class="text-center">Name</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td class="text-center">{{$category -> name}}</td>
                        <td class="text-end">
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete">
                                <i class="bi bi-trash"></i>
                            </button>
                            <div class="modal fade" id="confirmDelete" tabindex="-1" aria-labelledby="deleted" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form method="post"  action="{{route('categories.delete',[$category -> slug])}}" class="modal-content">
                                        @csrf
                                        @method('delete')
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleted">Modal title</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <p>Are you sure you want to delete this category ?</p>
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
                            <a class="btn btn-success" href="{{route('categories.update',[$category -> slug])}}"><i class="bi bi-pencil-square"></i></a>
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
@endsection