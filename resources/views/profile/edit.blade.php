@extends(Layout::byUser())

@section('content')
    @include('profile.form', [
        'profile' => $profile,
        'action' => route('cabinet.profiles.update', ['profile' => $profile->id]),
        'method' => 'PUT',
    ]);
@endsection
