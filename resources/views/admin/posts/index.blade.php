@extends('admin.layouts.base')

@section('title', 'Index')

@section('main') 

    <div class="index container">
    
        <h1>POSTS</h1>

            {{-- conferma delete --}}
            @if (session('delete_success'))
                @php $post = session('delete_success') @endphp
                <div class="alert alert-danger m-0">
                    "{{ $post->title }}" Deleted
                    <form
                        action="{{ route(".posts.restore", ['post' => $post]) }}"
                        method="post"
                        class="d-inline-block restore-btn"
                    >
                        @csrf
                        <button class="btn btn-warning">Restore</button>
                    </form>
                </div>
            @endif

            {{-- conferma restore --}}
            @if (session('restore_success'))
                @php $post = session('restore_success') @endphp
                <div class="alert alert-success">
                    "{{ $post->title }}" Restored
                </div>
            @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->url_image }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.posts.show', ['post' => $post->id]) }}">View</a>
                            <a class="btn btn-warning" href="{{ route('admin.posts.edit', ['post' => $post->id]) }}">Edit</a>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger js-delete" data-bs-toggle="modal" data-bs-target="#Delete" data-id="{{ $post->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Paginator --}}
        <div class="paginator">
            {{ $posts->links() }}
        </div>

        {{-- other buttons --}}
        <div>
            {{-- Add New Post --}}
            <a class="btn btn-primary" href="{{ route('admin.posts.create') }}">Add new Post</a>

            {{-- Trash Can --}}
            {{-- <a class="btn btn-warning" href="{{ route('admin.posts.trashed') }}">
                Trash Can
                <i class="bi bi-trash3"></i>
            </a> --}}
        </div>

        <!-- Modal -->
        <div class="modal fade" id="Delete" tabindex="-1" aria-labelledby="DeleteLabel" aria-hidden="true" style="color:black;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="DeleteLabel">Are you sure?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                <div class="modal-body">
                    You can't go back from this!
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form
                            action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}"
                            method="post"
                            class="d-inline-block"
                            id="btn-confirm-delete"
                        >
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger">Confirm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection