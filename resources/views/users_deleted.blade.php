@extends('layouts.app')
@section('title','Users Banned')
@section('content')
<div class="row">
    <h2 class="p-2">Users Banned</h2>
    <div>
        <div class="mb-4 d-flex justify-content-end align-items-center w-100">
            <a class="btn btn-primary" href="{{route('users')}}">Back</a>
        </div>
        <table class="table">
            <thead>
                <tr class="table-primary">
                    <th>No.</th>
                    <th class="text-center">Username</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$loop->iteration}}.</td>
                    <td class="text-center">{{$user -> username}}</td>
                    <td class="text-end">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmRestored">
                            <i class="bi bi-arrow-clockwise"></i>
                        </button>
                        <div class="modal fade" id="confirmRestored" tabindex="-1" aria-labelledby="restored" aria-hidden="true">
                            <div class="modal-dialog">
                                <form method="post"  action="{{route('users.restore',[$user -> slug])}}" class="modal-content">
                                    @csrf
                                    @method('put')
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="restored">Modal title</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <p>Are you sure you want to restore this user ?</p>
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
