@extends(Layout::byUser())

@section('content')
    @include('profile.form', [
        'profile' => $profile,
        'action' => route('cabinet.profiles.update', ['profile' => $profile->id]),
        'method' => 'PUT',
    ])

    <div class="mt-2">
        @can('delete-user')
        <form id="delete-form" action="{!! route('cabinet.profiles.destroy', [$profile->id]) !!}" method="POST">
            @csrf
            @method('DELETE')
            <div class="d-flex align-items-center">
                <button type="button" id="btn-delete" class="btn btn-danger btn-delete" type="submit">Delete</button>
                <label class="ms-3" for="delete-form">Delete profile</label>
            </div>
        </form>
        @endcan
    </div>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript">
        window.addEventListener('DOMContentLoaded', () => {
            const btnDelete = document.getElementById('btn-delete');
            const deleteForm = document.getElementById('delete-form');

            btnDelete.addEventListener('click', () => {

                if ( ! confirm('Are you sure wants to delete this profile?')) {
                    return;
                }

                deleteForm.submit();
            });
        });
    </script>
@endsection
