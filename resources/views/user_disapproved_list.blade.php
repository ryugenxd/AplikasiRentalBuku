@extends('layouts.app')
@section('title','Disapproved List')
@section('content')
<h2>Users</h2>
<div class="mt-5">
    <div class="d-flex justify-content-end align-items-center w-100">
        <div class="mb-4 d-flex justify-content-between align-items-center gap-2">
            <a class="btn btn-secondary" href="{{route('users.deleted')}}">Users Banned</a>
            <a class="btn btn-primary" href="{{route('users')}}">Approved List</a>
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
            <tr @class(["table-danger"=>$user->status!="active"])>
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
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approve{{$user->id}}">
                        <i class="bi bi-check-circle"></i> Approve
                    </button>
                    <div class="modal fade" id="approve{{$user->id}}" tabindex="-1" aria-labelledby="approved" aria-hidden="true">
                        <div class="modal-dialog">
                            <form method="POST" action="{{route('users.approved',[$user->slug])}}" class="modal-content">
                                @csrf
                                @method('put')
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="approved">
                                        Approve 
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <p>Are you sure you want to approve this user ?</p>
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
                    
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete{{$user->id}}">
                        <i class="bi bi-ban"></i>
                    </button>
                        <div class="modal fade" id="confirmDelete{{$user->id}}" tabindex="-1" aria-labelledby="deleted" aria-hidden="true">
                            <div class="modal-dialog">
                                <form method="post"  action="{{route('users.delete',[$user->slug])}}" class="modal-content">
                                        @csrf
                                        @method('delete')
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleted">Modal title</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <p>Are you sure you want to ban this user ?</p>
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
                    <a class="btn btn-primary" href="{{route('users.update',[$user -> slug])}}"><i class="bi bi-pencil-square"></i></a>
                    <button class="btn btn-warning text-white" data-bs-toggle="modal" data-bs-target="#detail{{$user->id}}">
                        <i class="bi bi-person-vcard"></i>
                    </button>
                    <div class="modal fade" id="detail{{$user->id}}" tabindex="-1" aria-labelledby="detail{{$user->id}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div  class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="detail{{$user->id}}">Details</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <div class="p-2">
                                                <p>Status: {{$user->status}}</p>
                                                <h4>Username :</h4> 
                                                <u class="p-2">{{$user->username}}</u>
                                                <div class="border border-primary">
                                                    <h4>Address :</h4>
                                                    <div>
                                                        {{$user->address}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                </div>
                            </div>
                        </div>
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