@extends('layouts.admin')
@section('content')
    <div class="card shadow">
        <div class="card-header">
            <div class="d-flex flex-row mb-3">
                <a href="{{ route('admin.user.edit', $user) }}" class="btn btn-primary mr-1">Edit</a>
                <form action="{{route('admin.user.destroy', $user)}}" method="POST" class="mr-1">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Delete</button>
                </form>
                @if($user->isWait())
                    <form action="{{ route('admin.user.verify',$user) }}" method="POST" class="mr-1">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-success">Verify</button>
                    </form>
                @endif
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tbody>
                <tr>
                    <td>#</td>
                    <th scope="row">{{ $user->id }}</th>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><a href="{{route('admin.user.show',$user)}}">{{ $user->name }}</a></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        @if($user->isActive())
                            <span class="badge badge-primary">Active</span>
                        @endif
                        @if($user->isWait())
                            <span class="badge badge-secondary">Waiting</span>
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
