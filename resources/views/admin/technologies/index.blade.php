@extends('layouts.admin')

@section('page-title')
    Technologies
@endsection

@section('content')
    <div class="my-3 d-flex align-items-center justify-content-between">
        <h1>Technologies List</h1>

        @if (session('message'))
            <div class="alert alert-success mb-0">
                {{ session('message') }}
            </div>
        @endif

        <a href="{{ route('admin.technologies.create') }}" class="btn btn-success">Create new technology</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Technology name</th>
                    <th scope="col">slug</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($technologies as $technology)
                <tr>
                    <td>{{ $technology->id }}</td>
                    <td>{{ $technology->name }}</td>
                    <td>{{ $technology->slug }}</td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Info
                            </a>
                            
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('admin.technologies.show', $technology) }}">Show details</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.technologies.edit', $technology) }}">Edit</a></li>
                            </ul>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-{{ $technology->id }}">
                                Delete
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="modal-{{ $technology->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Deleting "{{ $technology->name }}" technology.</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-danger text-decoration-underline">
                                        You will not be able to retrieve it anymore, are you sure?
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form action="{{ route('admin.technologies.destroy', $technology) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">DELETE</button>
                                    </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection