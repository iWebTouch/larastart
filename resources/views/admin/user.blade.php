@extends('admin.layouts.admin')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit User</h1>

    @if($errors->any())
    <div class="row">
        <div class="alert alert-danger col-sm-12">
            Please fix some errors.
        </div>
    </div>
    @elseif(session('status'))
    <div class="row">
        <div class="alert alert-success col-sm-12">
            {{ session('status') }}
        </div>
    </div>
    @endif
   

    <form method="POST" action="{{ route('update.user', ['user' => $user->id]) }}">
    @csrf
    @method('PUT')
        
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Name:</label>
            <div class="col-sm-10">
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror" />
                @error('name')
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label form="email" class="col-sm-2 col-form-label">Email:</label>
            <div class="col-sm-10">
                <input type="text" name="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror" />
                @error('email')
                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2">Role:</label>
            <div class="col-sm-10">
                <div class="form-check form-check-inline">
                    <input type="radio" name="is_admin" value="1" {{ $user->is_admin==1? 'checked="checked"' : '' }} class="form-check-input" id="role1" /> 
                    <label class="form-check-label" for="role1">Admin</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="is_admin" value="0" {{ $user->is_admin!=1? 'checked="checked"' : '' }} class="form-check-input" id="role2" /> 
                    <label class="form-check-label" for="role2">User</label>
                </div>
            </div>
        </div>
        
        <input type="submit" class="btn btn-primary" value="Save" />
        <a href="{{ route('manage.users') }}" class="btn btn-secondary" >Back</a>
    </form>
</div>
<!-- /.container-fluid -->

@endsection
