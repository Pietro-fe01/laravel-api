@extends('layouts.admin')

@section('page-title')
    New project
@endsection

@section('content')
    <h1 class="my-3">Creating new project</h1>

    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="project_title" class="form-label">Title*</label>
            <input type="text" id="project_title" name="project_title" class="form-control @error('project_title') is-invalid @enderror" value="{{ old('project_title') }}">
            @error('project_title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="customer_name" class="form-label">Customer name*</label>
            <input type="text" id="customer_name" name="customer_name" class="form-control @error('customer_name') is-invalid @enderror" value="{{ old('customer_name') }}">
            @error('customer_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description*</label>
            <textarea name="description" id="description" cols="30" rows="5" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cover_image" class="form-label">Cover image</label>
            <input type="file" id="cover_image" name="cover_image" class="form-control w-50  @error('cover_image') is-invalid @enderror" onchange="loadFile(event)">
            @error('cover_image')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            <div class="mt-3">
                <img id="output" src="" class="fluid-img w-25">
            </div>

            <script>
                var loadFile = function(event) {
                    var reader = new FileReader();
                    reader.onload = function(){
                        var output = document.getElementById('output');
                        output.src = reader.result;
                    };
                    reader.readAsDataURL(event.target.files[0]);
                };
            </script>
        </div>

        {{-- Select with all types avaiable --}}
        <div class="mb-3">
            <label for="type_id" class="form-label">Types</label>
            <select name="type_id" id="type_id" class="form-select">
                <option value="" selected >No type</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : null }}>{{ $type->name }}</option>
                @endforeach
            </select>
            @error('type_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Checkboxes with technologies --}}
        <div class="my-3">
            @foreach ($technologies as $technology)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="{{ $technology->slug }}}}" name="technologies[]" value="{{ $technology->id }}" {{ in_array($technology->id, old('technologies', [])) ? 'checked' : null }}>
                    <label class="form-check-label" for="{{ $technology->slug }}}}">{{ $technology->name }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success">CREATE</button>
        <button type="reset" class="btn btn-secondary">RESET</button>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-danger">UNDO</a>
    </form>
@endsection