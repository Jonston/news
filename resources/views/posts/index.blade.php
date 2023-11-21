@extends(Layout::byUser())

@section('content')
    @if($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif
    @can('create-post')
        <a class="btn btn-success" href="{!! route('admin.posts.create') !!}">Add New</a>
    @endcan
    <table class="table post-list">
    <thead>
    <tr>
        <th>Preview</th>
        <th>Title</th>
        <th>Author</th>
        <th>Date</th>
        @role('admin')
        <th>Actions</th>
        @endrole
    </tr>
    </thead>
    <tbody>
    @foreach($posts as $post)
        <tr>
            <td class="text-center">
                @if($post->preview)
                    <img height="40" src="{!! $post->preview->url !!}" alt="{!! $post->title !!}">
                @else
                    <img height="40"
                         src="{!! Vite::asset('resources/images/no-image.jpg') !!}"
                         alt="{!! $post->title !!}"
                    >
                @endif
            </td>
            <td>{!! $post->title !!}</td>
            <td>{!! $post->author?->email !!}</td>
            <td>{!! $post->date !!}</td>
            @role('admin')
            <td>
                <div class="d-flex">
                    @can('edit-post')
                        <a class="btn btn-primary me-2" href="{!! route('admin.posts.edit', [$post->id]) !!}">Edit</a>
                    @endcan
                    @can('delete-post')
                        <form id="delete-form" action="{!! route('admin.posts.destroy', [$post->id]) !!}"
                              method="POST"
                        >
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-delete" type="submit">Delete</button>
                        </form>
                    @endcan
                </div>
            </td>
            @endrole
        </tr>
    @endforeach
    </tbody>
</table>
@include('common.pagination', ['paginator' => $posts])
@endsection
@section('scripts')
    <script type="text/javascript">
        function confirmDelete(event) {
            console.log('confirmDelete');
            event.preventDefault();
            if (confirm('Are you sure wants to delete this Post?')) {
                event.target.closest('form').submit();
            }
        }

        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', confirmDelete);
        });
    </script>
@endsection

