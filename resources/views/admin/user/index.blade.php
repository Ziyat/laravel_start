@extends('layouts.admin')

@section('content')
    <div class="card shadow">
        <div class="card-header">
            <a href="{{route('admin.user.create')}}" class="btn btn-primary mr-1">Create</a>
        </div>
        <div class="card-body">
            <form action="?" method="GET" class="form-inline">
                <div class="form-group mx-1 mb-1">
                    <label for="id" class="sr-only">ID</label>
                    <input type="number" class="form-control" id="id" name="id" placeholder="ID">
                </div>
                <div class="form-group mx-1 mb-1">
                    <label for="Name" class="sr-only">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                </div>
                <div class="form-group mx-1 mb-1">
                    <label for="email" class="sr-only">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="email">
                </div>
                <div class="form-group mx-1 mb-1">
                    <label for="status" class="sr-only">status</label>
                    <select class="custom-select" name="status" id="status">
                        <option value="">select</option>
                        @foreach($statuses as $k => $status)
                            <option value="{{ $k }}">{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mx-1 mb-1">
                    <label for="status" class="sr-only">role</label>
                    <select class="custom-select" name="status" id="status">
                        <option value="">select</option>
                        @foreach($roles as $role)
                            <option value="{{ $role }}">{{ $role }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="mx-1 mb-1">
                    <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i> search</button>
                </div>

            </form>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                    <th scope="col">Role</th>
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
                                <span class="badge badge-primary">{{$user->status}}</span>
                            @endif
                            @if($user->isWait())
                                <span class="badge badge-secondary">{{$user->status}}</span>
                            @endif
                        </td>
                        <td>
                            @if($user->isAdmin())
                                <span class="badge badge-danger">{{$user->role}}</span>
                            @elseif($user->isVendor())
                                <span class="badge badge-dark">{{$user->role}}</span>
                            @else
                                <span class="badge badge-info">{{$user->role}}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between">
            {{$users->links()}}
            <span class="align-self-center">views: {{$users->count()}}, total: {{$users->total()}}</span>
        </div>
    </div>

@endsection
