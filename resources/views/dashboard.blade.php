@extends('layouts.app')
@section('title','Dashboard')
@section('content')
<div class="row">
    <h4>Welcome, admin</h4>
    <div class="col-lg-3 gen-card">
        <div class="gen-card-icon">
            <i class="bi bi-journal-bookmark"></i>
        </div>
        <div class="gen-card-dsc">
            <span class="h4">{{$bookCount}}</span>
            <span>Books</span>
        </div>
    </div>
    <div class="col-lg-3 gen-card">
        <div class="gen-card-icon">
            <i class="bi bi-list-task"></i>
        </div>
        <div class="gen-card-dsc">
            <span class="h4">{{$categoryCount}}</span>
            <span>Categories</span>
        </div>
    </div>
    <div class="col-lg-3 gen-card">
        <div class="gen-card-icon">
            <i class="bi bi-people"></i>   
        </div>
        <div class="gen-card-dsc">
            <span class="h4">{{$userCount}}</span>
            <span>Users</span>
        </div>
    </div>
<div>
<div class="mt-5">
    <h5>#History </h5>
    <table class="table">
        <thead>
            <tr class="table-primary">
                <th>No.</th>
                <th>Username</th>
                <th>Book Title</th>
                <th>Date</th>
                <th>Return Date</th>
                <th>Actual Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($histories as $history)
            <tr class="{{ $history->actual_date == null ? '' : ($history->return_date < $history -> actual_date ? 'text-bg-danger':'text-bg-success')}}">
                <td>
                   {{$loop -> iteration}}
                </td>
                <td>
                    {{$history -> user -> username}}
                </td>
                <td>
                    {{$history -> book -> title}}
                </td>
                <td>
                    {{$history -> date}}
                </td>
                <td>
                    {{$history -> return_date}}
                </td>
                <td>
                    {{$history -> actual_date}}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">
                   Data Is Empty
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection