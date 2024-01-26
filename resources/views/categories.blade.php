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
                        <a class="btn btn-danger" href=""><i class="bi bi-trash"></i></a>
                        <a class="btn btn-success" href=""><i class="bi bi-pencil-square"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection