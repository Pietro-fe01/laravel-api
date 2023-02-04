@extends('layouts.admin')

@section('page-title')
    {{ $project->project_title }}
@endsection

@section('content')
    <h1 class="text-decoration-underline my-3">{{ $project->project_title }}</h1>

    @if ( $project->type?->name )
        <h3> Type:
            <a href="{{ route('admin.types.show', $project->type) }}">
                {{ $project->type->name }}
            </a>
        </h3>
    @else
        <h3>No type was provided</h3>
    @endif

    <div>
        <h3 class="m-0 mt-4">Customer:</h3>
        <h5>{{ $project->customer_name }}.</h5>
    </div>

    <div>
        <h3 class="m-0 mt-4">Description:</h3>
        <p>{{ $project->description }}</p>
    </div>

    @if ( $project->cover_image )
        <div>
            <img class="fluid-img w-50" src="{{ asset("storage/$project->cover_image") }}" alt="{{ $project->project_title }}">
        </div>
    @endif

    @if ( $project->technologies->isNotEmpty() )
        <div>
            <h3 class="m-0 mt-4">Technologies used:</h3>
            <ul>
                @foreach ($project->technologies as $technology)
                    <a href="{{ route('admin.technologies.show', $technology) }}" class="text-decoration-none">
                        <span class="badge text-bg-info m-1 p-2">{{ $technology->name }}</span>
                    </a>
                @endforeach
            </ul>
        </div>
    @else 
        <div>
            <h3 class="m-0 mt-4">No technologies indicated.</h3>
        </div>
    @endif

    @if ( $project->reviews->isNotEmpty() )
        <h2>Reviews:</h2>
        <div class="reviews-section">
            @foreach ($project->reviews as $review)
                {{ $review->user_name }}
                {{ $review->text_review }}
                <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete review</button>
                </form>
            @endforeach
        </div>
    @else 
        <h2>Non sono presenti commenti per questo project</h2>
    @endif

    {{-- Nav links --}}
    <div class="mt-5">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Projects List</a>
        <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-success">Edit this project</a>
    </div>
@endsection