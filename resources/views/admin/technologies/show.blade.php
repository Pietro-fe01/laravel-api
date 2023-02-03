@extends('layouts.admin')

@section('page-title')
    {{ $technology->name }}
@endsection

@section('content')
    <h1>Technology name: <span class="text-decoration-underline">{{ $technology->name }}</span></h1>

    @if( $technology->projects->isNotEmpty() )
        <h3 class="mt-3">Where was this technology used:</h3>
        <ul>
            @foreach ($technology->projects as $project)
                <li><a href="{{ route('admin.projects.show', $project) }}">{{ $project->project_title }}</a></li>
            @endforeach
        </ul>
    @else 
        <h3 class="mt-3">No projects have used {{ $technology->name }} yet.</h3>
    @endif
    {{-- Nav links --}}
    <div class="mt-5">
        <a href="{{ route('admin.technologies.index') }}" class="btn btn-secondary">Technology List</a>
        <a href="{{ route('admin.technologies.edit', $technology) }}" class="btn btn-success">Edit this technology</a>
    </div>
@endsection