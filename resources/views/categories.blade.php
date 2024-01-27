@extends('layouts.app')
@section('title','Categories')
@section('content')
<div class="row">
    <h2 class="p-2">Categories</h2>
    <div>
        <div class="d-flex justify-content-end align-items-center w-100">
            <a class="btn btn-primary mb-4" href="{{route('categories.create')}}">Tambah Data</a>
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
                @foreach($categories as $category)
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
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
