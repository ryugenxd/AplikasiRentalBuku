@extends('layouts.app')
@section('title','Add Category')
@section('content')
<h1>Add Category</h1>
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
</div>

@endsection