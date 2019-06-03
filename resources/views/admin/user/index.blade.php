@extends('layouts.app')

@section('content')
    @include('admin.user._nav')
    <div class="d-flex flex-row mb-3">
        <a href="{{route('admin.user.create')}}" class="btn btn-primary mr-1">Create</a>
    </div>
    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as$user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td><a href="{{route('admin.user.show',$user)}}">{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->isActive())
                        <span class="badge badge-primary">Active</span>
                    @endif
                    @if($user->isWait())
                        <span class="badge badge-secondary">Waiting</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
