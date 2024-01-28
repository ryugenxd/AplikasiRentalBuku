@extends('layouts.app')
@section('title','Users')
@section('content')
<h2>Users</h2>
<div class="mt-5">
    <div class="d-flex justify-content-end align-items-center w-100">
        <div class="mb-4 d-flex justify-content-between align-items-center gap-2">
            <a class="btn btn-secondary" href="{{route('books.deleted')}}">Users Deleted</a>
            <a class="btn btn-primary" href="{{route('books.create')}}">Tambah Data</a>
        </div>
    </div>
    <table class="table">
        <thead class="table-primary">
            <tr>
                <th>
                    No.
                </th>
                <th class="text-center">
                    Username
                </th>
                <th class="text-center">
                    Phone
                </th>
                <th class="text-end">
                    Action
                </th>
            </tr>
            
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>
                   {{$loop->iteration}}.
                </td>
                <td class="text-center">
                    {{$user->username}}
                </td>
                <td class="text-center">
                    {{$user->phone}}
                </td>
                <td class="text-end">
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete">
                        <i class="bi bi-dash-circle"></i>
                    </button>
                        <div class="modal fade" id="confirmDelete" tabindex="-1" aria-labelledby="deleted" aria-hidden="true">
                            <div class="modal-dialog">
                                <form method="post"  action="" class="modal-content">
                                        @csrf
                                        @method('delete')
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleted">Modal title</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <p>Are you sure you want to delete this user ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">
                                                OK, I'm sure
                                            </button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    <a class="btn btn-success" href="{{route('users.update',[$user -> slug])}}"><i class="bi bi-pencil-square"></i></a>
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
@endsection