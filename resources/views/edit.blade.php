<form method="POST" action="/users/{{ $user->id }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_method" value="PUT">
    <input type="text" name="name" placeholder="Name" value="{{ $user->name }}">
    <input type="text" name="email" placeholder="Email" value="{{ $user->email }}">
    <input type="text" name="password" placeholder="Password" value="{{ $user->password }}">
    <input type="submit" value="Submit">
</form>
