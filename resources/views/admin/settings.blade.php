@extends('admin.layouts.admin')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">App Settings</h1>

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
   

    <form method="POST" action="{{ route('update.settings') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        
        <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">App Name:</label>
            <div class="col-sm-9 col-lg-8">
                <input type="text" name="name" value="{{ old('name', is_null($settings)? '' : $settings->name) }}" class="form-control @error('name') is-invalid @enderror" />
                @error('name')
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label">Email:</label>
            <div class="col-sm-9 col-lg-8">
                <input type="text" name="email" value="{{ old('email', is_null($settings)? '' : $settings->email) }}" class="form-control @error('email') is-invalid @enderror" />
                @error('email')
                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="logo" class="col-md-3 col-form-label">Logo:</label>
            <div class="col-md-9 col-lg-8">
                <input type="file" name="logo" />
                @error('logo')
                <div class="invalid-feedback">{{ $errors->first('logo') }}</div>
                @enderror
            </div>
        </div>

        @if($settings->logo != '')
        <div class="form-group row">
            <div class="col-md-3"></div>
            <div class="col-md-9 col-lg-8">
                <img src="{{ asset('imgs') .'/'. $settings->logo }}" width="300">
            </div>
        </div>
        @endif

        <input type="submit" class="btn btn-primary" value="Save" />
    </form>
</div>
<!-- /.container-fluid -->

@endsection
