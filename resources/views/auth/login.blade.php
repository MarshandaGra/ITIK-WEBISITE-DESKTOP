<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h1>Login</h1>

@if($errors->any())
    <div style="color: red;">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form action="{{ route('login') }}" method="POST">

    @csrf

    <div>
        <label>Email</label>
        <br>
        <input
            type="email"
            name="email"
            value="{{ old('email') }}"
            required
        >
    </div>

    <br>

    <div>
        <label>Password</label>
        <br>
        <input
            type="password"
            name="password"
            required
        >
    </div>

    <br>

    <button type="submit">
        Login
    </button>

</form>

</body>
</html>
