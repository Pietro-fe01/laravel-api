@extends('layouts.admin')

@section('page-title')
    New technology
@endsection

@section('content')
    <h1 class="my-3">Creating new Technology</h1>

    <form action="{{ route('admin.technologies.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="name" class="form-label">Name*</label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Type name input">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">CREATE</button>
        <button type="reset" class="btn btn-secondary">RESET</button>
        <a href="{{ route('admin.technologies.index') }}" class="btn btn-danger">UNDO</a>
    </form>
@endsection