User: {{ $user }}

<form method="POST" action="/users/{{ $user->id }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_method" value="DELETE">

    <input type="submit" value="Delete">
</form>
