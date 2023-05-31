@extends('layouts.layout')

@section('content')
    <h2>Add Role</h2>
    <form method="post" action="{{ route('permission.create.role') }}">
        @csrf
        <div class="form-group">
            <label for="name">Role Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <hr>
    <h2>Add Permission</h2>
    <form method="post" action="{{ route('permission.create.permission') }}">

@endsection
