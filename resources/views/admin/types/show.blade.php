@extends('layouts.admin')

@section('page-title')
    {{ $type->name }}
@endsection

@section('content')
    <h1 class="mb-3">Projects with "<span class="text-decoration-underline">{{ $type->name }}</span>" type:</h1> 

    @if ( $type->projects->isNotEmpty() )
        <ul>
            @foreach ($type->projects as $project)
                <li>
                    <a href="{{ route('admin.projects.show', $project) }}">
                        {{ $project->project_title }}
                    </a>
                </li>
            @endforeach
        </ul>
    @else 
        <h3 class="text-danger text-decoration-underline">None yet.</h3>
    @endif

    {{-- Nav links --}}
    <div class="mt-5">
        <a href="{{ route('admin.types.index') }}" class="btn btn-secondary">Type List</a>
        <a href="{{ route('admin.types.edit', $type) }}" class="btn btn-success">Edit this type</a>
    </div>
@endsection