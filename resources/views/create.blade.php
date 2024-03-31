<form action="/users" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Name">
    <input type="text" name="email" placeholder="Email">
    <input type="text" name="password" placeholder="Password">
    <input type="submit" value="Submit">
</form>
