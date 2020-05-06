@extends('admin.layouts.admin')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $page['title'] }}</h1>

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
   

    <form method="POST" action="{{ $form['action'] }}">
    @csrf
    @if ($form['method'] == 'PUT')
    @method('PUT')
    @endif
        
        <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Name:</label>
            <div class="col-sm-9 col-lg-8">
                <input type="text" name="name" value="{{ old('name', is_null($user)? '' : $user->name) }}" class="form-control @error('name') is-invalid @enderror" />
                @error('name')
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                @enderror
            </div>
        </div>

        <input type="submit" class="btn btn-primary" value="Save" />
        <a href="{{ route('manage.users') }}" class="btn btn-secondary" >Back</a>
    </form>
</div>
<!-- /.container-fluid -->

@endsection
