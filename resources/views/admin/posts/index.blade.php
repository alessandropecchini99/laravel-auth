@extends('admin.layouts.base')

@section('title', 'Index')

@section('main') 

    <div class="index">
    
        <h1>POSTS</h1>

            {{-- @if (session('delete_success'))
                @php $post = session('delete_success') @endphp
                <div class="alert alert-danger m-0">
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

            @if (session('restore_success'))
                @php $post = session('restore_success') @endphp
                <div class="alert alert-success">
                    "{{ $post->title }}" Restored
                </div>
            @endif --}}

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->content }}</td>
                        <td>{{ $post->url_image }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.posts.show', ['post' => $post->id]) }}">View</a>
                            <a class="btn btn-warning" href="{{ route('admin.posts.edit', ['post' => $post->id]) }}">Edit</a>
                            <form
                                action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}"
                                method="post"
                                class="d-inline-block"
                            >
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger">Delete</button>
                            </form>
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

    </div>

@endsection