@extends('layouts.admin')
@section('content')
    <div class="card shadow">
        <div class="card-header">
            <h4 class="text-primary">Create user</h4>
        </div>
        <div class="card-body">
            <form action="{{route('admin.user.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="col-form-label" for="name">Name</label>
                    <input name="name" class="form-control{{ $errors->has('name') ? ' is-invalid': '' }}" id="name"
                           value="{{ old('name') }}" required>
                    @if($errors->has('name'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="email">Email</label>
                    <input name="email"
                           type="email"
                           class="form-control{{ $errors->has('name') ? ' is-invalid': '' }}"
                           id="email"
                           value="{{ old('email') }}" required>
                    @if($errors->has('email'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
