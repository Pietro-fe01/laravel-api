@extends('layouts.admin')

@section('page-title')
    Edit {{ $project->project_title }}
@endsection

@section('content')
    <h1 class="my-3">Editing project "{{ $project->project_title }}"</h1>

    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="d-block" for="project_title" class="form-label">Title</label>
            <input type="text" id="project_title" name="project_title" class="form-control @error('project_title') is-invalid @enderror" value="{{ old('project_title', $project->project_title) }}">
            @error('project_title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="d-block" for="customer_name" class="form-label">Customer name</label>
            <input type="text" id="customer_name" name="customer_name" class="form-control @error('customer_name') is-invalid @enderror" value="{{ old('customer_name', $project->customer_name) }}">
            @error('customer_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="d-block" for="description" class="form-label">Description</label>
            <textarea name="description" id="description" cols="30" rows="5" class="form-control @error('description') is-invalid @enderror">{{ old('description', $project->description) }}</textarea>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="d-block" for="cover_image" class="form-label">Cover image</label>

            <div class="d-flex align-items-center">
                <div class="w-50 me-4">
                    <input type="file" id="cover_image" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror" onchange="loadFile(event)">
                    @error('cover_image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                @if ( $project->cover_image )
                    <div class="form-check form-switch ">
                        <input class="form-check-input" type="checkbox" role="switch" id="remove_image" name="remove_image">
                        <label class="form-check-label" for="remove_image">Remove image</label>
                    </div>
                @endif
            </div>
            
            <div class="mt-4">
                <img id="output" @if( $project->cover_image ) src="{{ asset("storage/$project->cover_image") }}" alt="img-preview" @endif class="fluid-img w-25">
            </div>

            <script>
                // Switch checkbox disabled or not
                    const inputCheckBox = document.getElementById('remove_image');
                    const inputFile = document.getElementById('cover_image');
                    
                    if ( inputCheckBox ) {
                        inputCheckBox.addEventListener('change', function(){
                            if ( inputCheckBox.checked ) {
                                return inputFile.disabled = true;
                            } else {
                                return inputFile.disabled = false;
                            }
                        });
                    }

                // Function display preview image
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
                <option value="" selected>No type</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ old('type_id', $project->type_id) == $type->id ? 'selected' : null }}>{{ $type->name }}</option>
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
                    @if ( $errors->any() )
                        <input class="form-check-input" type="checkbox" id="{{ $technology->slug }}}}" name="technologies[]" value="{{ $technology->id }}" {{ in_array($technology->id, old('technologies', [])) ? 'checked' : null }}>
                    @else
                        <input class="form-check-input" type="checkbox" id="{{ $technology->slug }}}}" name="technologies[]" value="{{ $technology->id }}" {{ $project->technologies->contains($technology->id) ? 'checked' : null }}>
                    @endif
                    <label class="form-check-label" for="{{ $technology->slug }}}}">{{ $technology->name }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success">EDIT</button>
        <button type="reset" class="btn btn-secondary">RESET</button>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-danger">UNDO</a>
    </form>
@endsection