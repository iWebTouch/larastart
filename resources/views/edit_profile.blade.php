@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Profile</div>
            
                <div class="card-body">
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
    
                    <form method="POST" action="{{ route('edit.profile') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label">Name:</label>
                        <div class="col-md-9 col-lg-8">
                            <input type="text" name="name" value="{{ old('name', is_null($user)? '' : $user->name) }}" class="form-control @error('name') is-invalid @enderror" />
                            @error('name')
                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-3 col-form-label">Email:</label>
                        <div class="col-md-9 col-lg-8">
                            <input type="text" name="email" value="{{ old('email', is_null($user)? '' : $user->email) }}" class="form-control @error('email') is-invalid @enderror" />
                            @error('email')
                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-3 col-form-label">Password:</label>
                        <div class="col-md-7 col-lg-6">
                            <input type="password" name="passwd" value="{{ old('passwd') }}" class="form-control @error('passwd') is-invalid @enderror" />
                            @error('passwd')
                            <div class="invalid-feedback">{{ $errors->first('passwd') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="passwd_confirmation" class="col-md-3 col-form-label">Confirm Password:</label>
                        <div class="col-md-7 col-lg-6">
                            <input type="password" name="passwd_confirmation" value="{{ old('passwd_confirmation') }}" class="form-control @error('passwd_confirmation') is-invalid @enderror" />
                            @error('passwd_confirmation')
                            <div class="invalid-feedback">{{ $errors->first('passwd_confirmation') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="avatar" class="col-md-3 col-form-label">Avatar:</label>
                        <div class="col-md-9 col-lg-8">
                            <input type="file" name="avatar" />
                            @error('avatar')
                            <div class="invalid-feedback">{{ $errors->first('avatar') }}</div>
                            @enderror
                        </div>
                    </div>

                    @if($user->avatar != '')
                    <div class="form-group row">
                        <div class="col-md-3"></div>
                        <div class="col-md-9 col-lg-8">
                            <img src="{{ asset('imgs') .'/'. $user->avatar }}" width="150" height="150">
                        </div>
                    </div>
                    @endif

                    <input type="submit" class="btn btn-primary" value="Save" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
