<form action="{{ route('logout') }}" method="post">
    @csrf
    <button class="btn btn-warning" type="submit">Logout</button>
</form>
