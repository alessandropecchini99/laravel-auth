@extends('admin.layouts.base')

@section('title', 'Index')

@section('main') 

    <div class="index container">
    
        <h1>POSTS</h1>

            {{-- conferma delete --}}
            @if (session('delete_success'))
                @php $post = session('delete_success') @endphp
                <div class="alert alert-danger m-0 mb-3">
                    "{{ $post->title }}" Deleted
                    <form
                        action="{{ route("admin.posts.restore", ['post' => $post]) }}"
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
                            <button type="button" class="btn btn-danger myModal" data-bs-toggle="modal" data-bs-target="#myInput" data-id="{{ $post->id }}">
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
        <div class="modal fade w-100" id="myInput" tabindex="-1" aria-labelledby="myInput" aria-hidden="true" style=" color:black;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Are you sure?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        This will permanently delete it!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>

                        <form
                            action="{{ route("admin.posts.destroy", ['post' => '***']) }}"
                            {{-- action="http://localhost:8000/admin/posts/0/destroy" --}}
                            method="post"
                            class="d-inline-block"
                            id="myForm"
                        >
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection